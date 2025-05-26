<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Certification",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="title", type="string", example="Docker professional"),
 *      @OA\Property(property="institution_name", type="string", example="Udemy"),
 *      @OA\Property(property="issued_date", type="string", format="date", example="2024-09-01"),
 *      @OA\Property(property="expiration_date", type="string", format="date", example=null),
 *      @OA\Property(property="credential_id", type="string", example="UC-2b0897e8-1567-4a09-b8e2-7a751305248a"),
 *      @OA\Property(property="credential_url", type="string", format="url", example="https://ude.my/UC-2b0897e8-1567-4a09-b8e2-7a751305248a"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Certification extends Model
{
    /** @use HasFactory<\Database\Factories\CertificationFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'institution_name',
        'issued_date',
        'expiration_date',
        'credential_id',
        'credential_url'
    ];
}
