<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainingsQuery = Attendance::with(['trainer', 'player', 'category'])->latest()->where('event_type', 'training');
        $matchesQuery = Attendance::with(['trainer', 'player', 'category'])->latest()->where('event_type', 'match');
        $tournamentsQuery = Attendance::with(['trainer', 'player', 'category'])->latest()->where('event_type', 'tournament');

        if ($request->query('category')) {
            $trainingsQuery = $trainingsQuery->where('category_id', $request->query('category'));
            $matchesQuery = $matchesQuery->where('category_id', $request->query('category'));
            $tournamentsQuery = $tournamentsQuery->where('category_id', $request->query('category'));
        }

        $trainingsArr = $trainingsQuery->get();
        $matchesArr = $matchesQuery->get();
        $tournamentsArr = $tournamentsQuery->get();
        $trainings = [];

        foreach ($trainingsArr as $training) {
            $trainerName = 'tréner neexistuje';
            if ($training->trainer) {
                $trainerName = $training->trainer->name . ' ' . $training->trainer->surname;
            }
            $trainings[$training->event_date->isoFormat('D. M. Y') . ' - ' . $training->category->name . ' (vytvoril: ' . $trainerName . ')'][] = $training;
        }
        $matches = [];
        foreach ($matchesArr as $match) {
            $trainerName = 'tréner neexistuje';
            if ($match->trainer) {
                $trainerName = $match->trainer->name . ' ' . $match->trainer->surname;
            }
            $matches[$match->event_date->isoFormat('D. M. Y') . ' - ' . $match->category->name . ' (vytvoril: ' . $trainerName . ')'][] = $match;
        }
        $tournaments = [];
        foreach ($tournamentsArr as $tournament) {
            $trainerName = 'tréner neexistuje';
            if ($tournament->trainer) {
                $trainerName = $tournament->trainer->name . ' ' . $tournament->trainer->surname;
            }
            $tournaments[$tournament->event_date->isoFormat('D. M. Y') . ' - ' . $tournament->category->name . ' (vytvoril: ' . $trainerName . ')'][] = $tournament;
        }
        return view('admin.attendance', [
            'trainings' => $trainings,
            'matches' => $matches,
            'tournaments' => $tournaments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($message = null)
    {
        return view('attendance.trainer', ['categories' => Category::whereHas('users', function ($query) {
            $query->where('user_type', 'player')
                ->whereNull('deleted_at');
        })->with(['users' => function ($query) {
            $query->whereNull('deleted_at');
        }])->orderBy('categories.id')->get(), 'message' => $message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        // dd($request->input());
        foreach ($request->is_present as $playerId => $isPresent) {
            if ($isPresent != -1) {
                Attendance::create([
                    'event_type' => $request->event_type,
                    'trainer_id' => Auth::id(),
                    'player_id' => $playerId,
                    'category_id' => $request->category_id,
                    'event_date' => date('Y-m-d'),
                    'is_present' => $isPresent
                ]);
            }
        }
        return redirect()->route('trainer.attendance.create', ['message' => 'Dochádzka bola vytvorená.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->is_present = $request->is_present;
        $attendance->save();
        return redirect()->route('attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index');
    }
}
