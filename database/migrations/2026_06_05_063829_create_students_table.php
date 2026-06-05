<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            // Ini akan membuat kolom bernama 'user_id' yang otomatis berurut dari 1, 2, 3, dst.
            $table->id('user_id');

            // Tambahkan kolom lain sesuai kebutuhan data Anda
            $table->string('nisn')->nullable()->unique();
            $table->string('name')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
