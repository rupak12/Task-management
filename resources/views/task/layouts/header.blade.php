<!--start wrapper-->
<div class="wrapper">
    <!--start top header-->
    <header class="top-header">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
                <i class="bi bi-list"></i>
            </div>
            <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i>
                </div>
                <input class="form-control" type="text" placeholder="Type here to search">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i>
                </div>
            </form>
            <div class="top-navbar-right ms-auto">
                <ul class="navbar-nav align-items-center gap-1">
                    <li class="nav-item search-toggle-icon d-flex d-lg-none">
                        <a class="nav-link" href="javascript:;">
                            <div class="">
                                <i class="bi bi-search"></i>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;">
                            <div class="">
                                <i class="bi bi-moon-fill"></i>
                            </div>
                        </a>
                    </li>


                </ul>
            </div>
            <div class="dropdown dropdown-user-setting">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    <div class="user-setting d-flex align-items-center gap-3">
                        <div class="d-none d-sm-block">
                            <p class="user-name mb-0" id="userName">
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class=""><i class="bi bi-lock-fill"></i></div>
                                <div class="ms-3" onclick="logoutAuthUser()"><span>Logout</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--end top header-->
