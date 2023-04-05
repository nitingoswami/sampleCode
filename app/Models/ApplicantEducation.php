<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'applicant_id',
        'school',
        'degree',
        'field_of_study',
        'grade',
        'start_date',
        'end_date',
        'description',
    ];
}
