<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSelectedFeature extends Model
{
    // 1. Beri tahu Laravel nama tabel aslinya
    protected $table = 'student_selected_features';

    // 2. Matikan timestamps karena tabel dari CSV ini tidak memilikinya
    public $timestamps = false;

    // 3. Izinkan semua kolom untuk diakses/diisi
    protected $guarded = [];
}
