<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';
    protected $primaryKey = 'speciality_id';

    public function students() {
        return $this->hasMany(Student::class, 'student_speciality_id');
    }
}
