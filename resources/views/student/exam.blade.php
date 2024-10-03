@extends('layouts.student')
@section('content')
    <div class="page-wrapper">
        <div class="exam-container my-5">
            <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
                <input type="hidden" name="subject_id" value="{{ request()->route('id') }}">
                <div class="row">
                    <h1 class="text-center text-info" id="examName"></h1>
                    <hr>
                    <div class="col-12" id="examQuestions">

                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center my-5"> <button class="btn btn-primary px-4 py-2 fw-bold">
                                Submit</button> </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        getAllQuestionBySubject({{ request()->route('id') }})

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
