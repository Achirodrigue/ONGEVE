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
                                                  Mes différentes Commandes livrées sur la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.nouvelle.commande') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-right me-1'></i> Retour
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
                                   @if($commandesecteurs->count() > 0 && TCL() > 0)
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
                                                            @if($commandesecteur->commande->isvalide)
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
                                                                           <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCommande{{ $commandesecteur->commande->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                           <a href="{{ route('admin.pdf.commande', $commandesecteur->commande) }}" target="_blank">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class='bx bxs-file-pdf'></i></button>
                                                                           </a>
                                                                      </td>
                                                                 </tr>
                                                            @endif

                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez aucune commande livré sur la plateformes
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