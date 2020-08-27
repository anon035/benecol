<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\EventParticipant;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEventRequest;
use App\Mail\EventMail;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isAdmin = Auth::user()->user_type == 'admin';
        $trainings = Event::has('category')->where('event_type', 'training')->where('event_date', '>', date('Y-m-d', strtotime('-7 days')))->orderBy('event_date', 'desc')->get();
        $matches = Event::has('participants')->where('event_type', 'match')->where('event_date', '>', date('Y-m-d', strtotime('-7 days')))->orderBy('event_date', 'desc')->get();
        $tournaments = Event::has('participants')->where('event_type', 'tournament')->where('event_date', '>', date('Y-m-d', strtotime('-7 days')))->orderBy('event_date', 'desc')->get();
        return view('admin.events-list', [
            'categories' => Category::where('trainings_visible', true)->get(),
            'isAdmin' => $isAdmin,
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
    public function create()
    {
        return view('admin.create-event', ['categories' => Category::with(['users' => function($query) {
            $query->whereNull('deleted_at');
        }])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        DB::transaction(function () use ($request) {
            $event = new Event();
            $event->event_date = $request->event_date . '|' . $request->event_time;
            $event->event_type = $request->event_type;
            $event->note = $request->note;
            $event->user_id = Auth::id();
            if ($catId = $request->category_id) {
                $event->category_id = $catId;
            }
            $event->save();
            if ($request->participants) {
                $event->participants()->createMany($request->participants);
            }
            if ($request->event_type != 'training') {
                $this->sendEventNotification($request->event_type, new Carbon($event->event_date), $request->participants);
            }
        });
        return redirect()->route('events.index');
    }

    private function sendEventNotification($eventType, $eventDate, $participants)
    {
        $recipients = [];
        foreach ($participants as $participant) {
            $player = User::find($participant['player_id']);
            if ($player->notifications_on) {
                $recipients[] = $player->email;
            }
        }
        $eventName = ($eventType == 'match' ? 'Zápas' : 'Turnaj') . ' ' . $eventDate->isoFormat('DD.MM.YYYY') . ' o ' . $eventDate->isoFormat('HH:mm');
        $eventLink = url(route('events', ['type' => $eventType]));
        return Mail::to(Auth::user())->bcc($recipients)->send(new EventMail($eventName, $eventLink));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $participants = [];
        foreach ($event->participants as $participant) {
            $participants[] = $participant->player_id;
        }
        return view('admin.edit-event', ['event' => $event, 'participants' => $participants, 'categories' =>  Category::with('users')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        DB::transaction(function () use ($request, $event) {
            foreach ($request->participants as $id => $participant) {
                $eventParticipant = EventParticipant::find($id);
                $eventParticipant->is_present = $participant['is_present'];
                $eventParticipant->save();
            }
        });
        return redirect()->route('events.index');
    }

    /**
     * Update details of event
     */
    public function updateDetails(Request $request, Event $event)
    {
        $event->event_date = $request->event_date . '|' . $request->event_time;
        $event->event_type = $request->event_type;
        $event->note = $request->note;
        if ($catId = $request->category_id) {
            $event->category_id = $catId;
        }
        if ($request->has('participants')) {
            foreach ($event->participants as $participant) {
                $participant->delete();
            }
            $event->participants()->createMany($request->participants);
        }
        $event->save();
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        DB::transaction(function () use ($event) {
            foreach ($event->participants as $player) {
                $player->delete();
            }
            $event->delete();
        });
        return redirect()->route('events.index');
    }
}
