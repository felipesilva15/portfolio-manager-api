<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *      schema="User",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="Felipe Silva", minLength=3, maxLength=255),
 *      @OA\Property(property="email", type="string", format="email", example="felipe.allware@gmail.com", minLength=3, maxLength=255),
 *      @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-04-28T13:23:31.000000Z"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier(): mixed {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array {
        return [];
    }

    public function getAuthPassword(): string {
        return $this->password;
    }
}
