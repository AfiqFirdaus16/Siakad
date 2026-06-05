<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            // Primary Key yang otomatis berurut
            $table->id('user_id');

            // Identitas Siswa
            $table->string('NISN')->nullable()->unique();
            $table->string('name')->nullable();

            // Variabel Akademik (SIAKAD)
            $table->integer('Exam_Score')->nullable();
            $table->integer('Attendance')->nullable();
            $table->integer('Previous_Scores')->nullable();

            // Variabel Kebiasaan Belajar (Kuesioner/Fitur SBP)
            $table->integer('Hours_Studied')->nullable();
            $table->integer('Tutoring_Sessions')->nullable();
            $table->integer('Physical_Activity')->nullable();
            $table->integer('Sleep_Hours')->nullable();

            // Variabel Akses (Kategori/Teks)
            $table->string('Access_to_Resources')->nullable();

            // Otomatis membuat kolom created_at dan updated_at
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
