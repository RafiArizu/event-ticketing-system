<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController
{
    public function show(Vendor $vendor)
    {
        $vendor->load(['user', 'reviewer']);

        return view('admin.vendors.show', compact('vendor'));
    }

    public function approve(Vendor $vendor)
    {
        abort_unless($vendor->status === 'pending', 422, 'Vendor sudah ditinjau.');

        $vendor->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        return redirect()->route('admin.vendors.show', $vendor)->with('status', 'Vendor berhasil disetujui.');
    }

    public function reject(Request $request, Vendor $vendor)
    {
        abort_unless($vendor->status === 'pending', 422, 'Vendor sudah ditinjau.');

        $data = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'min:10',
                'max:500',
            ],
        ]);

        $vendor->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => $data['rejection_reason'],
        ]);

        return redirect()->route('admin.vendors.show', $vendor)->with('status', 'Vendor ditolak.');
    }

    //
    public function index(Request $request)
    {
        $search = $request->string('q')->trim()->toString();
        $status = $request->string('status')->toString();

        $query = Vendor::with('user');

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('organization_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if (in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $vendors = $query
            ->latest()
            ->get();
        $statusCounts = Vendor::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.vendors.index', compact('vendors', 'statusCounts', 'search', 'status'));
    }
}
