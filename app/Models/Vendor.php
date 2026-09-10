<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'organization_name',
        'description',
        'phone',
        'address',
        'instagram',
        'facebook',
        'x_(twitter)',
        'logo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}