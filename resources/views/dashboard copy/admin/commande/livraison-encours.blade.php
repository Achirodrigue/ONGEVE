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
                                                  Mes différentes Commandes en cours de livraison sur la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.livraison.effectue') }}" class="btn btn-primary">
                                                  <i class="bx bx-plus me-1"></i>Déjà livré
                                             </a>
                                             <a href="{{ route('admin.nouvelle.commande') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                             </a>
                                             <!-- @if(auth()->user()->role)
                                                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteCommandeGenerale">
                                                       <i class="bx bx-trash me-1"></i> Generales
                                                  </a>
                                             @endif -->
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($commandelivreurs->count() > 0 && TCEC() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered table-bordered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom et prénom livreur</th>
                                                            <th scope="col">Contact Livreur</th>
                                                            <th scope="col">Nom et prénom client</th>
                                                            <th scope="col">Contact Client</th>
                                                            <th scope="col">Adresse livraison</th>
                                                            <th scope="col">Total à payer</th>
                                                            <th scope="col">Livraison</th>
                                                            <th scope="col">Confirmer</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                  
                                                       @foreach($commandelivreurs as $commandelivreur)
                                                            @php 
                                                                 $ok = null;

                                                                 if(Auth()->user()->role)
                                                                 {
                                                                      $ok = 1;
                                                                 }
                                                                 else
                                                                 {
                                                                      if(Auth()->user()->adminsecteur->secteur_id)
                                                                      {
                                                                           if($commandelivreur->commande->commandesecteur->secteur_id === Auth()->user()->adminsecteur->secteur_id)
                                                                           {
                                                                                $ok = 1;
                                                                           }
                                                                      }
                                                                      else
                                                                      {
                                                                           $ok = 1;
                                                                      }
                                                                 }
                                                            @endphp
                                                            @if($ok)
                                                                 <tr>
                                                                      <td>
                                                                           <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                      </td>
                                                                      <td>{{ $commandelivreur->livreur->nom }} {{ $commandelivreur->livreur->prenom }}</td>
                                                                      <td>{{ $commandelivreur->livreur->contact }}</td>
                                                                      <td>{{ $commandelivreur->commande->client->nom }} {{ $commandelivreur->commande->client->prenom }}</td>
                                                                      <td>{{ $commandelivreur->commande->client->contact }}</td>
                                                                      <td>{{ $commandelivreur->commande->adresse_livraison }}</td>
                                                                      <td>
                                                                           <span><button type="button" class="btn btn-sm btn-warning">
                                                                           {{ strrev(wordwrap(strrev($commandelivreur->commande->total_prix + $commandelivreur->commande->frais_livraison), 3, ' ', true)) }}F
                                                                           </button></span>
                                                                      </td>
                                                                      <td>
                                                                           <span>
                                                                                <button type="button" class="btn btn-sm @if($commandelivreur->isvalide) btn-light @else btn-danger @endif">
                                                                                     @if($commandelivreur->isvalide) Livré @else En cours @endif
                                                                                </button>
                                                                           </span>  
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <span>
                                                                                <a
                                                                                     @if($commandelivreur->isvalide)
                                                                                          href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#validerCommande{{ $commandelivreur->commande->id }}"
                                                                                     @else 
                                                                                          href="#" class="btn btn-sm btn-danger"
                                                                                     @endif>
                                                                                     @if($commandelivreur->isvalide)<i class="bx bx-edit fs-16"></i> Confirmer @else IPS @endif
                                                                                </a>
                                                                           </span>  
                                                                      </td>
                                                                      <td>
                                                                           <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                     <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 22.4px, 0px);">
                                                                                     <a href="{{ route('admin.commande.produit', $commandelivreur->commande) }}" class="dropdown-item">
                                                                                          <i class='bx bxs-user-detail'></i> Details
                                                                                     </a>
                                                                                     <a href="{{ route('admin.pdf.commande', $commandelivreur->commande) }}" class="dropdown-item" target="_blank">
                                                                                          <i class='bx bxs-file-pdf'></i> Format pdf
                                                                                     </a>
                                                                                     @if(!$commandelivreur->isvalide)
                                                                                          <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#AnnulerLivraisonCommande{{ $commandelivreur->id }}">
                                                                                               <i class="bx bx-trash fs-16"></i> Annuler Livraison
                                                                                          </a>
                                                                                     @endif
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                 </tr>
                                                                 @include('include.livraison-commande')
                                                            @endif
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez aucune commande en cours de livraison sur la plateformes
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