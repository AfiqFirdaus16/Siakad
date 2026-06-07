<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Beri tahu Laravel bahwa primary key-nya sekarang bernama 'user_id'
    protected $primaryKey = 'user_id';

    protected $guarded = [];
    protected $table = 'students';
    public $timestamps = false;
}
