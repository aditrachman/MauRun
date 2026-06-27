<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\EventType;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    // ── Event Types ──

    public function eventTypes()
    {
        $eventTypes = EventType::withCount('events')->latest()->get();
        return view('event-types.index', compact('eventTypes'));
    }

    public function eventTypesCreate()
    {
        return view('event-types.create');
    }

    public function eventTypesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:event_types,slug',
        ]);

        EventType::create($data);

        return redirect()->route('admin.event-types.index')->with('success', 'Jenis event berhasil ditambahkan!');
    }

    public function eventTypesEdit(EventType $eventType)
    {
        return view('event-types.edit', compact('eventType'));
    }

    public function eventTypesUpdate(Request $request, EventType $eventType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:event_types,slug,' . $eventType->id,
        ]);

        $eventType->update($data);

        return redirect()->route('admin.event-types.index')->with('success', 'Jenis event berhasil diupdate!');
    }

    public function eventTypesDestroy(EventType $eventType)
    {
        if ($eventType->events()->count() > 0) {
            return back()->with('error', 'Tidak bisa hapus: masih ada event dengan jenis ini!');
        }
        $eventType->delete();
        return redirect()->route('admin.event-types.index')->with('success', 'Jenis event berhasil dihapus!');
    }

    // ── Cities ──

    public function cities()
    {
        $cities = City::withCount('events')->latest()->get();
        return view('cities.index', compact('cities'));
    }

    public function citiesCreate()
    {
        return view('cities.create');
    }

    public function citiesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
        ]);

        City::create($data);

        return redirect()->route('admin.cities.index')->with('success', 'Kota berhasil ditambahkan!');
    }

    public function citiesEdit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    public function citiesUpdate(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
        ]);

        $city->update($data);

        return redirect()->route('admin.cities.index')->with('success', 'Kota berhasil diupdate!');
    }

    public function citiesDestroy(City $city)
    {
        if ($city->events()->count() > 0) {
            return back()->with('error', 'Tidak bisa hapus: masih ada event di kota ini!');
        }
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'Kota berhasil dihapus!');
    }
}
