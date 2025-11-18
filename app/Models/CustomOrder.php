<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * App\Models\CustomOrder
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string|null $specifications
 * @property string|null $design_upload
 * @property int $quantity
 * @property string $status
 * @property string $payment_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read User $user
 */
class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'specifications',
        'design_upload',
        'quantity',
        'status',
        'payment_status',
    ];

    /**
     * The user who owns this custom order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
