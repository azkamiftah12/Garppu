<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        :root {
            --color-dark-blue: #363062;
            --color-soft-blue: #4D4C7D;
            --color-yellow: #F99417;
            --color-white: #F5F5F5;
            --color-white-brown: #EBE4D1
        }

        body {
            background-color: var(--color-white);
            color: var(--color-dark-blue);
        }

        .container-default {
            min-height: 90vh;
        }


        .navbar-bg {
            background-color: var(--color-dark-blue);
            color: var(--color-white);
        }

        .navbar-bg .navbar-nav .nav-link {
            color: var(--color-white);
        }

        .navbar-bg .navbar-nav .nav-item {
            transition: background-color 1s ease;
        }





        .navbar-bg .navbar-nav .nav-link:hover {
            color: var(--color-yellow);
            font-weight: bold;
        }

        .navbar-bg .navbar-nav .nav-item.active .nav-link {
            color: var(--color-yellow);
            font-weight: bold;
        }

        .navbar-collapse {
            margin-left: 60px
        }

        .footer {
            text-align: center;
        }

        .footer-bg {
            background-color: var(--color-dark-blue);
            color: var(--color-yellow)
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg border-bottom border-dark navbar-bg">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#"><img src="{{ asset('images/transparent-garppu-logo.png') }}"
                    alt="Garppu Logo" height="70"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link mx-3" href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="{{ url('/anggota-relawan') }}">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="{{ url('/quickcount') }}">Quick Count</a>
                    </li>
                    <li class="nav-item {{ request()->is('help') ? 'active' : '' }}">
                        <a class="nav-link mx-3" href="{{ url('/help') }}">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container container-default">
        @yield('content')
    </div>
    <footer class="footer mt-auto py-3 footer-bg text-center">
        <div class="container">
            <span>Copyright &copy; Garppu</span>
        </div>
    </footer>

    <!-- ... other body elements -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
