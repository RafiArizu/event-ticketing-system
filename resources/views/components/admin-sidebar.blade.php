<style>
    .admin-profile-section { width: calc(100% + 40px); margin-left: -20px; padding-bottom: 12px; }
    @media (min-width: 1024px) {
        .admin-profile-section { width: calc(100% + 48px); margin-left: -24px; padding-bottom: 12px; }
        .admin-shell-sidebar { position: fixed; inset: 0 auto 0 0; z-index: 20; width: 248px; height: 100dvh; overflow-y: auto; }
        .admin-shell-content { margin-left: 248px; max-height: 100dvh; overflow-y: auto; }
    }
</style>
<aside class="admin-shell-sidebar w-screen shrink-0 overflow-y-auto bg-[#a9361f] text-[#fff9f3] lg:fixed lg:inset-y-0 lg:left-0 lg:z-20 lg:flex lg:h-[100dvh] lg:w-[248px]">
    <div class="flex h-full flex-col px-5 py-5 lg:px-6 lg:pb-0 lg:pt-7">
        <input id="admin-nav-toggle" type="checkbox" class="peer sr-only">
        <div class="flex items-center justify-between gap-3 pb-2 lg:border-b lg:border-[#d16b54]/50 lg:pb-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" aria-label="Admin Event Organizer, beranda">
                <span class="grid h-10 w-10 place-items-center rounded-[6px] bg-[#f4511e] font-['Outfit'] text-lg font-extrabold tracking-[-.05em]">AE</span>
                <span class="font-['Outfit'] text-base font-bold leading-tight">Anime Event<br>Organizer</span>
            </a>
            <label for="admin-nav-toggle" class="grid h-14 w-14 shrink-0 cursor-pointer place-items-center rounded-[6px] text-[#fff9f3] hover:bg-[#8e2e1b] lg:hidden" aria-label="Buka menu admin">
                <svg aria-hidden="true" viewBox="0 0 24 24" class="h-8 w-8 fill-none stroke-current" stroke-width="1.8"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </label>
        </div>
        <div class="hidden peer-checked:flex peer-checked:flex-col lg:flex lg:flex-1 lg:flex-col">
            <nav class="mt-7" aria-label="Navigasi admin">
                <p class="mb-3 px-3 font-mono text-[10px] font-semibold uppercase tracking-[.18em] text-[#f3b09e]">Workspace</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" @class(['flex min-h-11 items-center gap-3 rounded-[5px] px-3 text-sm font-medium hover:bg-[#8e2e1b] hover:text-[#fff9f3]', 'bg-[#762817] font-semibold' => request()->routeIs('admin.dashboard'), 'text-[#f7d5cc]' => ! request()->routeIs('admin.dashboard')])><svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="M4 13h6V4H4v9Zm10 7h6v-9h-6v9ZM4 20h6v-3H4v3Zm10-11h6V4h-6v5Z"/></svg><span>Dashboard</span></a>
                    <a href="{{ route('admin.events') }}" @class(['flex min-h-11 items-center gap-3 rounded-[5px] px-3 text-sm font-medium hover:bg-[#8e2e1b] hover:text-[#fff9f3]', 'bg-[#762817] font-semibold' => request()->routeIs('admin.events*'), 'text-[#f7d5cc]' => ! request()->routeIs('admin.events*')])><svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="M5 5.5h14v13H5zM8 3v5m8-5v5M5 10h14"/></svg><span>Event</span></a>
                    <a href="{{ route('admin.vendors') }}" @class(['flex min-h-11 items-center gap-3 rounded-[5px] px-3 text-sm font-medium hover:bg-[#8e2e1b] hover:text-[#fff9f3]', 'bg-[#762817] font-semibold' => request()->routeIs('admin.vendors'), 'text-[#f7d5cc]' => ! request()->routeIs('admin.vendors')])><svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="M4 19v-1.5a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4V19M9 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7-1h4M18 6v6"/></svg><span>Vendor</span></a>
                    <a href="{{ route('admin.bookings') }}" @class(['flex min-h-11 items-center gap-3 rounded-[5px] px-3 text-sm font-medium hover:bg-[#8e2e1b] hover:text-[#fff9f3]', 'bg-[#762817] font-semibold' => request()->routeIs('admin.bookings*'), 'text-[#f7d5cc]' => ! request()->routeIs('admin.bookings*')])><svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="M5 5h14v14H5zM8 9h8M8 13h5"/></svg><span>Booking</span></a>
                    <a href="{{ route('admin.categories.index') }}" class="flex min-h-11 items-center gap-3 rounded-[5px] px-3 text-sm font-medium text-[#f7d5cc] hover:bg-[#8e2e1b] hover:text-[#fff9f3]"><svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="m12 4 7 4-7 4-7-4 7-4Zm-7 8 7 4 7-4M5 16l7 4 7-4"/></svg><span>Kategori</span></a>
                </div>
            </nav>
            @php($admin = auth()->user())
            <div class="admin-profile-section mt-auto border-t border-[#d16b54]/50 px-5 pt-4 lg:px-6">
                <div class="grid grid-cols-[40px_minmax(0,1fr)] items-center gap-3"><span class="grid h-10 w-10 place-items-center rounded-full bg-[#f3b09e] font-['Outfit'] text-sm font-bold text-[#762817]">{{ strtoupper(substr($admin?->name ?? 'Admin', 0, 2)) }}</span><div class="min-w-0"><p class="truncate font-['Outfit'] text-sm font-bold">{{ $admin?->name ?? 'Admin' }}</p><p class="mt-0.5 text-xs text-[#f3b09e]">{{ ucfirst($admin?->role ?? 'admin') }}</p></div></div>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">@csrf<button type="submit" class="flex min-h-10 w-full items-center gap-3 rounded-[5px] px-0 text-sm font-semibold text-[#f7d5cc] hover:bg-[#8e2e1b] hover:text-[#fff9f3]"><span class="grid h-10 w-10 shrink-0 place-items-center"><svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="M10 5H5v14h5M14 8l4 4-4 4m4-4H9"/></svg></span>Keluar</button></form>
            </div>
        </div>
    </div>
</aside>
