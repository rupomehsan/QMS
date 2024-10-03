@extends('layouts.student')
@section('content')
    <div class="page-wrapper">
        <div class="exam-container my-5">
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
        getResultBySubject({{ request()->route('id') }})
    </script>
@endpush
