<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    // Fetch Events
    public function fetch()
    {
        $events = Calendar::all();

        return response()->json($events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'className' => $event->category, // Agar warna sesuai kategori
            ];
        }));
    }

    // Store New Event
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'category' => 'nullable|string'
        ]);

        // Simpan data ke database
        $event = new Calendar();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->category = $request->category;
        $event->save();

        return response()->json(['success' => true, 'message' => 'Event saved successfully!']);
    }

    // Update Event
    public function update(Request $request, $id)
    {
        $event = Calendar::findOrFail($id);
        $event->update($request->all());

        return response()->json(['success' => true, 'message' => 'Event updated successfully!', 'event' => $event]);
    }

    // Delete Event
    public function destroy($id)
    {
        $event = Calendar::findOrFail($id);
        $event->delete();

        return response()->json(['success' => true, 'message' => 'Event deleted successfully!']);
    }
}
