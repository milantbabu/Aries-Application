@php
    $current_route = Request::route()->getName();
    // echo $current_route;
@endphp
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('exams')}}">
        <div class="sidebar-brand-icon">
            <img class="logoicon" src="{{ asset('assets/img/logo.png') }}">
        </div>
        <div class="sidebar-brand-logo">
            <img class="logoicon" src="{{ asset('assets/img/logo.png') }}">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider d-md-block">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{in_array($current_route, ['exams', 'questions', 'attend', 'startExam', 'thankYou'])? 'active' : ''}}">
        <a class="nav-link" href="{{ route('exams') }}">
            <i class="fas fa-graduation-cap" data-toggle="tooltip" data-placement="right" title="Exams"></i>
            <span>Exams</span>
        </a>
    </li>
    <li class="nav-item {{in_array($current_route, ['results'])? 'active' : ''}}">
        <a class="nav-link" href="{{ route('results') }}">
            <i class="fas fa-user" data-toggle="tooltip" data-placement="right" title="Result"></i>
            <span>Result</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


</ul>
<!-- End of Sidebar -->
