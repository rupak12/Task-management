<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--plugins-->
    <link href="{{ url('assets/task/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ url('assets/task/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ url('assets/task/css/pace.min.css') }}" rel="stylesheet" />


    <!--Theme Styles-->
    <link href="{{ url('assets/task/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/task/css/header-colors.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('assets/css/toastr.min.css') }}">

    <title>User Dashboard</title>
</head>

<body>
    @include('task.layouts.header')
    @include('task.layouts.sidebar')

    @yield('content')

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--start footer-->
    <footer class="footer">
        <div class="footer-text">
            Copyright © 2024. Rupak Manna All right reserved.
        </div>
    </footer>
    <!--end footer-->


    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->


    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src="{{ url('assets/task/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ url('assets/task/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/task/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/task/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('assets/task/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/task/js/pace.min.js') }}"></script>
    <!--app-->
    <script src="{{ url('assets/task/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/task/js/task-submit.js') }}"></script>

    <script>
        var fetchAuthUserUrl = "{{ route('fetchAuthUser') }}";
        var logoutAuthUserUrl = "{{ route('userLogout') }}";
        var loginPageUrl = "{{ route('login') }}";
        var csrfToken = "{{ csrf_token() }}"
        var editTaskUrl = "{{ route('editTask', ':id') }}";

        $(function() {
            $.get('/sanctum/csrf-cookie').done(function() {
                // Fetch Authenticated User and display them
                fetchAuthUser();
            });
        });
    </script>
    @yield('js')
</body>

</html>
