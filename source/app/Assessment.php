<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'students_assessments';
    protected $primaryKey = 'sa_id';

    public function student() {
        return $this->belongsTo(Student::class, 'sa_student_id', 'student_id');
    }

    public function subject() {
        return $this->belongsTo(Subject::class, 'sa_subject_id', 'subject_id');
    }

    public static function grade($grade) {
        if($grade <= 2.49) {
            $gr = 'Слаб';
        }

        if($grade >= 2.5 && $grade <= 3.49) {
            $gr = 'Среден';
        }

        if($grade >= 3.5 && $grade <= 4.49) {
            $gr = 'Добър';
        }

        if($grade >= 4.5 && $grade <= 5.49) {
            $gr = 'Много добър';
        }

        if($grade >= 5.5 && $grade <= 6) {
            $gr = 'Отличен';
        }

        $gr .= " ($grade)";
        return $gr;
    }
}
