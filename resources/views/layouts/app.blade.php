<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garppu</title>
    <link rel="icon" href="{{ asset('images/garppu-logo.png') }}" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg border-bottom border-dark navbar-bg fixed-top">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#"><img src="{{ asset('images/garppu-logo.png') }}"
                    alt="Garppu Logo" width="120" height="80"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link mx-3" href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::is('subrelawan') ? 'active' : '' }}">
                        <a class="nav-link mx-3" href="{{ url('/subrelawan') }}">AnggotaKu</a>
                    </li>
                    <li class="nav-item {{ Request::is('quickcount') ? 'active' : '' }}">
                        <a class="nav-link mx-3" href="{{ url('/quickcount') }}">Quick Count</a>
                    </li>
                    <li class="nav-item {{ request()->is('help') ? 'active' : '' }}">
                        <a class="nav-link mx-3" href="{{ url('/help') }}">Help</a>
                    </li>
                </ul>
            </div>
            <div class="ml-auto">
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
    <footer class="footer mt-auto py-3 footer-bg text-center">
        <div class="container">
            <span>Copyright &copy; Garppu</span>
        </div>
    </footer>

    {{-- <!-- ... other body elements -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
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
