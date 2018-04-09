@extends('layouts.master')

@section('content')
    <div class="container">
        @if(count($result) > 0)
            {{ $result->appends(request()->query())->links() }}
            <table class="table table-striped table-bordered table-hover table-condensed text-nowrap">
                <thead>
                    <tr>
                        <th colspan="3"></th>
                        <th colspan="{{ (sizeof($subjects) + 1)*3 }}">Предмети (хорариум и оценки)</th>
                    </tr>
                    <tr>
                        <th colspan="3">Ученици</th>
                        @foreach($subjects as $subject)
                            <th colspan="3">{{ $subject->subject_name }}</th>
                        @endforeach
                        <th colspan="3">Общо</th>
                    </tr>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>Име, Фамилия</th>
                        <th>Курс</th>
                        @for($j = 0; $j < sizeof($subjects) + 1; $j++)
                            <th>Лекции</th>
                            <th>Упражнения</th>
                            <th>Оценка</th>
                        @endfor
                    </tr>
                </thead>
                @foreach($result as $key=>$item)
                    @php
                        $total_lec = 0;
                        $total_ex = 0;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->student_fname . " " . $item->student_lname }}</td>
                        <td>{{ \App\Course::find($item->student_course_id)->course_name }}</td>

                        @foreach($subjects as $subject)
                            @if(sizeof($subject->assessments) > 0)
                                <td>
                                    {{ $subject->subject_workload_lectures }}
                                    ({{ $subject->getAssessments($item->student_id)->sa_workload_lectures }})
                                </td>
                                <td>
                                    {{ $subject->subject_workload_exercises }}
                                    ({{ $subject->getAssessments($item->student_id)->sa_workload_exercises }})
                                </td>
                                <td>
                                    {{ App\Assessment::grade($subject->getAssessments($item->student_id)->sa_assesment) }}
                                </td>
                                @php
                                    $total_lec += $subject->subject_workload_lectures;
                                    $total_ex += $subject->subject_workload_exercises;
                                @endphp
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <td>-</td>
                                @endfor
                            @endif
                        @endforeach
                        <td>
                            {{ $total_lec }}
                            ({{ $item->total_lectures() }})
                        </td>
                        <td>
                            {{ $total_ex }}
                            ({{ $item->total_exercises() }})
                        </td>
                        <td>{{ App\Assessment::grade($item->avg_grade()) }}</td>
                    </tr>
                @endforeach
            </table>
            {{ $result->appends(request()->query())->links() }}
        @else
            <h1>No results.</h1>
        @endif
    </div>
@endsection