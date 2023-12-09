<!doctype html>
<html lang="en">

<head>
    <title>Garppu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Garppu merupakan singkatan dari Gerakan Pemantau Pemilu.">
    <link rel="icon" href="{{ asset('images/garppu-logo.png') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <style>
        .dataTables_length {
            margin-bottom: 20px;
        }

        @media (max-width: 575.98px) {
            h1 {
                font-size: 24px;
            }

            h5 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <div class="d-flex justify-content-center">

                    <a href="{{ url('/dashboard') }}"><img src="{{ asset('images/garppu-logo.png') }}" alt="Garppu Logo"
                            width="170" height="120">
                    </a>
                </div>
                <h4 class="text-center mb-5">Gerakan Pemantau Pemilu</h4>
                <ul class="list-unstyled components mb-5">
                    {{-- <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Home 1</a>
                            </li>
                            <li>
                                <a href="#">Home 2</a>
                            </li>
                            <li>
                                <a href="#">Home 3</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    <li class="{{ Request::is('subrelawan*') ? 'active' : '' }}">
                        <a href="{{ url('/subrelawan') }}">Anggotaku</a>
                    </li>
                    <li class="{{ Request::is('quickcount') ? 'active' : '' }}">
                        <a href="{{ url('/quickcount') }}">Quick Count</a>
                    </li>
                    <li class="{{ Request::is('help') ? 'active' : '' }}">
                        <a href="{{ url('/help') }}">Pusat Bantuan</a>
                    </li>
                    <li class="{{ Request::is('profileku*') ? 'active' : '' }}">
                        <a href="{{ url('/profileku') }}">ProfileKu</a>
                    </li>
                    @if (Auth::user()->userRole === 'admin')
                        <!-- Add more admin-specific menu items here -->
                        <li>
                            <a href="{{ url('/admin/dashboard') }}">Admin Menu</a>
                        </li>
                        <!-- Add more admin-specific menu items as needed -->
                    @endif
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-red my-5 py-2 w-100">Logout</button>
                    </form>
                </ul>

                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> Garppu
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <div class="position-sticky sticky-top">

                <nav class="navbar navbar-expand-lg navbar-light bg-light mx-4 mx-md-5 mt-4 mt-md-5 ">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        {{-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button> --}}

                        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Portfolio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </nav>
            </div>

            <div class="my-5">

                @yield('content')
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
