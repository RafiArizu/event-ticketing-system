<?php

namespace App\Http\Controllers\admin;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController
{
    //
    public function index()
    {
        $vendors = Vendor::with('user')
            ->latest()
            ->get();

        return view('admin.vendors.index', compact('vendors'));
    }
}
