<!DOCTYPE html>
<html lang="en">
@include('partials.header_link')

<body>
    <!-- Page Content -->
    @yield('content')
    <!-- /#page-content-wrapper -->


    @include('partials.footer_link')
    <script>
        $(function() {
            checkStudentPermission()
            fetchMe()
        })
    </script>
    @stack('custom_js')


</body>

</html>
