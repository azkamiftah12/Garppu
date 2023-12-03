<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garppu</title>
    <meta name="description" content="Garppu merupakan singkatan dari Gerakan Pemantau Pemilu.">
    <link rel="icon" href="{{ asset('images/garppu-logo.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <style>
        .dataTables_length {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom border-dark navbar-bg fixed-top">
        <div class="container">
            <a class="navbar-brand mr-auto" href="/dashboard"><img src="{{ asset('images/garppu-logo.png') }}"
                    alt="Garppu Logo" width="120" height="80"></a>
            <div class="d-none d-md-block me-5">
                <h4>Admin</h4>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end navbar-bg" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a class="navbar-brand mr-auto" href="/admin/dashboard"><img
                            src="{{ asset('images/garppu-logo.png') }}" alt="Garppu Logo" width="120"
                            height="80"></a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                        style="background-color: var(--color-red)"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav" style="font-weight: 600">
                        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a class="nav-link mx-3" href="{{ url('/admin/dashboard') }}">Home</a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/relawan') ? 'active' : '' }}">
                            <a class="nav-link mx-3" href="{{ url('/admin/relawan') }}">Relawan</a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/anggota-relawan') ? 'active' : '' }}">
                            <a class="nav-link mx-3" href="{{ url('/admin/anggota-relawan') }}">Anggota Relawan</a>
                        </li>
                    </ul>
                </div>
                <div class="ml-auto d-xs-flex d-sm-flex d-md-none mt-auto">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-red py-3 w-100">Logout</button>
                    </form>
                </div>

            </div>
            <div class="ml-auto d-none d-md-block">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-red">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container container-default">
        <div class="container my-5">

            @yield('content')
        </div>
    </div>
    <footer class="footer mt-auto py-3 footer-bg text-center container-fluid">
        <div class="container-fluid">
            <span>Copyright &copy; Garppu</span>
        </div>
    </footer>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>


</html>