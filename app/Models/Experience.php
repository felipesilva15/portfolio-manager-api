<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Experience",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="company_name", type="string", example="PWI Sistemas"),
 *      @OA\Property(property="position", type="string", example="Analista desenvolvedor fullstack"),
 *      @OA\Property(property="locality", type="string", example="São Paulo, SP"),
 *      @OA\Property(property="description", type="string", example="Atuei como desenvolvedor fullstack com as tecnologias Angular, Laravel, Node e SQL."),
 *      @OA\Property(property="start_date", type="string", format="date", example="2020-09-22"),
 *      @OA\Property(property="end_date", type="string", format="date", example=null),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Experience extends Model
{
    /** @use HasFactory<\Database\Factories\ExperienceFactory> */
    use HasFactory;

    protected $fillable = [
        'company_name',
        'position',
        'locality',
        'description',
        'start_date',
        'end_date',
    ];
}
