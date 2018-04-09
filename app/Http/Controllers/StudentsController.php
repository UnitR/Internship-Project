<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Repositories;

class StudentsController extends Controller
{
    protected $students;
    protected $subjects;

    public function index()
    {
        return view('index');
    }

    //Load the search form.
    public function search()
    {
        $specialities = App\Speciality::get();
        $courses = App\Course::orderBy('course_id', 'ASC')->get();

        return view('layouts.search', compact('specialities', 'courses'));
    }

    //Find results based on the given parameters
    public function results(Request $request) {
        $name = $request->input('name');
        $speciality = $request->input('speciality');
        $course = $request->input('course');
        $query = App\Student::where('student_fname', 'LIKE', '%');

        if($name) {
            $query = $query->where('student_fname', 'LIKE', $name.'%');
        }

        if($course > 0) {
            $query = $query->where('student_course_id', '=', $course);
        }
        else if($speciality > 0) {
            $query = $query->where('student_speciality_id', '=', $speciality);
        }

        if($query) {
            $this->students = $query->orderBy('student_course_id', 'ASC')->paginate(10);
        }

        $result = $this->students;

        $this->subjects = App\Subject::orderBy('subject_id', 'ASC')->get();
        $subjects = $this->subjects;

        return view('students.results', compact('result', 'subjects'));
    }

    public function sort_id() {
        $result = array_reverse($this->students, true);
        $subjects = $this->subjects;

        return view('students.results', compact('result', 'subjects'));
    }

    public function details($id)
    {
        $student = Student::where('student_id', $id)->first();

        return view('students.details', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
