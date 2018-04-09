<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';

    public function assessments() {
        return $this->hasMany(Assessment::class, 'sa_student_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'student_course_id','course_id;=');
    }

    public function speciality() {
        return $this->belongsTo(Speciality::class, 'student_speciality_id', 'speciality_id');
    }

    //Calculates the average grade of the student rounded to two decimal places.
    public function avg_grade() {
        $avg = $this->assessments()->get()->avg('sa_assesment');

        return number_format((float)$avg, 2, '.', '');
    }

    public function total_lectures() {
        return $this->assessments()->get()->sum('sa_workload_lectures');
    }

    public function total_exercises() {
        return $this->assessments()->get()->sum('sa_workload_exercises');
    }
}
