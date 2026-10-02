@extends('layouts.navbar')
@section('title', 'Centre de Contrôle — DEL SARL')
@section('suite')
    <!-- row -->
    <div class="row mb-6 g-6">
        <div class="col-xl-8 col-lg-6">
            <div class="bg-gradient-mixed p-8 py-10 rounded-3 p-lg-7">
                <!--heading-->
                <h1 class="fs-3">👋 Bonjour admin,</h1>
                <p class="mb-0">Bienvenue sur le tableau de bord de DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL !</p>
<p>Gérez vos factures pro forma, bordereaux de livraison et factures clients en toute simplicité.</p>

            </div>
        </div>
       
    </div>
    <!-- row -->
    <!-- container -->
    <div class="custom-container">
        <div class="row g-6 mb-6">
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-success">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">Total Facturé (Mois)</div>
                            </div>
                            <div class="text-success-emphasis">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-shopping-cart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="19" r="2" />
                                    <circle cx="17" cy="19" r="2" />
                                    <path d="M5 6h14l-1 7h-12l-1 -7z" />
                                    <path d="M6 6l-2 -3" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">6</div>
                            {{-- <p class="mb-0">
                                <span class="text-success-emphasis">2</span>
                                <span class="text-secondary">finis</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-info">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>Pro Forma</div>
                            </div>
                            <div class="text-info-emphasis">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-alert-triangle">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 9v2m0 4v.01" />
                                    <path
                                        d="M5.07 19h13.86a2 2 0 0 0 1.74 -3l-6.93 -12a2 2 0 0 0 -3.48 0l-6.93 12a2 2 0 0 0 1.74 3z" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">132</div>
                            {{-- <p class="mb-0">
                                <span class="me-1 text-info-emphasis">28</span>
                                <span class="text-secondary">finis</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-danger">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>Bordereaux </div>
                            </div>
                            <div class="text-danger-emphasis">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">8</div>
                            {{-- <p class="mb-0">
                                <span class="me-1 text-danger-emphasis">2</span>
                                <span class="text-secondary">Clients</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-warning">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>Factures</div>
                            </div>
                            <div class="text-warning-emphasis">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icon-tabler-clock">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3 3" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">76</div>
                            {{-- <p class="mb-0">
                                <span class="text-warning-emphasis me-1">26</span>
                                <span class="text-secondary">personnes restants</span>
                            </p> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- row  -->



    </div>

    <div class="row g-12 mb-12">
        <div class="col-xl-12">
            <!-- card -->
            <div class="card card-lg">
                <!-- card header -->
                <div class="card-header border-bottom-0">
                    <div>
                        <h5 class="mb-0">Historique des Documents Générés</h5>
                    </div>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 table-centered table-hover">
                        <thead>
                            <tr>
                                <th>N° Référence</th>
                                <th>Client / Destinataire</th>
                                <th>Montant / Articles</th>
                                 <th>Date</th>
                                  <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#DU005</td>
                                <td>$150</td>
                                <td>Standard</td>
                                <td>Jan 20, 2025</td>
                                <td><span class="badge text-info-emphasis bg-info-subtle">Shipped</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">détails</a></td>
                            </tr>
                            <tr>
                                <td>#DU004</td>
                                <td>$200</td>
                                <td>Express</td>
                                <td>Jan 22, 2025</td>
                                <td><span class="badge text-warning-emphasis bg-warning-subtle">Pending</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU003</td>
                                <td>$300</td>
                                <td>Overnight</td>
                                <td>Jan 18, 2025</td>
                                <td><span class="badge text-danger-emphasis bg-danger-subtle">Cancel</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU002</td>
                                <td>$560</td>
                                <td>Overnight</td>
                                <td>Jan 13, 2025</td>
                                <td><span class="badge text-success-emphasis bg-success-subtle">Completed</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td>#DU002</td>
                                <td>$560</td>
                                <td>Overnight</td>
                                <td>Jan 11, 2025</td>
                                <td><span class="badge text-success-emphasis bg-success-subtle">Completed</span></td>
                                <td><a href="#!" class="btn btn-white btn-sm">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        const swiperBlog = new Swiper('#swiper-1', {
            slidesPerView: 1,
            spaceBetween: 100,
            speed: 900,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            }
        });

        document.querySelector('.swiper-next')
            .addEventListener('click', () => swiperBlog.slideNext());

        document.querySelector('.swiper-prev')
            .addEventListener('click', () => swiperBlog.slidePrev());
    </script>




@endsection
