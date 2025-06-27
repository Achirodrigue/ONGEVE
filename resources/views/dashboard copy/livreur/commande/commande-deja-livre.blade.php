@extends('dashboard.livreur.layout.app')
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
                                                  Mes différentes Commandes livrées sur la plateforme <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('livreur.home') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                             </a>
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($commandelivreurs->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom et prénom client</th>
                                                            <th scope="col">Contact Client</th>
                                                            <th scope="col">Adresse livraison</th>
                                                            <th scope="col">Total à payer</th>
                                                            <th scope="col">Etat</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach($commandelivreurs as $commandelivreur)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $commandelivreur->commande->client->nom }} {{ $commandelivreur->commande->client->prenom }}</td>
                                                                 <td>{{ $commandelivreur->commande->client->contact }}</td>
                                                                 <td>{{ $commandelivreur->commande->adresse_livraison }}</td>
                                                                 <td>
                                                                      <span><button type="button" class="btn btn-sm btn-warning">
                                                                      {{ strrev(wordwrap(strrev($commandelivreur->commande->total_prix + $commandelivreur->commande->frais_livraison), 3, ' ', true)) }}F
                                                                      </button></span>
                                                                 </td>
                                                                 <td>
                                                                      <span><button type="button" class="btn btn-sm btn-light">
                                                                           Déjà livré
                                                                           </button>
                                                                      </span>  
                                                                 </td>
                                                                 <td>
                                                                      <div class="dropdown">
                                                                           <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                                           </a>
                                                                           <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 22.4px, 0px);">
                                                                                <!-- <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#validerCommande{{ $commandelivreur->commande->id }}">
                                                                                     <i class="bx bx-edit fs-16"></i> Valider
                                                                                </a>
                                                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCommande{{ $commandelivreur->commande->id }}">
                                                                                     <i class="bx bx-trash fs-16"></i> Supprimer
                                                                                </a> -->
                                                                                <a href="{{ route('livreur.commande.produit', $commandelivreur->commande) }}" class="dropdown-item">
                                                                                     <i class='bx bxs-user-detail'></i> Details
                                                                                </a>
                                                                                <a href="{{ route('livreur.pdf.commande', $commandelivreur->commande) }}" class="dropdown-item" target="_blank">
                                                                                     <i class='bx bxs-file-pdf'></i> Format pdf
                                                                                </a>
                                                                                <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#confirmeLivraison{{ $commandelivreur->id }}" class="dropdown-item">
                                                                                     <i class='bx bx-block'></i> Confirmer la livraison
                                                                                </a> -->
                                                                           </div>
                                                                      </div>
                                                                 </td>
                                                            </tr>

                                                            @include('include.confirme-livraison')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez livré aucune commande sur la plateformes
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body -->
                    </div> <!-- end col -->
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->



@endsection