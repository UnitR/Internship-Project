<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';

    public function students() {
        return $this->hasMany(Student::class, 'student_course_id');
    }
}
