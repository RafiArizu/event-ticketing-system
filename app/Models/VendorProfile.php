<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'organization_name',
        'description',
        'phone',
        'address',
        'logo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}