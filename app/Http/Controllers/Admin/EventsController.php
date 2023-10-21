<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataTransformers\EventDataTransformer;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class EventsController extends Controller
{
    public function index(Event $event = null): View
    {
        $eventList = Event::all()
            ->transform(EventDataTransformer::transformToList(...))
            ->toArray();

        $userEvents = auth()
            ->user()
            ->participatesEvents()
            ->get()
            ->transform(EventDataTransformer::transformToList(...))
            ->toArray();

        if ($event) {
            $event = EventDataTransformer::transformToDetail($event->load('users'));
        }

        return view('pages.events.index', compact('eventList', 'event', 'userEvents'));
    }

    public function reload(Event $event = null): JsonResponse
    {
        $eventList = Event::all()
            ->transform(EventDataTransformer::transformToList(...))
            ->toArray();

        $activeEvent = null;

        if ($event) {
            $activeEvent = $event->id;
            $event = EventDataTransformer::transformToDetail($event->load('users'));
            $event = view('pages.events.components.event_detail', ['event' => $event])->render();
        }

        $eventList = view('pages.events.components.event_list', [
            'events' => $eventList,
            'title' => 'Все события',
            'active' => $activeEvent
        ])->render();


        return response()->json(compact('eventList', 'event'));
    }

    public function attach(Event $event): RedirectResponse
    {
        $event->users()->attach(auth()->id());

        return back();
    }

    public function detach(Event $event): RedirectResponse
    {
        $event->users()->detach(auth()->id());

        return back();
    }
}