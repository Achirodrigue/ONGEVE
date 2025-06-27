@extends('dashboard.admin.layout.app')
@section('body')



            <!-- Start Container Fluid -->
            <div class="container-fluid">

                <!-- Start here.... -->
                <div class="row">
                @include('include.message')
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    <!-- $55.6k --> {{ $commandes->where("isvalide", 0)->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Nouvelles commande
                                                </p>
                                                <a href="{{ route('admin.nouvelle.commande') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:wallet-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-md-6 col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    {{ $produits->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Produit
                                                </p>
                                                <a href="{{ route('admin.produit.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                        <iconify-icon icon="solar:shop-2-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <div class="col-md-6 col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    {{ $vendeurs->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Boutique
                                                </p>
                                                <a href="{{ route('admin.vendeur.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:wallet-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-md col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                {{ $formations->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Formation
                                                </p>
                                                <a href="{{ route('admin.formation.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:hand-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <!-- end col -->
                            <div class="col-md-6 col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    {{ $categories->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Catégorie
                                                </p>
                                                <a href="{{ route('admin.categorie.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                        <iconify-icon icon="solar:shop-2-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-md col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    {{ $souscategories->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Sous Catégorie
                                                </p>
                                                <a href="{{ route('admin.scategorie.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:hand-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            
                            <div class="col-md col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                {{ $secteurs->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Zone de livraison
                                                </p>
                                                <a href="{{ route('admin.secteur.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:hand-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            
                            <div class="col-md-6 col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    {{ $livreurs->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Livreur
                                                </p>
                                                <a href="{{ route('admin.livreur.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                        <iconify-icon icon="solar:shop-2-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            
                            <div class="col-md col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                    {{ $formateurs->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Total Formateur
                                                </p>
                                                <a href="{{ route('admin.formateur.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:hand-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            
                            <div class="col-md col-lg-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-0 fw-bold mb-2">
                                                {{ $equipes->count() }}
                                                </h4>
                                                <p class="text-muted">
                                                    Infos Membres  de l'équipe
                                                </p>
                                                <a href="{{ route('admin.equipe.index') }}">
                                                    <span class="badge fs-12 badge-soft-success p-1">
                                                        <i class="ti ti-arrow-badge-up"></i> Tout Voir
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="avatar-lg d-inline-block me-1">
                                                    <span
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <iconify-icon icon="solar:hand-money-outline"
                                                            class="fs-32"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Solde géneral ({{ $soldedays->count() }})</h4>
                                <a href="#!" class="btn btn-sm btn-primary rounded-pill">{{ strrev(wordwrap(strrev($Gsolde->solde), 3, ' ', true)) }}F</a>
                            </div> <!-- end card-header-->
                            <!-- 
                            <div class="card-body p-0 pb-3">
                                <div class="p-3" data-simplebar style="max-height: 385px;">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-10.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-5" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Victoria P. Miller</a></h5>
                                            <p class="mb-0">no mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-9.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-6" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Dallas C. Payne</a></h5>
                                            <p class="mb-0">856 mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-8.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-7" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Florence A. Lopez</a></h5>
                                            <p class="mb-0">52 mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-7.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-8" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Gail A. Nix</a></h5>
                                            <p class="mb-0">12 mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-6.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-9" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Lynne J. Petty</a></h5>
                                            <p class="mb-0">no mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-5.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-5" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Victoria P. Miller</a></h5>
                                            <p class="mb-0">no mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-4.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-6" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Dallas C. Payne</a></h5>
                                            <p class="mb-0">856 mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-7" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Florence A. Lopez</a></h5>
                                            <p class="mb-0">52 mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-2.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-8" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Gail A. Nix</a></h5>
                                            <p class="mb-0">12 mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-1.jpg"
                                                class="img-fluid avatar-sm rounded me-2" alt="avatar-9" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fs-14"><a href="#!">Lynne J. Petty</a></h5>
                                            <p class="mb-0">no mutual friends</p>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    <i class="bx bxs-user-detail me-1"></i>See Profile
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bxl-telegram me-1"></i>Message to Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-user-x me-1"></i>Unfriend Victoria
                                                </a>
                                                <a href="javascript:void(0);" class="dropdown-item">
                                                    <i class="bx bx-block me-1"></i>Block Victoria
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-12 mx-auto">
                        <div class="card">
                            @if($soldedays->count() >= 1)
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Historiques des soldes par jour</h4>
                                    <div>
                                        <a href="{{ route('admin.historique.solde') }}" class="btn btn-sm btn-primary rounded-pill">
                                            Tout Voir
                                        </a>
                                    </div>
                                </div> <!-- end card-header-->

                                <div class="card-body p-0">
                                    <div data-simplebar style="max-height: 406px;">
                                        <table class="table text-nowrap table-hover mb-0 table-centered">
                                            <tbody>
                                                @foreach($soldedays as $soldeday)
                                                <tr>
                                                    <td>{{ $soldeday->date }}</td>
                                                    <td class="text-end"><span class="badge bg-success">{{ strrev(wordwrap(strrev($soldeday->solde), 3, ' ', true)) }}F</span></td>
                                                </tr>
                                                @endforeach
                                                <!-- <tr>
                                                    <td>24 April, 2024</td>
                                                    <td>$9.68</td>
                                                    <td><span class="badge bg-success">Cr</span></td>
                                                    <td>Affiliates </td>
                                                </tr>
                                                <tr>
                                                    <td>20 April, 2024</td>
                                                    <td>$105.22</td>
                                                    <td><span class="badge bg-danger">Dr</span></td>
                                                    <td>Grocery </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card body -->
                            @else
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Historiques des soldes par jour</h4>
                                    <div>
                                        <a href="#" class="btn btn-sm btn-primary rounded-pill">
                                            Aucun
                                        </a>
                                    </div>
                                </div> <!-- end card-header-->
                            @endif
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                </div> <!-- end row-->

            </div>
            <!-- End Container Fluid -->

            


@endsection