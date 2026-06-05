<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningHabit extends Model
{
    protected $table = 'learning_habits';

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'id'
        );
    }
}
