<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';

    public function assessments() {
        return $this->hasMany(Assessment::class,'sa_subject_id' );
    }

    public function getAssessments($id) {
        return $this->assessments()->where('sa_student_id', '=', $id)->first();
    }
}
