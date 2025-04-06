<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'app_no',
        'uniName',
        'semester',
        'gpa',
        'cgpa',
        'resultFile',
        'feesFile',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'app_no', 'appNo');
    }
}
