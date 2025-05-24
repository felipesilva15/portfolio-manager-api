<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Contact",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="João"),
 *      @OA\Property(property="email", type="string", example="joao@email.com"),
 *      @OA\Property(property="subject", type="string", example="Oferta de emprego"),
 *      @OA\Property(property="message", type="string", example="<p>Boa tarde!</p><p>Tenho uma oferta de emprego para você</p>"),
 *      @OA\Property(property="status", ref="#/components/schemas/ContactStatusEnum"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status'
    ];

    protected function casts(): array {
        return [
            'status' => ContactStatus::class,
        ];
    }
}
