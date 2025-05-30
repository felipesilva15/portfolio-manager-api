<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *      schema="Testimonial",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="user_id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="Matheus"),
 *      @OA\Property(property="sex", ref="#/components/schemas/SexEnum"),
 *      @OA\Property(property="date", type="string", format="date", example="2025-04-28"),
 *      @OA\Property(property="testimonial", type="string", example="Foi um prazer trabalhar com o Felipe."),
 *      @OA\Property(property="original_url", type="string", format="url", example="https://www.linkedin.com/in/matheus/"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
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
