<?php


namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\View\View;

class EventController
{
    public function index(): View
    {
        $events = Event::with(['vendor', 'category'])
            ->latest()
            ->paginate(10);
        $statusCounts = Event::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.events.index', compact('events', 'statusCounts'));
    }

    public function show(Event $event): View
    {
        $event->load(['vendor.user', 'category', 'ticketCategories.tickets']);

        return view('admin.events.show', compact('event'));
    }
}
