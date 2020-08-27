<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\User;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category', ['categories' => Category::all(), 'category' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category', ['categories' => Category::all(), 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->all())->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }

    public function showMigrationForm()
    {
        $categories = Category::with([
            'users' => function ($query) {
                $query->where('user_type', 'player')->orderBy('surname')->orderBy('name');
            }
        ])->get();

        $players = User::where('user_type', 'player')->orderBy('birth_date', 'desc')->orderBy('surname')->orderBy('name')->get();

        $birthYears = [];

        foreach($players as $player) {
            $birthYears[$player->birth_date->isoFormat('Y')][] = $player;
        }

        return view('admin.migration', [
            'categories' => $categories,
            'birthYears' => $birthYears
        ]);
    }

    public function migrate(Request $request)
    {
        if ($request->has('new_category') && $request->has('players')) {
            foreach($request->players as $playerId) {
                $player = User::find($playerId);
                $player->category_id = $request->new_category;
                $player->save();
            }
        }
        return redirect()->route('migration.form');
    }
}
