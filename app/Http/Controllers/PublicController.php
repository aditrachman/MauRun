<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Registration;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function events(Request $request)
    {
        $query = Event::withCount('registrations');

        if ($request->filled('event_type_id')) {
            $query->where('event_type_id', $request->event_type_id);
        }
        if ($request->filled('event_type_slug')) {
            $type = EventType::where('slug', $request->event_type_slug)->first();
            if ($type) $query->where('event_type_id', $type->id);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('city_name')) {
            $city = City::where('name', $request->city_name)->first();
            if ($city) $query->where('city_id', $city->id);
        }

        $events = $query->latest()->get();
        $eventTypes = EventType::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('public.events', compact('events', 'eventTypes', 'cities'));
    }

    public function showEvent(Event $event)
    {
        $event->loadCount('registrations');
        return view('public.show-event', compact('event'));
    }

    public function registerForm(Event $event)
    {
        $event->loadCount('registrations');
        return view('public.register-event', compact('event'));
    }

    public function registerStore(Request $request, Event $event)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'jersey_size' => 'required|in:S,M,L,XL,XXL',
            'coupon_code' => 'nullable|string|max:10',
        ]);

        $price = $event->price;
        $coupon = $request->coupon_code;
        if ($coupon === 'D-10') $price -= 10000;
        elseif ($coupon === 'D-20') $price -= 20000;
        elseif ($coupon === 'D-50') $price -= 50000;
        $price = max(0, $price);

        $data['user_id'] = auth()->id();
        $data['event_id'] = $event->id;
        $data['final_price'] = $price;

        Registration::create($data);

        return redirect()->route('public.my-events')->with('success', 'Hai ' . $data['full_name'] . ', pendaftaran kamu berhasil! Biaya: Rp ' . number_format($price, 0, ',', '.'));
    }

    public function myEvents()
    {
        $registrations = auth()->user()->registrations()->with('event.eventType', 'event.city')->latest()->get();
        return view('public.my-events', compact('registrations'));
    }
}
