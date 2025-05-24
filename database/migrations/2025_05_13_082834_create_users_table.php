<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Role: admin, employer, employee
            $table->enum('role', ['admin', 'employer', 'employee'])->default('employee');

            // Employee-specific info (nullable for others)
            $table->string('employee_id')->unique()->nullable(); // Internal employee code
            $table->unsignedBigInteger('employer_id')->nullable(); // Self-reference
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('hire_date')->nullable();
            $table->date('termination_date')->nullable();

            // Contact details
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();

            // Auth & timestamps
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // Self-referencing foreign key
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
