<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedTicket extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'booking_item_id',
        'ticket_code',
        'qr_code',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'used_at' => 'datetime'
        ];
    }

    public function bookingItem()
    {
         return $this->belongsTo(BookingItem::class);
    }
}
