<?php


namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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

    public function create(): View
    {
        return view('admin.events.create', [
            'categories' => Category::orderBy('name')->get(),
            'vendors' => Vendor::where('status', 'approved')->orderBy('organization_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['poster'] = $request->file('poster')->store('posters', 'public');
        Event::create($data);

        return redirect()->route('admin.events')->with('status', 'Event berhasil dibuat.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', [
            'event' => $event,
            'categories' => Category::orderBy('name')->get(),
            'vendors' => Vendor::where('status', 'approved')->orderBy('organization_name')->get(),
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validated($request);
        $data['slug'] = $event->title === $data['title']
            ? $event->slug
            : $this->uniqueSlug($data['title'], $event);
        if ($request->hasFile('poster')) {
            Storage::disk('public')->delete($event->poster);
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        } else {
            unset($data['poster']);
        }
        $event->update($data);

        return redirect()->route('admin.events.show', $event)->with('status', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events')->with('status', 'Event berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'vendor_id' => ['required', 'exists:vendor,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:5000'],
            'poster' => [$request->routeIs('admin.events.store') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'venue_name' => ['required', 'string', 'max:150'],
            'venue_address' => ['required', 'string', 'max:500'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'status' => ['required', 'in:draft,published,cancelled,completed'],
        ]);
    }

    private function uniqueSlug(string $title, ?Event $ignore = null): string
    {
        $slug = Str::slug($title);
        $query = Event::where('slug', $slug);
        if ($ignore) {
            $query->whereKeyNot($ignore->getKey());
        }

        return $query->exists() ? $slug.'-'.Str::lower(Str::random(5)) : $slug;
    }
}
