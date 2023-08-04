<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <div class="navbar-header fixed-brand">
                <a class="navbar-brand" href="index.html"><i class="fas fa-code"></i> Coding Zone</a>
                <a class="btn btn-primary mr" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample" id="menu-toggle-2">
                    <i style="font-size: 20px;" class="fas fa-bars"></i>
                </a>

            </div>
            <div class="user-profile">
                <div class="user-image">
                    <ul>
                        <li>
                            <a href="#"><i class="far fa-envelope"></i></a>
                            <div class="radius-shap">5</div>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-bell"></i></a>
                            <div class="radius-shap">3</div>
                        </li>
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="assets/images/u-xl-12.jpg" alt=""><span>Jahidul Islam <i
                                            class="fas fa-caret-down"></i></span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
                <div class="user-info">
                    <div class="user-child-profile">
                        <img src="assets/images/u-xl-12.jpg" alt="">
                        <span>Jahidul Islam</span>
                        <span>jahidulislamp383@gmail.com</span>
                    </div>
                    <div class="user_navbar">
                        <ul>
                            <li><a href="#"><i class="fas fa-user-plus"></i> Add User</a></li>
                            <li><a href="#"><i class="fas fa-user"></i> Profile</a></li>
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
