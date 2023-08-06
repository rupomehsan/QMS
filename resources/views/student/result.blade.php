@extends('layouts.student')
@section('content')
    <div class="page-wrapper">
        <div class="exam-container my-5">

            <input type="hidden" name="subject_id" value="{{ request()->route('id') }}">
            <div class="row">
                <div class="col-12" id="examQuestions">

                </div>

            </div>

        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        getResultBySubject({{ request()->route('id') }})

        /**
         * Submit Form Data
         * Submit Form Data
         **/
        $('#formSubmit').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let method = form.attr("method")
            let url = window.origin + "/api/attempt-exam";
            let button = {
                "submitButton": "#submit-button",
                "loaderButton": ".submit-loader",
            }

            formSubmitLanding(url, method, form, button, cb = false);
        })
    </script>
@endpush
