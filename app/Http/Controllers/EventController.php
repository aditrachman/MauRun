<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('registrations')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $eventTypes = EventType::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('events.create', compact('eventTypes', 'cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'event_type_id' => 'required|exists:event_types,id',
            'date' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'price' => 'required|integer|min:0',
            'quota' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat!');
    }

    public function edit(Event $event)
    {
        $eventTypes = EventType::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('events.edit', compact('event', 'eventTypes', 'cities'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'event_type_id' => 'required|exists:event_types,id',
            'date' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'price' => 'required|integer|min:0',
            'quota' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}
