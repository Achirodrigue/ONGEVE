@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container Fluid -->
          <div class="container">
               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header">
                                   <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                             <h5 class="card-title mb-1 anchor" id="responsive">
                                                  Mes différentes boutiques de la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        @if(modifAccessibleAdmin())
                                             <div>
                                                  <a href="{{ route('admin.vendeur.create') }}" class="btn btn-primary">
                                                       <i class="bx bx-plus me-1"></i>Ajouter
                                                  </a>
                                             </div>
                                        @endif
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($vendeurs->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Raison social</th>
                                                            <th scope="col">Gérant</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Compte</th>
                                                            <th scope="col">Localisation</th>
                                                            <th scope="col">Domaine d'activité</th>
                                                            <th scope="col">Logo</th>
                                                            <th scope="col">Nbre prdt</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($vendeurs as $vendeur)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $vendeur->nom_entreprise }}</td>
                                                                 <td>{{ $vendeur->nom_prenom_gerant }}</td>
                                                                 <td>{{ $vendeur->contact }}</td>
                                                                 <td>{{ $vendeur->email }}</td>
                                                                 <td>
                                                                      @if(modifAccessibleAdmin())
                                                                           <a href="{{ route('admin.vendeur.compte.update', $vendeur) }}">
                                                                                <span><button type="button" class="btn btn-sm @if($vendeur->isvalide) btn-light @else btn-danger @endif">
                                                                                     @if($vendeur->isvalide) active @else bloqué @endif
                                                                                </button></span>
                                                                           </a>
                                                                      @else
                                                                           <a href="#">
                                                                                <span><button type="button" class="disabled-btn btn-sm">
                                                                                     @if($vendeur->isvalide) active @else bloqué @endif
                                                                                </button></span>
                                                                           </a>
                                                                      @endif
                                                                 </td>
                                                                 <td>{{ $vendeur->adresse }}</td>
                                                                 <td>{{ $vendeur->domaine }}</td>
                                                                 <td>
                                                                      @if($vendeur->logo)
                                                                           <div class="swiper-slide avatar-sm">
                                                                                <div class="chat-user-status-box">
                                                                                     <span><img src="{{ asset(Storage::url($vendeur->logo)) }}" alt="avatar-2" data-bs-toggle="modal" data-bs-target="#imageModal{{ $vendeur->id }}" class="img-fluid avatar-sm rounded-circle avatar-border" /></span>
                                                                                </div>
                                                                           </div>
                                                                      @else Aucune @endif
                                                                 </td>
                                                                 <td>         
                                                                      <a @if($vendeur->produits->count() > 0) href="{{ route('admin.vendeur.produit', $vendeur) }}" @else href="#" @endif>                                              
                                                                           <button type="button" class="btn btn-sm btn-soft-warning px-3 fw-bold">{{ $vendeur->produits->count() }}</button>
                                                                      </a>  
                                                                 </td>
                                                                 <td>
                                                                      @if(modifAccessibleAdmin())
                                                                           <a href="{{ route('admin.vendeur.edit', $vendeur) }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                           </a>
                                                                           <a href="#" data-bs-toggle="modal" data-bs-target="#deleteVendeur{{ $vendeur->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                      @else
                                                                           <a href="#">
                                                                                <button type="button" class="btn-sm disabled-btn me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                           </a>
                                                                           <a href="#">
                                                                                <button type="button" class="btn-sm disabled-btn"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                      @endif
                                                                 </td>
                                                            </tr>

                                                            @include('include.vendeur')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucune boutique sur la plateformes
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body -->
                    </div> <!-- end col -->

                    <!--<div class="col-xl-3">
                         <div class="card docs-nav">
                              <ul class="nav bg-transparent flex-column">
                                   <li class="nav-item">
                                        <a href="#basic" class="nav-link">Basic Example </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#inverse" class="nav-link">Inverse Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#striped" class="nav-link">Striped Rows Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#hoverable-row" class="nav-link">Hoverable rows </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#active" class="nav-link">Active Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#bordered" class="nav-link">Bordered Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#border-color" class="nav-link">Bordered color Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#borderless" class="nav-link">Basic Borderless Example </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#small" class="nav-link">Small Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#alignment " class="nav-link">Alignment Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#nesting" class="nav-link">Nesting Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#head-option" class="nav-link">Table head options </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#tablefoot" class="nav-link">Tablefoot</a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#captions" class="nav-link">Captions</a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#responsive" class="nav-link">Always Responsive Table </a>
                                   </li>

                              </ul>
                         </div>
                    </div>-->
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


          
          

          


@endsection