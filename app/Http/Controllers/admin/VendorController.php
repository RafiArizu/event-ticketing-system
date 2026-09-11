<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController
{
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
        $pendingCount = Vendor::where('status', 'pending')->count();

        return view('admin.vendors.index', compact('vendors', 'pendingCount', 'search', 'status'));
    }
}
