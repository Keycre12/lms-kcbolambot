<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles');
            $table->string('u_name');
            $table->string('u_email')->unique();
            $table->string('u_pass'); // Consider renaming to 'password' for Laravel conventions
            $table->enum('status', ['Active', 'Pending'])->default('Pending');
            $table->rememberToken(); // Added remember token
            $table->timestamps();
        });

        DB::table('users')->insert([
            'role_id' => 1,
            'u_name' => 'Admin Admin',
            'u_email' => 'admin@gmail.com',
            'u_pass' => Hash::make('password'),
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};