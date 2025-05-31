<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *      schema="Link",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="label", type="string", example="LinkedIn"),
 *      @OA\Property(property="url", type="string", format="url", example="https://www.linkedin.com/in/felipe-silva1508/"),
 *      @OA\Property(property="icon_name", type="string", example="pi-linkedin"),
 *      @OA\Property(property="user_id", type="integer", example=1),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Link extends Model
{
    /** @use HasFactory<\Database\Factories\LinkFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'url',
        'icon_name',
        'user_id'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
