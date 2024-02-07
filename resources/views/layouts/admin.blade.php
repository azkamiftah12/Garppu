<!doctype html>
<html lang="en">

<head>
    <title>Garppu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Garppu merupakan singkatan dari Gerakan Pemantau Pemilu yang memiliki tujuan untuk memonitor kegiatan pemilu.">
    <link rel="icon" href="{{ asset('images/garppu-logo.png') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- datatables css depedency --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

    {{-- datatables js depedency --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    <style>
        .dataTables_length {
            margin-bottom: 20px;
            margin-right: 20px;
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
    @if (request()->getHost() == 'garppu.online')
        <div class="alert alert-danger text-center mb-0">
            This Website for Demo and Development. Go to <a href="https://garppu.com">garppu.com</a>
        </div>
    @endif
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

                    @if (Auth::user()->userRole === 'superadmin')
                        <!-- Add more admin-specific menu items here -->
                        <li class="{{ Request::is('superadmin/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('/superadmin/dashboard') }}">Home</a>
                        </li>
                        <li class="{{ Request::is('superadmin/batches') ? 'active' : '' }}">
                            <a href="{{ url('/superadmin/batches') }}">Batch Pemilihan</a>
                        </li>
                        <li class="{{ Request::is('superadmin/dapil') ? 'active' : '' }}">
                            <a href="{{ url('/superadmin/dapil') }}">Dapil</a>
                        </li>
                        <li class="{{ Request::is('superadmin/candidates') ? 'active' : '' }}">
                            <a href="{{ url('/superadmin/candidates') }}">Paslon</a>
                        </li>
                        <li class="">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">Users</a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li class="{{ Request::is('superadmin/admin') ? 'active' : '' }}">
                                    <a href="{{ url('/superadmin/admin') }}">Admin</a>
                                </li>
                                <li class="{{ Request::is('superadmin/relawan') ? 'active' : '' }}">
                                    <a href="{{ url('/superadmin/relawan') }}">Relawan</a>
                                </li>
                                <li class="{{ Request::is('superadmin/anggota-relawan') ? 'active' : '' }}">
                                    <a href="{{ url('/superadmin/anggota-relawan') }}">Anggota Relawan</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->userRole === 'admin')
                        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                        </li>
                        <li class="">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">Relawan</a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li class="{{ Request::is('admin/relawan') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/relawan') }}">Relawan</a>
                                </li>
                                <li class="{{ Request::is('admin/anggota-relawan') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/anggota-relawan') }}">Anggota Relawan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('admin/candidates') ? 'active' : '' }}">
                            <a href="{{ url('/admin/candidates') }}">Paslon</a>
                        </li>

                        <li class="">
                            <a href="#homeSubmenuVotes" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">Votes</a>
                            <ul class="collapse list-unstyled" id="homeSubmenuVotes">
                                <li class="{{ Request::is('admin/votes') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/votes') }}">Votes Log</a>
                                </li>
                                <li class="{{ Request::is('admin/votesacc*') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/votesacc') }}">Tervalidasi</a>
                                </li>
                                <li class="{{ Request::is('admin/votesnoacc*') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/votesnoacc') }}">Belum Tervalidasi</a>
                                </li>
                            </ul>
                        </li>
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
                <nav class="navbar navbar-expand-lg navbar-light bg-light mx-4 mx-md-5 mt-4 mt-md-5">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        <h2 style="color: var(--color-dark-blue); font-weight:700">
                            @if (Auth::user()->userRole === 'superadmin')
                                Super Admin
                            @endif
                            @if (Auth::user()->userRole === 'admin')
                                Admin
                            @endif
                        </h2>
                        <div></div>
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
            $('.datatable').DataTable({
                dom: 'lBfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                lengthMenu: [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, 'All']
                ],
            });
        });
    </script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
