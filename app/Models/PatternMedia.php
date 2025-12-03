<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatternMedia extends Model
{
    protected $fillable = [
        'yakan_pattern_id',
        'type',
        'path',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function pattern(): BelongsTo
    {
        return $this->belongsTo(YakanPattern::class, 'yakan_pattern_id');
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}
