<?php

namespace App\Http\Controllers;

use App\Event;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($type)
    {
        if ($type == 'training') {
            $cats = [];
            $dayNames = [
                1 => 'Pon',
                2 => 'Uto',
                3 => 'Str',
                4 => 'Štv',
                5 => 'Pia',
                6 => 'Sob',
                7 => 'Ned'
            ];
            $days = [];
            for ($i = 0; $i < 7; $i++) {
                $days[$i + 1] = $dayNames[date('N', strtotime('+' . $i . ' days'))];
            }
            $startWeekDate = date('Y-m-d');
            $endWeekDate = date('Y-m-d', strtotime('+7 days', strtotime($startWeekDate)));
            $categories = Category::with([
                'events' => function ($query) use ($type, $startWeekDate, $endWeekDate) {
                    $query->whereBetween('event_date', [$startWeekDate, $endWeekDate])->where('event_type', $type)->orderBy('event_date');
                }
            ])->where('trainings_visible', true)->get();

            $weekPattern = [];
            $reversedNames = array_flip($dayNames);
            foreach ($days as $day) {
                $weekPattern[$reversedNames[$day]] = null;
            }
            foreach ($categories as $category) {
                $cats[$category->name]['week'] = $weekPattern;
                foreach ($category->events as $event) {
                    $dayNum = date('N', strtotime($event->event_date));
                    $cats[$category->name]['week'][$dayNum] = $event;
                }
            }
            return view('trainings', ['categories' => $cats, 'days' => $days]);
        } else {
            if (!Auth::check()) {
                return redirect()->route('login');
            }
            $events = Event::whereHas('participants', function (Builder $query) {
                $query->where('player_id', Auth::user()->id);
            })
                ->where('event_type', $type)
                ->where('event_date', '>=', Carbon::today())
                ->orderBy('event_date', 'desc')
                ->get();
            return view('events', ['title' => ($type == 'match' ? 'Zápasy' : 'Turnaje'), 'events' => $events]);
        }
    }
}
