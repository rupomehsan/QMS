@extends('layouts.admin')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="tab-category">
                        <ul>
                            <li><a href="index.html"><i class="fas fa-home"></i>Dashboard</a></li>
                            <li><i class="fas fa-dot-circle"></i>Students</li>
                        </ul>
                    </div>
                    <div class="datas-tables bg-light rounded my-2 pt-4 pb-5 px-5">
                        <div class="d-flex justify-content-between">
                            <h5 class=" text-dark">All Students</h5>
                            <div class="dropdown d-none" id="bulkActions">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item " onclick="itemActions('active')">Active</a>
                                    <a class="dropdown-item" onclick="itemActions('inactive')">Deactive</a>
                                    <a class="dropdown-item" onclick="itemActions('delete')">Delete</a>
                                </ul>
                            </div>
                            <input type="search" class="form-control w-25" id="search_data" name="search_data">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"
                                onclick="resetHandler()"> Add New
                            </button>
                        </div>

                        <hr style="margin-block: 20px;">
                        <table style="padding-top: 20px;padding-bottom: 20px;"
                            class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th> <input type="checkbox" title="Select all" class="all-checker"> Sl No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='data_list'>


                            </tbody>
                        </table>
                        <ul id="paginateNav" class="pagination justify-content-end"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <span id="actionTitle">Add</span> Subject</h5>
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
                            <input type="number" class="form-control my-2" name="phone" id="phone"
                                onkeyup="clearError(this)">
                            <div class="text-danger" id="phone_error"></div>
                        </div>
                        <div class="password">
                            <label for="name">Password</label>
                            <input type="text" class="form-control my-2" name="password" id="password"
                                onkeyup="clearError(this)">
                            <div class="text-danger" id="password_error"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submit-button" type="submit" class="btn btn-primary ">Save
                            <span class="spinner-border mx-3 spinner-border-sm submit-loader d-none" role="status"
                                aria-hidden="true"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- resultModal -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Student Results
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body gap-3">
                        <div class="row gap-3 justify-content-center">
                            <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <h5 class="bg-secondary text-white py-2">HTML</h5>
                                    <p class="card-text fw-bold">Tital Marks : 10 </p>
                                    <p class="card-text fw-bold">Obtained Mark : 10 </p>
                                    <a href="#" class="btn btn-success">Passed</a>
                                </div>
                            </div>
                            <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <h5 class="bg-secondary text-white py-2">CSS</h5>
                                    <p class="card-text fw-bold">Tital Marks : 10 </p>
                                    <p class="card-text fw-bold">Obtained Mark : 10 </p>
                                    <a href="#" class="btn btn-success">Passed</a>
                                </div>
                            </div>
                            <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <h5 class="bg-secondary text-white py-2">JAVASCRIPT</h5>
                                    <p class="card-text fw-bold">Tital Marks : 10 </p>
                                    <p class="card-text fw-bold">Obtained Mark : 10 </p>
                                    <a href="#" class="btn btn-success">Passed</a>
                                </div>
                            </div>

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@push('custom_js')
    <script>
        /**
         * table generator;
         **/
        let url = window.origin + "/api/users?is_Admin=0";
        let headers = [{
                title: 'Sl No',
                field: 'id'
            },
            {
                title: 'Name',
                field: 'user_name'
            },
            {
                title: 'Email',
                field: 'email'
            },
            {
                title: 'Phone',
                field: 'phone'
            },

            {
                title: 'Status',
                field: 'status'
            },
            {
                title: 'Action',
                field: 'action'
            },
        ];

        let actions = [{
                label: 'Edit',
                url: "{{ url('/api/users/:id') }}",
                modal: true
            },
            {
                label: 'Delete',
                url: "{{ url('/api/users/:id') }}",
                param: "?is_Admin=0"
            },
            {
                label: 'Result',
                url: "{{ url('/api/users/:id') }}",
                modal: true
            },

        ]

        getAllData(url, "data_list", headers, actions);

        /**
         *search_data
         *search_data
         **/

        $(document).on("keyup", "#search_data", function() {
            let data = $(this).val();
            let url = window.origin + "/api/users?is_Admin=0";
            getSearchData(url, data, "data_list", headers, actions)
        })

        /**
         * Submit Form Data
         * Submit Form Data
         **/

        $('#formSubmit').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let editId = $("#id").val();
            let method = form.attr("method")
            let url = '';
            if (editId) {
                url = `${window.origin}/api/users/${editId}`;
            } else {
                url = window.origin + "/api/users?is_Admin=0";
            }

            let button = {
                "submitButton": "#submit-button",
                "loaderButton": ".submit-loader",
            }

            formSubmitLanding(url, method, form, button, cb = true);
        })

        /**
         * status controll;
         **/
        $(document).on("change", "#approval", function(e) {
            e.preventDefault();
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var id = $(this).data('id');
            // alert(id);
            if ($(this).prop('checked')) {
                var properties = 'active'
                // alert(properties)
            } else {
                var properties = 'inactive'
                //  alert(properties)
            }

            $.ajax({
                url: `${window.origin}/api/users/${id}`,
                type: "patch",
                dataType: "json",
                beforeSend: function() {
                    $("#preloader").removeClass('d-none');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: properties,
                },
                success: function(res) {
                    if (res.status === "success") {
                        toastr.success(res.message);
                    }
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422 && jqXhr.responseJSON.status == "error") {
                        toastr.error(jqXhr.responseJSON.message)
                    }
                },
                complete: function() {
                    $("#preloader").addClass('d-none');
                }
            }); //ajax
        });

        /**
         * bulk action;
         **/
        var checkLIstArray = []
        $(document).on("click", ".all-checker", function() {
            if ($(this).prop("checked") === true) {
                $(".checkbox-item").prop('checked', true)
                UpdatecheckList()
            } else {
                $(".checkbox-item").prop('checked', false)
                checkLIstArray = []
            }

            if (checkLIstArray.length > 0) {
                $("#bulkActions").removeClass("d-none")
            } else {
                $("#bulkActions").addClass("d-none")
            }

            // console.log(checkLIstArray)
        })

        $(document).on("click", ".checkbox-item", function() {
            if ($(this).prop("checked")) {
                checkLIstArray.push($(this).val())
            } else {
                const index = checkLIstArray.indexOf($(this).val());
                const x = checkLIstArray.splice(index, 1);
            }

            if (checkLIstArray.length > 0) {
                $("#bulkActions").removeClass("d-none")
            } else {
                $("#bulkActions").addClass("d-none")
            }
            // console.log(checkLIstArray)
        })

        function UpdatecheckList() {
            var checkItem = document.querySelectorAll('.checkbox-item');
            checkItem.forEach(function(item) {
                if (item.checked) {
                    var value = item.value
                    checkLIstArray.push(value)
                }
            })


        }

        function itemActions(action) {
            if (checkLIstArray.length === 0) {
                toastr.warning("Please select a item first")

            } else {
                // alert(checkLIstArray.length)
                $.ajax({
                    url: window.origin + "/api/users/bulk_actions",
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        $("#preloader").removeClass('d-none');
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        actions: action,
                        itemList: checkLIstArray
                    },
                    success: function(res) {
                        if (res.status === "success") {
                            toastr.success(res.message);
                            getAllData(url, "data_list", headers, actions);
                        }
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        if (jqXhr.status == 422 && jqXhr.responseJSON.status == "error") {
                            toastr.error(jqXhr.responseJSON.message)
                        }
                    },
                    complete: function() {
                        $("#preloader").addClass('d-none');
                    }
                }); //ajax
            }
        }
    </script>
@endpush
