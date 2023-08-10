<!DOCTYPE html>
<html lang="en">
@include('partials.header_link');

<body>

    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('assets/images/login.png') }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            Register
        </div>
        <form id="formSubmit" method="post" name="form" class="p-3 mt-3" autocomplete="off">
            <div class="form-field d-flex align-items-center user_name">
                <span class="fas fa-user"></span>
                <input type="text" name="user_name" id="user_name" placeholder="Username" onkeyup="clearError(this)">
            </div>
            <div class="text-danger" id="user_name_error"></div>


            <div class="form-field d-flex align-items-center email">
                <i class="fas fa-envelope-open"></i>
                <input type="email" name="email" id="email" placeholder="Email" onkeyup="clearError(this)">
            </div>
            <div class="text-danger" id="email_error"></div>

            <div class="form-field d-flex align-items-center password">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password" onkeyup="clearError(this)">
            </div>
            <div class="text-danger" id="password_error"></div>

            <div class="form-field d-flex align-items-center confirm_password">
                <span class="fas fa-key"></span>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"
                    onkeyup="clearError(this)">
            </div>
            <div class="text-danger" id="confirm_password_error"></div>

            <button type="submit" class="btn mt-3">Register</button>
        </form>
        <div class="text-center fs-6">
            <a href="{{ route('loginPage') }}">Already have an account ? <a href="{{ route('loginPage') }}">Login</a>
        </div>
    </div>
    @include('partials.footer_link')
    <script>
        /**
         * Submit Form Data
         * Submit Form Data
         **/
        $('#formSubmit').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let method = form.attr("method")
            let url = "api/register";
            let button = {
                "submitButton": "#submit-button",
                "loaderButton": ".submit-loader",
            }

            formSubmitLanding(url, method, form, button);
        })
    </script>
</body>

</html>
