@extends('layouts.admin')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="tab-category">
                        <ul>
                            <li><a href="index.html"><i class="fas fa-home"></i> Dashboard</a></li>
                            <li><i class="fas fa-dot-circle"></i> Users</li>
                        </ul>
                    </div>
                    <div class="datas-tables bg-light rounded my-2 pt-4 pb-5 px-5">
                        <div class="d-flex justify-content-between">
                            <h5 class=" text-dark">All Users</h5>
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
                        <div class="table-relative">
                            <div class="product_placeholder ">
                                <div class="ph-item">
                                    <div class="ph-col-12">
                                        <div class="ph-picture"></div>
                                        <div class="ph-row">
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12 big"></div>
                                            <div class="ph-col-12"></div>
                                            <div class="ph-col-12"></div>
                                            <div class="ph-col-12"></div>
                                            <div class="ph-col-12"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <span id="actionTitle">Add</span> User</h5>
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
                        <div class="password-section">
                            <div class="hide-password">

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submit-button" type="submit" class="btn btn-primary "> <span
                                class="submit-button"></span>
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
                        <h5 class="modal-title" id="exampleModalLabel"> User Results
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body gap-3">
                        <div>
                            <p class="uppercase fw-bold text-center bg-info py-3">Quiz</p>
                        </div>
                        <div class="row gap-3 justify-content-center" id="allExam">

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
        let url = window.origin + "/api/users";
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
            let url = window.origin + "/api/users";
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
                url = window.origin + "/api/users";
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
                            $(".checkbox-item").prop('checked', false)
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
