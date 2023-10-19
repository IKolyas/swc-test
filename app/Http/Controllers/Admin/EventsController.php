<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\View\View;

class EventsController extends Controller
{
    public function index(Event $event = null): View
    {
        $eventList = Event::all();


        return view('pages.events.index');
    }

    public function attach()
    {

    }

    public function detach()
    {

    }
}