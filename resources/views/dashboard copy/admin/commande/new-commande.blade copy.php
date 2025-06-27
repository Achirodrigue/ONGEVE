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
                                                  Mes différentes Commandes en cour de validation sur la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.livraison.effectue') }}" class="btn btn-primary">
                                                  <i class="bx bx-plus me-1"></i>Déjà livré
                                             </a>
                                             <a href="{{ route('admin.livraison.commmande.encours') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-left me-1'></i> Livraison en cours
                                             </a>
                                             @if(auth()->user()->role)
                                                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteCommandeGenerale">
                                                       <i class="bx bx-trash me-1"></i> Generales
                                                  </a>
                                             @endif
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($commandesecteurs->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Prenom</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Adresse livraison</th>
                                                            <th scope="col">Total à payer</th>
                                                            <th scope="col">Detail</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                            
                                                       @endphp
                                                  
                                                       @foreach($commandesecteurs as $commandesecteur)
                                                            @if(!$commandesecteur->commande->commandelivreur)
                                                                 <tr>
                                                                      <td>
                                                                           <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                      </td>
                                                                      <td>{{ $commandesecteur->commande->client->nom }}</td>
                                                                      <td>{{ $commandesecteur->commande->client->prenom }}</td>
                                                                      <td>{{ $commandesecteur->commande->client->contact }}</td>
                                                                      <td>{{ $commandesecteur->commande->adresse_livraison }}</td>
                                                                      <td>
                                                                           <span><button type="button" class="btn btn-sm btn-warning">
                                                                           {{ strrev(wordwrap(strrev($commandesecteur->commande->total_prix + $commandesecteur->commande->frais_livraison), 3, ' ', true)) }}F
                                                                           </button></span>
                                                                      </td>
                                                                      <td>
                                                                           <a href="{{ route('admin.commande.produit', $commandesecteur->commande) }}">
                                                                                <span><button type="button" class="btn btn-sm btn-light">
                                                                                Details
                                                                                </button></span>
                                                                           </a>     
                                                                      </td>
                                                                      <!-- <td>                                                                 
                                                                           <button type="button" class="btn btn-sm btn-soft-warning px-3 fw-bold">{{ $commandesecteur->commande->id }}</button>
                                                                      </td> -->
                                                                      <td>
                                                                           <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#validerCommande{{ $commandesecteur->commande->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i>Valider</button>
                                                                           </a>
                                                                           <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCommande{{ $commandesecteur->commande->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                           <a href="{{ route('admin.pdf.commande', $commandesecteur->commande) }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class='bx bxs-file-pdf'></i></button>
                                                                           </a> -->
                                                                           <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                     <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 22.4px, 0px);">
                                                                                     <!-- <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#validerCommande{{ $commandesecteur->commande->id }}">
                                                                                          <i class="bx bx-edit fs-16"></i> Valider
                                                                                     </a> -->
                                                                                     <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCommande{{ $commandesecteur->commande->id }}">
                                                                                          <i class="bx bx-trash fs-16"></i> Supprimer
                                                                                     </a>
                                                                                     <a href="{{ route('admin.pdf.commande', $commandesecteur->commande) }}" class="dropdown-item">
                                                                                          <i class='bx bxs-file-pdf'></i> Format pdf
                                                                                     </a>
                                                                                     <a href="#" class="dropdown-item" 
                                                                                          @if(Auth()->user()->livreurs->count() > 0 || Auth()->user()->role) data-bs-toggle="modal" data-bs-target="#AffecterLivreurCommande{{ $commandesecteur->commande->id }}" @endif >
                                                                                          <i class="bx bxs-user-detail me-1"></i> Affecter commande
                                                                                     </a>
                                                                                <!-- <a href="#!" class="dropdown-item">
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
                                                                                     </a> -->
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                 </tr>
                                                            @endif

                                                            @include('include.commande2')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez aucune commande en attente sur la plateformes
                                        </h5>
                                   @endif
                                   
                              </div>




                              <div class="card-body">
                                   @if($commandes->count() > 0 && commandes() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Prenom</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Adresse livraison</th>
                                                            <th scope="col">Total à payer</th>
                                                            <th scope="col">Detail</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                            
                                                       @endphp
                                                  
                                                       @foreach($commandes as $commande)
                                                            @if(!$commande->commandelivreur)
                                                                 <tr>
                                                                      <td>
                                                                           <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                      </td>
                                                                      <td>{{ $commande->client->nom }}</td>
                                                                      <td>{{ $commande->client->prenom }}</td>
                                                                      <td>{{ $commande->client->contact }}</td>
                                                                      <td>{{ $commande->adresse_livraison }}</td>
                                                                      <td>
                                                                           <span><button type="button" class="btn btn-sm btn-warning">
                                                                           {{ strrev(wordwrap(strrev($commande->total_prix + $commande->frais_livraison), 3, ' ', true)) }}F
                                                                           </button></span>
                                                                      </td>
                                                                      <td>
                                                                           <a href="{{ route('admin.commande.produit', $commande) }}">
                                                                                <span><button type="button" class="btn btn-sm btn-light">
                                                                                Details
                                                                                </button></span>
                                                                           </a>     
                                                                      </td>
                                                                      <!-- <td>                                                                 
                                                                           <button type="button" class="btn btn-sm btn-soft-warning px-3 fw-bold">{{ $commande->id }}</button>
                                                                      </td> -->
                                                                      <td>
                                                                           <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#validerCommande{{ $commande->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i>Valider</button>
                                                                           </a>
                                                                           <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCommande{{ $commande->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                           <a href="{{ route('admin.pdf.commande', $commande) }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class='bx bxs-file-pdf'></i></button>
                                                                           </a> -->
                                                                           <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                     <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 22.4px, 0px);">
                                                                                     <!-- <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#validerCommande{{ $commande->id }}">
                                                                                          <i class="bx bx-edit fs-16"></i> Valider
                                                                                     </a> -->
                                                                                     <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCommande{{ $commande->id }}">
                                                                                          <i class="bx bx-trash fs-16"></i> Supprimer
                                                                                     </a>
                                                                                     <a href="{{ route('admin.pdf.commande', $commande) }}" class="dropdown-item">
                                                                                          <i class='bx bxs-file-pdf'></i> Format pdf
                                                                                     </a>
                                                                                     <a href="#" class="dropdown-item" 
                                                                                          @if(Auth()->user()->livreurs->count() > 0 || Auth()->user()->role) data-bs-toggle="modal" data-bs-target="#AffecterLivreurCommande{{ $commande->id }}" @endif >
                                                                                          <i class="bx bxs-user-detail me-1"></i> Affecter commande
                                                                                     </a>
                                                                                <!-- <a href="#!" class="dropdown-item">
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
                                                                                     </a> -->
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                 </tr>
                                                            @endif

                                                            @include('include.commande')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez aucune commande en attente sur la plateformes
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