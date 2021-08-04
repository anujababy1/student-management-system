<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $table = 'marks';
    protected $fillable = [
        'student_id',
        'maths',
        'science',
        'history',
        'term'    
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function getTotalMarksAttribute($value)
    {
        return $this->science+$this->history+$this->maths;
    }
}
