<!DOCTYPE html>
<html lang="fr">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dasher/assets/libs/swiper/swiper-bundle.min.css') }}" />
    <!-- Favicon icon-->


    <meta name="msapplication-TileColor" content="#ffffff" />

    <meta name="theme-color" content="#ffffff" />
    <!-- Color modes -->
    <script src="{{ asset('dasher/assets/js/vendors/color-modes.js') }}"></script>

    <script>
        if (localStorage.getItem('sidebarExpanded') === 'false') {
            document.documentElement.classList.add('collapsed');
            document.documentElement.classList.remove('expanded');
        } else {
            document.documentElement.classList.remove('collapsed');
            document.documentElement.classList.add('expanded');
        }
    </script>

    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&amp;display=swap" />
    <link rel="stylesheet" href="{{ asset('dasher/assets/libs/simplebar/dist/simplebar.min.css') }}" />

    <link rel="shortcut icon" href="{{ asset('fav/favicon.ico') }}" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('dasher/assets/css/theme.min.css') }}">


    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css" />

    <!-- intl-tel-input JS -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SELECT2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SELECT2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">






</head>

<body>
    <!-- Vertical Sidebar -->
    <div>
        <div id="miniSidebar">
            <div class="brand-logo">
                <a class='d-none d-md-flex align-items-center gap-2' href='{{ route('dashboard') }}'>
                    <img src="assets/images/brand/logo/logo-icon.svg" alt="" />
                    <span class="fw-bold fs-4  site-logo-text">DEL SARL</span>
                </a>

            </div>

            <ul class="navbar-nav flex-column  ">
                <!-- Nav item -->
                <li class="nav-item">
                    <a class='nav-link' href='{{ route('dashboard') }}'><span class="nav-icon"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="currentColor"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 3v18h18" />
                                <path d="M20 18v3" />
                                <path d="M16 16v5" />
                                <path d="M12 13v8" />
                                <path d="M8 16v5" />
                                <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />
                            </svg> <span class="text">Tableau de bord</span></a>
                </li>

                <li class="nav-item">
                    <div class="nav-heading">Gestion DEL SARL</div>
                    <hr class="mx-5 nav-line mb-1" />
                </li>

                <!-- Nav item -->
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center justify-content-between" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="d-flex align-items-center gap-2">
                            <span class="nav-icon">
                                <!-- Icône Factures -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path
                                        d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                </svg>
                            </span>

                            <span class="text">Factures</span>
                        </div>

                        <!-- Flèche -->
                        <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6l6-6" />
                        </svg>
                    </a>

                    <ul class="dropdown-menu flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('facture.index') }}">Listes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('facture.create') }}">Créer</a>
                        </li>
                    </ul>
                </li>
                <!-- Nav item -->

                <!-- Nav item -->
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center justify-content-between" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="d-flex align-items-center gap-2">
                            <span class="nav-icon">
                                <!-- Icône Bons de commande -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4h16v16h-16z" />
                                    <path d="M8 8h8" />
                                    <path d="M8 12h8" />
                                    <path d="M8 16h5" />
                                </svg>
                            </span>

                            <span class="text">Pro Forma</span>
                        </div>

                        <!-- Flèche -->
                        <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6l6-6" />
                        </svg>
                    </a>

                    <ul class="dropdown-menu flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('proforma.index') }}">Listes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('proforma.create') }}">Créer</a>
                        </li>
                    </ul>
                </li>






                <!-- Nav item -->


                <!-- Nav item -->
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="d-flex align-items-center gap-2">
                            <span class="nav-icon">
                                <!-- Icône Quincaillerie -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icon-tabler-tool">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 6l7 7l-4 4l-7 -7" />
                                    <path d="M8 8l-5 5l4 4l5 -5" />
                                    <path d="M9 17l-2 2l-4 -4l2 -2" />
                                </svg>
                            </span>

                            <span class="text">Bordereau</span>
                        </div>

                        <!-- Flèche -->
                        <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6l6-6" />
                        </svg>
                    </a>

                    <ul class="dropdown-menu flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bordereau.index') }}">Listes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bordereau.create') }}">Ajouter</a>
                        </li>
                    </ul>
                </li>


                <!-- Bouton Profil Simple -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('profil.utilisateur') }}">
                        <span class="nav-icon">
                            <!-- Icône Profil (Utilisateur) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <span class="text">Profil</span>
                    </a>
                </li>

                <!-- Bouton Déconnexion Séparé -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit"
                            class="nav-link border-0 bg-transparent text-danger d-flex align-items-center gap-2 w-100">
                            <span class="nav-icon">
                                <!-- Icône Déconnexion -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icon-tabler-logout">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M9 12h12l-3 -3" />
                                    <path d="M18 15l3 -3" />
                                </svg>
                            </span>
                            <span class="text">Déconnexion</span>
                        </button>
                    </form>
                </li>
















            </ul>



        </div>


        {{-- <div class="offcanvasNav offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">

                <a class='d-flex align-items-center gap-2' href='index.html'>
                    <img src="assets/images/brand/logo/logo-icon.svg" alt="" />
                    <span class="fw-bold fs-4  site-logo-text">Kaoural</span>
                </a>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">

                <ul class="navbar-nav flex-column  ">
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class='nav-link' href='{{ route('dashboard') }}'><span class="nav-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="currentColor"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 3v18h18" />
                                    <path d="M20 18v3" />
                                    <path d="M16 16v5" />
                                    <path d="M12 13v8" />
                                    <path d="M8 16v5" />
                                    <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />
                                </svg> <span class="text">Tableau de bord</span></a>
                    </li>

                    <li class="nav-item">
                        <div class="nav-heading">Gestion Kaoural</div>
                        <hr class="mx-5 nav-line mb-1" />
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="6" cy="19" r="2" />
                                        <circle cx="17" cy="19" r="2" />
                                        <path d="M17 17h-11l-1 -12h-2" />
                                        <path d="M6 5h16l-1 7h-13" />
                                    </svg>
                                </span>

                                <span class="text">Ventes</span>
                            </div>

                            <!-- ICÔNE FLÈCHE PERSONNALISÉE -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Ajouter</a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <!-- Icône Stocks -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icon-tabler-box">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 3l8 4l-8 4l-8 -4z" />
                                        <path d="M4 7v10l8 4l8 -4v-10" />
                                        <path d="M12 11v10" />
                                    </svg>
                                </span>

                                <span class="text">Stocks</span>
                            </div>

                            <!-- ICÔNE FLÈCHE -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Ajouter</a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <!-- Icône Fournisseurs -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M17 11a4 4 0 1 0 -4 -4" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M15 21v-2a4 4 0 0 1 4 -4h2a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </span>

                                <span class="text">Fournisseurs</span>
                            </div>

                            <!-- Flèche -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Ajouter</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Nav item -->
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <!-- Icône Factures -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path
                                            d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                    </svg>
                                </span>

                                <span class="text">Factures</span>
                            </div>

                            <!-- Flèche -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Créer</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Nav item -->

                    <!-- Nav item -->
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <!-- Icône Bons de commande -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 4h16v16h-16z" />
                                        <path d="M8 8h8" />
                                        <path d="M8 12h8" />
                                        <path d="M8 16h5" />
                                    </svg>
                                </span>

                                <span class="text">Bons de commande</span>
                            </div>

                            <!-- Flèche -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Créer</a>
                            </li>
                        </ul>
                    </li>






                    <!-- Nav item -->


                    <!-- Nav item -->
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <!-- Icône Quincaillerie -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icon-tabler-tool">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 6l7 7l-4 4l-7 -7" />
                                        <path d="M8 8l-5 5l4 4l5 -5" />
                                        <path d="M9 17l-2 2l-4 -4l2 -2" />
                                    </svg>
                                </span>

                                <span class="text">Quincaillerie partenaire</span>
                            </div>

                            <!-- Flèche -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Ajouter</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Nav item -->
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center justify-content-between" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="d-flex align-items-center gap-2">
                                <span class="nav-icon">
                                    <!-- Icône Demande de devis -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" <svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icon-tabler-table">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <line x1="3" y1="9" x2="21" y2="9" />
                                        <line x1="3" y1="15" x2="21" y2="15" />
                                        <line x1="9" y1="3" x2="9" y2="21" />
                                        <line x1="15" y1="3" x2="15" y2="21" />
                                    </svg>
                                </span>

                                <span class="text">Demande de devis</span>
                            </div>

                            <!-- Flèche -->
                            <svg class="nav-chevron" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6-6" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">Listes</a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class='nav-link' href=''><span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icon-tabler-lock">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="5" y="11" width="14" height="10" rx="2" />
                                    <circle cx="12" cy="16" r="1" />
                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                </svg>
                            </span> <span class="text">Fermer ma section</span></a>
                    </li>



                </ul>


            </div>
        </div> --}}


        <!-- Main Content -->
        <div id="content" class="position-relative h-100">
            <!-- navbar -->
            <div class="navbar-glass navbar navbar-expand-lg px-0 px-lg-4">
                <div class="container-fluid px-lg-0">
                    <div class="d-flex align-items-center gap-4">
                        <!-- Collapse -->

                        <div class="d-block d-lg-none">
                            <a class="text-inherit" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                role="button" aria-controls="offcanvasExample">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 6l16 0" />
                                    <path d="M4 12l16 0" />
                                    <path d="M4 18l16 0" />
                                </svg>
                            </a>
                        </div>

                        <div class="d-none d-lg-block">
                            <a class="sidebar-toggle d-flex texttooltip p-3" href="javascript:void(0)"
                                data-template="collapseMessage">
                                <span class="collapse-mini">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-bar-left text-secondary">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 12l10 0" />
                                        <path d="M4 12l4 4" />
                                        <path d="M4 12l4 -4" />
                                        <path d="M20 4l0 16" />
                                    </svg>
                                </span>
                                <span class="collapse-expanded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-bar-right text-secondary">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M20 12l-10 0" />
                                        <path d="M20 12l-4 4" />
                                        <path d="M20 12l-4 -4" />
                                        <path d="M4 4l0 16" />
                                    </svg>
                                    <div id="collapseMessage" class="d-none">
                                        <span class="small">Collapse</span>
                                    </div>
                                </span>
                            </a>
                        </div>

                        <!-- Logo -->
                        <!-- <div class="d-block d-md-none">
        <a href="./index.html">
          <img src="./assets/images/brand/logo/logo-icon.svg" alt="" />
        </a>
      </div> -->
                    </div>

                    <!-- Navbar nav -->
                    <ul class="list-unstyled d-flex align-items-center mb-0 gap-2">
                        <li class="nav-item dropdown">
                            <button class="btn btn-ghost btn-icon rounded-circle d-flex align-items-center"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                aria-label="Toggle theme">

                                <!-- SVG LUNE -->
                                <svg class="theme-icon" xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3
               7 7 0 0 0 21 12.79Z" />
                                </svg>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <button class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="light">
                                        <span class="ms-2">Clair</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="dark">
                                        <span class="ms-2">Sombre</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="auto">
                                        <span class="ms-2">Par défaut</span>
                                    </button>
                                </li>
                            </ul>
                        </li>


                        <!-- Bell icon -->


                        <!-- Dropdown -->
                        <li class="ms-3 dropdown">
                            <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/avatar/avatar-1.jpg" alt=""
                                    class="avatar avatar-sm rounded-circle" />
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                                <div>
                                    <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-4 py-4">
                                        <img src="assets/images/avatar/avatar-1.jpg" alt=""
                                            class="avatar avatar-md rounded-circle" />
                                        <div>
                                            <h4 class="mb-0 fs-5">Jitu Chauhan</h4>
                                        </div>
                                    </div>

                                    {{-- <div class="p-3 d-flex flex-column gap-1">
                                        <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-home-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                    <path d="M10 12h4v4h-4z" />
                                                </svg>
                                            </span>
                                            <span>Home</span>
                                        </a>
                                        <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-inbox">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                    <path d="M4 13h3l3 3h4l3 -3h3" />
                                                </svg>
                                            </span>
                                            <span> Inbox</span>
                                        </a>
                                        <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-message">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M8 9h8" />
                                                    <path d="M8 13h6" />
                                                    <path
                                                        d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                                                </svg>
                                            </span>
                                            <span> Chat</span>
                                        </a>
                                        <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M3 12h4l3 8l4 -16l3 8h4" />
                                                </svg>
                                            </span>
                                            <span> Activity</span>
                                        </a>
                                        <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </span>
                                            <span> Account Settings</span>
                                        </a>
                                    </div> --}}

                                    <div class="border-dashed border-top mb-4 pt-4 px-6">
                                        <a href="#!" class="text-secondary d-flex align-items-center gap-2">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                    <path d="M3 12h13l-3 -3" />
                                                    <path d="M13 15l3 -3" />
                                                </svg>
                                            </span>
                                            <span>Se déconnecter</span></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!--Offcanvas notification-->
            {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotification"
                aria-labelledby="offcanvasNotificationLabel">
                <div class="sticky-top bg-white">
                    <div class="offcanvas-header gap-4">
                        <div class="d-flex justify-content-between w-100">
                            <h5 class="mb-0" id="offcanvasNotificationLabel">Notifications</h5>
                            <div class="d-flex gap-3 align-items-center">
                                <a href="#" class="link-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Mark all as read">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 12l5 5l10 -10" />
                                        <path d="M2 12l5 5m5 -5l5 -5" />
                                    </svg>
                                </a>
                                <a href="#" class="text-inherit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="mt-2">
                        <ul class="nav nav-line-bottom" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active px-4 py-2" id="pills-all-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-all" type="button" role="tab"
                                    aria-controls="pills-all" aria-selected="true">
                                    All
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4 py-2" id="pills-following-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-following" type="button" role="tab"
                                    aria-controls="pills-following" aria-selected="false">
                                    Following
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4 py-2" id="pills-archive-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-archive" type="button" role="tab"
                                    aria-controls="pills-archive" aria-selected="false">
                                    Archive
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                        aria-labelledby="pills-all-tab" tabindex="0">
                        <div data-simplebar="" style="height: 800px">
                            <div class="list-group list-group-flush">
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <div>New message from John Doe</div>
                                            <small class="text-secondary"> 2 minutes ago</small>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <div>Your password will expire soon.</div>
                                            <small class="text-secondary"> 2 minutes ago</small>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-1.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Alice uploaded a new profile picture.</div>
                                                <small class="text-secondary"> 1 hour ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-2.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Mike sent you a friend request.</div>
                                                <small class="text-secondary"> 5 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mt-4">
                                        <button type="button" class="btn btn-primary btn-sm">Accept</button>
                                        <button type="button" class="btn btn-white btn-sm">Decline</button>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-3.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Sophia commented on your post.</div>
                                                <small class="text-secondary"> 20 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-primary-subtle text-primary-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>A system update has been installed.</div>
                                                <small class="text-secondary"> 30 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-info-subtle text-info-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Reminder: Team meeting at 3:00 PM.</div>
                                                <small class="text-secondary"> 1 hour ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-danger-subtle text-danger-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Your order has been shipped!</div>
                                                <small class="text-secondary"> 2 hours ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-3.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Sophia commented on your post.</div>
                                                <small class="text-secondary"> 20 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-primary-subtle text-primary-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>A system update has been installed.</div>
                                                <small class="text-secondary"> 30 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-info-subtle text-info-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Reminder: Team meeting at 3:00 PM.</div>
                                                <small class="text-secondary"> 1 hour ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-danger-subtle text-danger-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Your order has been shipped!</div>
                                                <small class="text-secondary"> 2 hours ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-following" role="tabpanel"
                        aria-labelledby="pills-following-tab" tabindex="0">
                        <div data-simplebar="" style="height: 800px">
                            <div class="list-group list-group-flush">
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-info-subtle text-info-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Reminder: Team meeting at 3:00 PM.</div>
                                                <small class="text-secondary"> 1 hour ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-danger-subtle text-danger-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Your order has been shipped!</div>
                                                <small class="text-secondary"> 2 hours ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-3.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Sophia commented on your post.</div>
                                                <small class="text-secondary"> 20 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-primary-subtle text-primary-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>A system update has been installed.</div>
                                                <small class="text-secondary"> 30 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-info-subtle text-info-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Reminder: Team meeting at 3:00 PM.</div>
                                                <small class="text-secondary"> 1 hour ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div
                                                class="icon-shape icon-md bg-danger-subtle text-danger-emphasis rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div>Your order has been shipped!</div>
                                                <small class="text-secondary"> 2 hours ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-archive" role="tabpanel"
                        aria-labelledby="pills-archive-tab" tabindex="0">
                        <div data-simplebar="" style="height: 800px">
                            <div class="list-group list-group-flush">
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <div>New message from John Doe</div>
                                            <small class="text-secondary"> 2 minutes ago</small>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <div>Your password will expire soon.</div>
                                            <small class="text-secondary"> 2 minutes ago</small>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-1.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Alice uploaded a new profile picture.</div>
                                                <small class="text-secondary"> 1 hour ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4 align-items-center">
                                            <img src="assets/images/avatar/avatar-2.jpg" alt=""
                                                class="avatar avatar-md rounded-circle" />
                                            <div class="d-flex flex-column gap-1">
                                                <div>Mike sent you a friend request.</div>
                                                <small class="text-secondary"> 5 minutes ago</small>
                                            </div>
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-circle text-info">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mt-4">
                                        <button type="button" class="btn btn-primary btn-sm">Accept</button>
                                        <button type="button" class="btn btn-white btn-sm">Decline</button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div
                    class="px-5 py-3 text-center bg-white position-absolute bottom-0 border-top border-dashed w-100 text-center">
                    <a href="#!" class="text-inherit">View all</a>
                </div>
            </div> --}}

            <!-- Modal of pages -->
            {{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="search" class="form-control border-0 rounded-0 ps-0 form-focus-none"
                                id="globalSearchInput" placeholder="Search any word..." aria-label="Search"
                                aria-describedby="search-addon" />
                            <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal"
                                aria-label="Close">Esc</button>
                        </div>
                        <div class="modal-body" data-simplebar="" style="height: 400px">
                            <div class="mb-4">
                                <div class="d-flex flex-column border-bottom border-dashed py-4">
                                    <div class="mb-2">
                                        <span class="fw-semibold text-secondary small">Dashboard</span>
                                    </div>
                                    <div>
                                        <ul class="list-unstyled lh-lg mb-0">
                                            <li><a class='text-inherit'
                                                    href='dashboard/analytics.html'>Analytics</a></li>
                                            <li><a href="dashboard/project.html" class="text-inherit">Project</a>
                                            </li>
                                            <li><a class='text-inherit'
                                                    href='dashboard/ecommerce.html'>Ecommerce</a></li>
                                            <li><a class='text-inherit' href='dashboard/crm.html'>CRM</a></li>
                                            <li><a class='text-inherit' href='dashboard/finance.html'>Finance</a>
                                            </li>
                                            <li><a class='text-inherit' href='dashboard/blog.html'>Blog</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex flex-column border-bottom border-dashed py-4">
                                    <div class="mb-2">
                                        <span class="fw-semibold text-secondary small">Apps</span>
                                    </div>
                                    <div>
                                        <ul class="list-unstyled lh-lg mb-0">
                                            <li><a class='text-inherit' href='apps/calendar.html'> Calendar</a></li>
                                            <li><a class='text-inherit' href='apps/chat-app.html'> Chat</a></li>
                                            <li><a class='text-inherit' href='apps/email/mail'>Email</a></li>
                                            <li><a class='text-inherit'
                                                    href='apps/e-commerce/ecommerce-products'>Ecommerce</a></li>
                                            <li><a class='text-inherit' href='apps/kanban.html'> Kanban</a></li>
                                            <li><a class='text-inherit'
                                                    href='apps/project/project-grid.html'>Project</a></li>
                                            <li><a class='text-inherit' href='dashboard/file.html'> File Manager</a>
                                            </li>
                                            <li><a class='text-inherit' href='apps/crm/crm-contacts.html'> CRM</a>
                                            </li>
                                            <li><a class='text-inherit' href='apps/invoice/invoice-list.html'>
                                                    Invoice</a></li>
                                            <li><a class='text-inherit' href='apps/profile/profile-overview.html'>
                                                    Profile</a></li>
                                            <li><a class='text-inherit' href='apps/blog/blog-list.html'> Blog</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex flex-column border-bottom border-dashed py-4">
                                    <div>
                                        <span class="fw-semibold text-secondary small">Pages</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column border-bottom border-dashed py-4">
                                    <div>
                                        <span class="fw-semibold text-secondary small">Quick Links</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            @yield('suite')

        </div>

    </div>


    <script src="{{ asset('dasher/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dasher/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('dasher/assets/js/theme.min.js') }}"></script>
    <!-- jsvectormap -->
    <script src="{{ asset('dasher/assets/js/vendors/sidebarnav.js') }}"></script>
    <script src="{{ asset('dasher/assets/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('dasher/assets/libs/jsvectormap/dist/maps/world.js') }}"></script>
    <script src="{{ asset('dasher/assets/libs/jsvectormap/dist/maps/world-merc.js') }}"></script>
    <script src="{{ asset('dasher/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dasher/assets/js/vendors/chart.js') }}"></script>
    <script src="{{ asset('dasher/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('dasher/assets/js/vendors/choice.js') }}"></script>
    <script src="{{ asset('dasher/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dasher/assets/js/vendors/swiper.js') }}"></script>



</body>


</html>
