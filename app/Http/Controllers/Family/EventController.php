<?php
/**
 * This controller should normally only be used to provide AJAX responses, so the views associated with the routes
 * are intentionally pretty bare (except for the create/edit views). There shouldn't really be any ui links to the index
 * method at all, but it's provided for completeness and testing.
 */

namespace App\Http\Controllers\Family;

use App\Calendar\MonthDetailProvider;
use App\Family\CalendarEntryProvider;
use App\Family\Event;
use App\Family;
use function App\flashSuccess;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $events = Event::orderBy('date', 'DESC')->get();

        return view('family.events.home', [
            'family' => $family,
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Family $family)
    {
        $event = new Event();

        if ($request->has('eventDate')) {
            $event->date = Carbon::createFromFormat("m/d/Y", $request->get('eventDate'))->format("m/d/Y");
        }

        return view('family.events.new', [
            'family' => $family,
            'event'  => $event,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Family $family)
    {
        $request->validate(Event::getValidations());

        $event = new Event();

        $event->fill($request->only($event->getFillable()));

        $event->all_day = $request->has('all_day');

        $event->save();

        flashSuccess('events.event-created');

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.events.index', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, Event $event)
    {
        return view('family.events.show', [
            'family' => $family,
            'event'  => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, Event $event)
    {
        return view('family.events.edit', [
            'family' => $family,
            'event'  => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, Event $event)
    {
        $request->validate(Event::getValidations());

        $event->fill($request->only($event->getFillable()));

        $event->all_day = $request->has('all_day');

        $event->save();

        flashSuccess('events.event-updated');

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.events.index', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Family $family, Event $event)
    {
        $event->delete();

        flashSuccess("events.event-deleted");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.events.index', [$family]);
    }
}
