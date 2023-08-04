
@include('partials.admin.header')
      <!-- Sidebar -->
      @include('partials.admin.sitebar')
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
        @yield('content')
      <!-- /#page-content-wrapper -->
   </div>
@include('partials.admin.footer')
