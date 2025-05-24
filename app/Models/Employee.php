<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

        protected $fillable = [
        'user_id', 'employer_id', 'employee_id', 'position', 
        'department', 'salary', 'hire_date', 'phone', 'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

}
