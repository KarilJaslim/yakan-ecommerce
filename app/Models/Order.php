<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'status',
        'tracking_number',
        'tracking_status',
        'tracking_history',
    ];

    // Cast tracking_history as array
    protected $casts = [
        'tracking_history' => 'array',
    ];

    // Relationship to order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Boot method to auto-generate tracking info
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate a unique tracking number if not set
            if (!$order->tracking_number) {
                $order->tracking_number = 'TRK-' . strtoupper(Str::random(10));
            }

            // Set initial tracking status
            $order->tracking_status = 'Order Placed';

            // Initialize tracking history
            $order->tracking_history = [
                [
                    'status' => 'Order Placed',
                    'date' => now()->format('Y-m-d H:i:s')
                ]
            ];
        });
    }
}
