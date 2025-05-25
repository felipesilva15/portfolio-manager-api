<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Skill",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="title", type="string", example="Laravel"),
 *      @OA\Property(property="icon_url", type="string", format="url", example="http://localhost:8000/icons/laravel.png"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Skill extends Model
{
    /** @use HasFactory<\Database\Factories\SkillFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'icon_url'
    ];
}
