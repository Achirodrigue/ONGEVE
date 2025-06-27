@extends('dashboard.admin.layout.app')
@section('body')


            <!-- Start Container Fluid -->
            <div class="container-xxl">
                <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                            <div>
                                                <ol class="breadcrumb mb-0">
                                                    <li class="breadcrumb-item fw-medium">
                                                        <h4 class="text-dark mb-0">
                                                            Mes différentes formations finalisées sur la plateforme
                                                        </h4>
                                                    </li>
                                                </ol>
                                            </div>

                                            <div>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('admin.formation.create') }}"
                                                        class="btn btn-outline-secondary me-1 "><i class="bx bx-plus"></i>
                                                        Nouvelle formation
                                                    </a>
                                                    <a href="{{ route('admin.formation.index') }}" class="btn btn-primary">
                                                        <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                                    </a>
                                                </div>
                                            </div>
                                    </div>

                                    @include('include.message')
                                </div>
                            </div>
                        </div>
                </div>


                @if($formations->count() > 0)
                    <div class="row">
                        @foreach($formations as $formation)
                            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                                <div class="card produit h-100">
                                    <img src="{{ asset(Storage::url($formation->image)) }}" alt="" class="img-fluid ">
                                    <div class="card-body">
                                        <a href="ecommerce-product-details.html"
                                            class="text-dark fw-medium fs-16 text-truncate d-block">
                                            {{ $formation->nom }}
                                        </a>

                                        <div class="my-1">
                                            <div>
                                                <p>@if($formation->description) {{ $formation->description }} @else Aucune description @endif</p>
                                            </div>
                                            <div class="d-flex gap-2 text-truncate">
                                                <a href="{{ route('admin.postulation.formation', $formation) }}">
                                                    <p class="fw-medium fs-15 text-dark mb-0">
                                                        Postulation : <span class="text-warning fs-13">{{ $formation->pformations->count() }} Post</span>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>

                                        <hr class="mx-n3">
                                        <div class="my-1">
                                            <div class="d-flex gap-2 text-truncate">
                                                <p class="fw-medium fs-15 text-dark mb-0">
                                                    Prix : <span class="text-warning fs-13">{{ getprice($formation->prix) }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex gap-2 text-truncate">
                                                <p class="fw-medium fs-15 text-dark mb-0">
                                                    Date de debut : <span class="text-warning fs-13">{{ dateFormate($formation->date_debut) }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex gap-2 text-truncate">
                                                <p class="fw-medium fs-15 text-dark mb-0">
                                                    Date de fin : <span class="text-warning fs-13">{{ dateFormate($formation->date_fin) }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex gap-2 text-truncate">
                                                <p class="fw-medium fs-15 text-dark mb-0">
                                                    Lieu : <span class="text-warning fs-13">{{ $formation->lieu }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex gap-2 text-truncate">
                                                <p class="fw-medium fs-15 text-dark mb-0">
                                                    Heure : <span class="text-warning fs-13">{{ $formation->heure }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- <hr class="mx-n3">  

                                        <div class="d-flex align-items-center mt-3 ">
                                            <div class="d-flex flex-wrap gap-2">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.formation.edit', $formation) }}">
                                                        <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark as spam" data-bs-original-title="Mark as spam">
                                                            <i class="bx bx-edit fs-18"></i>
                                                        </button>
                                                    </a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteFormation{{ $formation->id }}">
                                                        <button type="button" class="btn btn-light"><i class="bx bx-trash fs-18"></i></button>
                                                    </a>
                                                </div>

                                                <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Folder">
                                                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-folder fs-18"></i> Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.etat.formation.update', $formation) }}">Etat : 
                                                                @if($formation->isvalide)
                                                                    <span class="text-warning">Activé</span>
                                                                @else
                                                                    <span class="text-danger">Désactivé</span>
                                                                @endif
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('admin.postulation.formation', $formation) }}">Postulation : Voir
                                                                @if($formation->isvalide)
                                                                    <span class="text-warning">Activé</span>
                                                                @else
                                                                    <span class="text-danger">Désactivé</span>
                                                                @endif
                                                            </a>
                                                        </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                @include('include.formation')
                            </div>                    
                        @endforeach
                    </div>

                    <!-- @if($formations->count() >= 15)@endif -->
                        <div class="py-3 border-top">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item">{{ $formations->links() }}</li>
                                </ul>
                            </nav>
                        </div>
                    
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-2">
                                <div class="card-header border-0">
                                    <h4 class="fw-bold text-center">
                                        Désolé! Aucune formation finalisée disponible sur la plateforme.
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- End Container Fluid -->


@endsection