<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 *      @OA\Property(property="job_title", type="string", example="Desenvolvedor fullstack"),
 *      @OA\Property(property="avatar_url", type="string", format="url", example="http://localhost:8000/images/avatar.png"),
 *      @OA\Property(property="phone_number", type="string", example="11983432682"),
 *      @OA\Property(property="birth_date", type="string", format="date", example="2003-08-15"),
 *      @OA\Property(property="locality", type="string", example="São Paulo, SP"),
 *      @OA\Property(property="about", type="string", example="<p>Olá! Eu sou o Felipe!</p>"),
 *      @OA\Property(
 *          property="links", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Link")
 *      ),
 *      @OA\Property(
 *          property="testimonials", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Testimonial")
 *      ),
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
        'job_title',
        'avatar_url',
        'phone_number',
        'birth_date',
        'locality',
        'about'
    ];

    protected $with = [
        'links',
        'testimonials'
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
            'birth_date' => 'datetime:Y-m-d'
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

    public function links(): HasMany {
        return $this->hasMany(Link::class);
    }

    public function testimonials(): HasMany {
        return $this->hasMany(Testimonial::class);
    }
}
