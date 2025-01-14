<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" /><!-- create token csrf with ajax -->
    <title>{{ $title ?? '' }}</title>

    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/choices.js/public/assets/styles/choices.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/logo.png" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/logo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/shared/iconly.css">

    <!-- load datatable jquery -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css">
    <script type="text/javascript" src="{{ asset('assets') }}/extensions/jquery/jquery.min.js"></script>

    <!-- load grafiq -->
    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- end-load grafiq -->

    <!-- load sweet alert js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- end-load sweet alert js -->

    {{-- font family --}}
    <style>
        /* body {
            color: #0FAA5D;
        } */

        #hidden_div {
            display: none;
        }
        

        div.scrollmenu {
            background-color: #fff;
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollmenu img {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 2px;
            text-decoration: none;
        }

        div.scrollmenu img:hover {
            background-color: #0FAA5D;
        }

        .color-teks {
            color: #FFFFFF;
        }

        .style__font {
            text-align: justify;
        }

        .latar__belakang {
            background-color: #0FAA5D;
        }
    </style>
</head>

<body class="font-fami">
    <div id="app">
        <!-- sidebar content -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="/dist/img/logo.png" class="w-100" alt="404">
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item active">
                        <li class="sidebar-item">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dinas" class='sidebar-link'>
                                <i class="fas  fa-building"></i>
                                <span>Tentang dinas</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dataMaster" class='sidebar-link'>
                                <i class="fas  fa-qrcode"></i>
                                <span>Qr code</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/pegawai" class='sidebar-link'>
                                <i class="fas  fa-user"></i>
                                <span>Pegawai</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/tamu" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Tamu</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/users" class='sidebar-link'>
                                <i class="fas fa-users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/logout" class='sidebar-link'>
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- main content -->
        <div id="main">

            <!-- tombol menu on sidebar -->
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- content load content -->
            <main>
                @yield('content')

            </main>
        </div>
        <!-- footer -->
        <footer class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright_part_text text-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="footer-text m-0">
                                        Copyright &copy;
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script>
                                        Diskominfo | <span class="text-danger"></span> by
                                        PKL 2024 Stmik Lombok
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets') }}/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/js/app.js"></script>

    <!-- uncomment for load dashboard and chartJS -->
    <!-- <script src="{{ asset('assets') }}/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/dashboard.js"></script> -->

    <!-- load datatable jquery -->
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/datatables.js"></script>

</body>

</html>
