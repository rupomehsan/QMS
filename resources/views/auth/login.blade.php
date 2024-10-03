<!DOCTYPE html>
<html lang="en">
@include('partials.header_link');

<body>

    <div class="container">
        <div class="row items-center justify-content-end">
            <div class="col-md-10">
                <div class="row items-center">
                    <div class="col-md-8">
                        <div class="wrapper">
                            <div class="logo">
                                <img src="{{ asset('assets/images/login.png') }}" alt="">
                            </div>
                            <div class="text-center mt-4 name">
                                Login
                            </div>
                            <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
                                <div class="form-field d-flex align-items-center email">
                                    <span class="far fa-user"></span>
                                    <input type="email" name="email" id="email" placeholder="email"
                                        onkeyup="clearError(this)">

                                </div>
                                <div class="text-danger" id="email_error"></div>
                                <div class="form-field d-flex align-items-center password ">
                                    <span class="fas fa-key"></span>
                                    <input type="password" name="password" id="password" placeholder="Password"
                                        onkeyup="clearError(this)">
                                    <i class="fas fa-eye-slash mx-3 cursor-pointer" onclick="iconChange()"></i>

                                </div>
                                <div class="text-danger" id="password_error"></div>

                                <button id="submit-button" type="submit" class="btn mt-3">Login
                                    <span class="spinner-border mx-3 spinner-border-sm submit-loader d-none"
                                        role="status" aria-hidden="true"></span></button>
                            </form>
                            <div class="text-center fs-6">
                                <a href="{{ route('registerPage') }}">Dont have an acoount </a> or <a
                                    href="{{ route('registerPage') }}">Sign up</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <table class="table tableWrapper table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tableData">

                                <tr>
                                    <th>admin@gmail.com</th>
                                    <td>123456</td>
                                    <td><button class="btn btn-secondary btn-sm"
                                            onclick="setCredential('admin@gmail.com','123456')">Copy</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('partials.footer_link')
    <script>
        $(function() {
            isAuthenticate()
        })

        /**
         * Submit Form Data
         * Submit Form Data
         **/
        $('#formSubmit').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let method = form.attr("method")
            let url = "api/login";
            let button = {
                "submitButton": "#submit-button",
                "loaderButton": ".submit-loader",
            }

            formSubmitLanding(url, method, form, button, cb = false);
        })

        /**
         * setCredential
         * setCredential
         **/
        function setCredential(email, password) {
            $("#email").val(email)
            $("#password").val(password)
        }


        function iconChange() {

            if ($("#password").attr('type') == 'text') {
                $("#password").attr('type', 'password')
                $('.cursor-pointer').removeClass('fa-eye-slash')
                $('.cursor-pointer').addClass('fa-eye')
            } else {
                $("#password").attr('type', 'text')
                $('.cursor-pointer').addClass('fa-eye-slash')
                $('.cursor-pointer').removeClass('fa-eye')
            }

        }
        /**
         * setCredential
         * setCredential
         **/
        getAllStudents()
    </script>
</body>




</html>
