<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'employee_id',
        'employer_id',
        'position',
        'department',
        'salary',
        'hire_date',
        'termination_date',
        'phone',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'hire_date' => 'date',
            'termination_date' => 'date',
            'salary' => 'decimal:2',
            'password' => 'hashed',
        ];
    }

    /**
     * If this user is an employer, they can have many employees.
     */
    public function employees()
    {
        return $this->hasMany(User::class, 'employer_id');
    }

    /**
     * If this user is an employee, they belong to one employer.
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
