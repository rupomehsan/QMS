@extends('layouts.admin')
@section('content')
    <div id="page-content-wrapper">

        <div class="page-wrapper">
            <div class="exam-container my-5">
                <div class="w-50 m-auto  py-1 my-2 bg-info px-2 pt-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <h4 class="border-end px-3">Student Name : <span class="student_name fw-bold"></span></h4>

                        <h5 class="mt-2 px-3">Obtained Mark : <span class="obtained_mark fw-bold"></span></h5>
                    </div>
                </div>
                <div class="row">
                    <h1 class="text-center text-info" id="examName"></h1>
                    <hr>
                    <div class="col-12" id="examResults"> </div>
                </div>

            </div>
        </div>
    @endsection
    @push('custom_js')
        <script>
            getResultBySubjectWithStudentID({{ request()->route('id') }}, {{ request()->route('std_id') }})
        </script>
    @endpush
