<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Applicant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country',
        'location',
        'education',
        'experience',
        'user_id',
        'title',
        'about',
        'skills',
        'salary',
        'job_type',
        'language',
        'highlights',
        'avatar',
        'resume',
        'looking_for_job',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applicant_experience(): HasMany
    {
        return $this->hasMany(ApplicantExperience::class);
    }

    public function applicant_education(): HasMany
    {
        return $this->hasMany(ApplicantEducation::class);
    }
}
