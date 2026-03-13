<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ExamResults extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='exam_results';
    protected $fillable = [
        'school_id ',
        'exam_id',
        'student_id',
        'total_marks',
        'obtained_marks',
        'percentage',
        'grade',
        'result_status',
        'status',
    ];

 
}
