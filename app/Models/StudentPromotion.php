<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentPromotion extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='student_promotion';
    protected $fillable = [
        'school_id ',
        'student_id',
        'old_session_id',
        'new_session_id',
        'old_class_id',
        'new_class_id',
        'old_section_id',
        'new_section_id',
        'promotion_date',
        'status',
        
    ];

 
}
