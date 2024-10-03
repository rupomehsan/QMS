<!DOCTYPE html>
<html lang="en">
@include('partials.header_link')

<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <div class="navbar-header fixed-brand">
                <a class="navbar-brand" href="index.html"><i class="fas fa-code"></i> Admin Panel</a>
                <a class="btn btn-primary mr" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample" id="menu-toggle-2">
                    <i style="font-size: 20px;" class="fas fa-bars"></i>
                </a>

            </div>
            <div class="user-profile">
                <div class="user-image">
                    <ul>
                        {{-- <li>
                            <a href="#"><i class="far fa-envelope"></i></a>
                            <div class="radius-shap">5</div>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-bell"></i></a>
                            <div class="radius-shap">3</div>
                        </li> --}}
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/images/u-xl-12.jpg') }}" alt="">
                                    <span> <span class="user_name"></span> <i class="fas fa-caret-down"></i></span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
                <div class="user-info">
                    <div class="user-child-profile">
                        <img src="{{ asset('assets/images/u-xl-12.jpg') }}" alt="">
                        <span class="user_name"></span>
                        <p class="email"></p>
                    </div>
                    <div class="user_navbar">
                        <ul>
                            <li>
                                <a href="javascript:void(0)" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Log
                                    Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Top End -->

    <div style="margin-top: 90px;" id="wrapper">
