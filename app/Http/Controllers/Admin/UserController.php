<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\TrainerPhoto;
use Illuminate\Support\Facades\DB;
use App\Exceptions\FileUploadException;
use App\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = User::withTrashed()->where('user_type', 'player')->orderBy('deleted_at')->orderBy('category_id')->get();
        $trainers = User::withTrashed()->where('user_type', 'trainer')->orderBy('deleted_at')->orderBy('category_id')->get();
        $playersBirthYear = User::select([\DB::raw('YEAR(birth_date) as year')])->where('user_type', 'player')->orderBy('year')->distinct()->get();
        return view('admin.users-list', ['players' => $players, 'trainers' => $trainers, 'playersBirthYear' => $playersBirthYear]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.register', ['categories' => $categories, 'user' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $randomPassword = Str::random(10);
            $user = User::create(array_merge($request->all(), ['password' => $randomPassword]));
            if ($request->input('user_type') == 'trainer') {
                $file = $request->file('photo');
                $tempPath = $file->path();
                $dbPath = 'public_files/trainer_photos/' . time() . $file->hashName();
                $photoPath = str_replace('/project/', '/web/', base_path($dbPath));
                if (!move_uploaded_file($tempPath, $photoPath)) {
                    throw new FileUploadException('Nahrávanie fotky zlyhalo');
                }
                $photo = new TrainerPhoto(['path' => $dbPath]);
                $user->photo()->save($photo);
            } else {
                $user->membership()->save(new Membership());
            }
            Mail::to($user)->send(new WelcomeMail($user->name, $user->registration_number, $randomPassword));
        });
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $categories = Category::all();
        return view('admin.register', ['categories' => $categories, 'user' => $user]);
    }

    public function resetPassword(User $user)
    {
        $randomPassword = Str::random(10);
        $user->password = $randomPassword;
        $user->save();
        Mail::to($user)->send(new WelcomeMail($user->name, $user->registration_number, $randomPassword, true));

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->all())->save();
        if ($request->has('photo')) {
            $file = $request->file('photo');
            $tempPath = $file->path();
            $dbPath = 'public_files/trainer_photos/' . time() . $file->hashName();
            $photoPath = str_replace('/project/', '/web/', base_path($dbPath));
            if (!move_uploaded_file($tempPath, $photoPath)) {
                throw new FileUploadException('Nahrávanie fotky zlyhalo');
            }
            $photo = new TrainerPhoto(['path' => $dbPath]);
            $oldPhotoPath = str_replace('/project/', '/web/', base_path($user->photo->path));
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
            $user->photo()->delete();
            $user->photo()->save($photo);
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect()->route('users.index');
    }

    public function lock(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function unlock(Request $request)
    {
        User::withTrashed()->find($request->id)->restore();
        return redirect()->route('users.index');
    }

    public function passwordChange(Request $request, User $user)
    {
        if (Auth::attempt([
            'registration_number' => $user->registration_number,
            'password' => $request->password
        ])) {
            if ($request->new_password == $request->new_password_check) {
                $user->password = $request->new_password;
                $user->save();
                return redirect()->route('password-change.form', ['message' => 'success']);
            } else {
                return redirect()->route('password-change.form', ['message' => 'pass-check']);
            }
        }
        return redirect()->route('password-change.form', ['message' => 'pass-wrong']);
    }

    public function attendance(User $user)
    {
        $userAttendance = $user->playerAttendance;
        $attendance = collect($userAttendance)->sortByDesc('created_at')->all();
        return view('admin.user-attendance', compact('attendance'));
    }
}
