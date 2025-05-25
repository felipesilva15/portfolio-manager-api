<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Education",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="institution_name", type="string", example="SENAC"),
 *      @OA\Property(property="degree", type="string", example="Graduação em Sistemas para Internet"),
 *      @OA\Property(property="locality", type="string", example="São Paulo, SP"),
 *      @OA\Property(property="start_date", type="string", format="date", example="2022-02-01"),
 *      @OA\Property(property="end_date", type="string", format="date", example="2024-07-01"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Education extends Model
{
    /** @use HasFactory<\Database\Factories\EducationFactory> */
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'institution_name',
        'degree',
        'locality',
        'start_date',
        'end_date'
    ];
}
