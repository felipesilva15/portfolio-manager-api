<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    /** @use HasFactory<\Database\Factories\TestimonialFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'sex',
        'date',
        'testimonial',
        'original_url'
    ];

    protected function casts(): array {
        return [
            'sex' => SexEnum::class,
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
