<!-- partial -->
@include('partials.footer_link');


<script>
    $(function() {
        if (credentials) {
            if (credentials.information.is_Admin != 1) {
                window.location.href = '/'
            }
            fetchMe()
        } else {
            window.location.href = '/'
        }

    })

    function logout() {
        let text = "Are you want to logedout\nEither Yes or Cancel.";
        if (confirm(text) == true) {
            localStorage.removeItem("credentials")
            window.location.href = '/'
        }

    }
</script>


@stack('custom_js')
</body>

</html>
