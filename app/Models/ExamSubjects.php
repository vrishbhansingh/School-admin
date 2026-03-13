<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ExamSubjects extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='exam_subjects';
    protected $fillable = [
        'school_id ',
        'exam_id',
        'class_id',
        'subject_id',
        'exam_date',
        'duration',
        'start_time',
        'end_time',
        'max_marks',
        'pass_marks',
        'status',
    ];

 
}
