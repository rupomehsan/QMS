<div id="sidebar-wrapper">
    <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
        <li class="active">
            <a href="{{ route('admin.dashboard') }}"><span class="fa-stack fa-lg pull-left"><i
                        class="fas fa-tachometer-alt"></i></span> Dashboard</a>
        </li>
        <li>
            <a href="{{ route('admin.subject') }}"><span class="fa-stack fa-lg pull-left"><i
                        class="far fa-edit"></i></span>Subject</a>
        </li>
        <li>
            <a href="{{ route('admin.question') }}"><span class="fa-stack fa-lg pull-left"><i
                        class="far fa-clone"></i></span>Question</a>
        </li>
        <li>
            <a href="{{ route('admin.student') }}"> <span class="fa-stack fa-lg pull-left"><i
                        class="fas fa-shopping-cart"></i></span>Student</a>
        </li>

    </ul>
</div>
