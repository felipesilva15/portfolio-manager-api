<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
