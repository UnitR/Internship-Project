@extends('layouts.master')

@section('content')
    <form action="{{ action('StudentsController@results') }}">
        <label for="name">Име: </label>
        <input type="text" name="name" id="name"/>
        <br />

        <label for="speciality">Специалност: </label>
        <select name="speciality" id="speciality">
            <option value="0">-</option>
            @foreach($specialities as $speciality)
                <option value="{{ $speciality->speciality_id }}">{{ $speciality->speciality_name_long }}</option>
            @endforeach
        </select>
        <br />

        <label for="course">Курс: </label>
        <select name="course" id="course">
            <option value="0">-</option>
            @foreach($courses as $course)
                <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
            @endforeach
        </select>
        <br />

        {{ csrf_field() }}
        <input type="submit" value="Търсене" />
    </form>
@endsection