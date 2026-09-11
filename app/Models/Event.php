<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'title',
        'slug',
        'description',
        'poster',
        'venue_name',
        'venue_address',
        'event_date',
        'start_time',
        'end_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class);
    }

    

}
