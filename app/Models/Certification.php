<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
