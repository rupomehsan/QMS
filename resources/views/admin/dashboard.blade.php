@extends('layouts.admin')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-3 ">
                    <div class="media widget-media p-4 bg-white border">
                        <div class="icon rounded-circle mr-4 bg-primary">
                            <!-- <i class="mdi mdi-account-outline text-white "></i> -->
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <h4 class="text-primary mb-2 users">00 </h4>
                            <p>Total Students</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="media widget-media p-4 bg-white border">
                        <div class="icon rounded-circle bg-warning mr-4">
                            <i class="fas fa-shopping-bag text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <h4 class="text-primary mb-2 subjects"> 00</h4>
                            <p>Total Subjects</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="media widget-media p-4 bg-white border">
                        <div class="icon rounded-circle mr-4 bg-danger">
                            <i class="fas fa-money-check-alt text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <h4 class="text-primary mb-2 questions">00</h4>
                            <p>Total Questions</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


@push('custom_js')
    <script>
        $(function() {
            getStatistics()
        })
    </script>
@endpush
