@extends('layouts.student')
@section('content')
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 position-relative">
                    <div class="card p-3 py-4">
                        <div class="d-flex gap-3" id="edit-button">
                            <button class="btn border" title="Edit Profile" data-bs-toggle="modal"
                                data-bs-target="#updateProfile"> <i class="fas fa-user-edit"></i></button>
                            <button class="btn border" title="Logout" onclick="logout()"> <i
                                    class="fas fa-sign-out-alt"></i></button>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/login.png') }}" width="100" height="100"
                                class="rounded-circle image border border-secondary shadow-lg">
                        </div>
                        <div class="text-center mt-3">
                            <h5 class="mt-2 mb-0 fw-bold user_name">Alexender Schidmt</h5>
                            <div class="px-4 mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50%">Email</th>
                                            <th scope="col" class="email"></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Phone</th>
                                            <th scope="col" class="phone"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div>
                                <p class="uppercase fw-bold text-center bg-info py-3">Quiz</p>
                            </div>
                            <div class="row gap-3 justify-content-center" id="allExam">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Profile
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body gap-3">
                            <div>
                                <label for="name">User Name</label>
                                <input type="text" class="form-control my-2" name="user_name" id="user_name"
                                    onkeyup="clearError(this)">
                                <div class="text-danger" id="user_name_error"></div>
                            </div>
                            <div>
                                <label for="name">Email</label>
                                <input type="email" class="form-control my-2" name="email" id="email"
                                    onkeyup="clearError(this)">
                                <div class="text-danger" id="email_error"></div>
                            </div>
                            <div>
                                <label for="name">Phone</label>
                                <input type="text" class="form-control my-2" name="phone" id="phone"
                                    onkeyup="clearError(this)">
                                <div class="text-danger" id="phone_error"></div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="submit-button" type="submit" class="btn btn-primary ">Update
                                <span class="spinner-border mx-3 spinner-border-sm submit-loader d-none" role="status"
                                    aria-hidden="true"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        $(function() {
            getAllExams()
        })

        /**
         * Submit Form Data
         * Submit Form Data
         **/
        $('#formSubmit').submit(function(e) {

            e.preventDefault();
            let form = $(this);
            let method = form.attr("method")
            let url = window.origin + "/api/update-profile";
            let button = {
                "submitButton": "#submit-button",
                "loaderButton": ".submit-loader",
            }

            formSubmitLanding(url, method, form, button, cb = false);
        })
    </script>
@endpush
