<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    //

    use HasFactory, SoftDeletes;

     protected $fillable = [
        'ticket_category_id',
        'name',
        'description',
        'price',
        'quota',
        'sold',
        'sales_start',
        'sales_end',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sales_start' => 'datetime',
            'sales_end' => 'datetime',
        ];
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }
}
