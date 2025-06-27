@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container xxl -->
          <div class="container-xxl">
               <!-- row -->
               <div class="row mb-3">
                  <div class="col-md-12">
                     <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        <div>
                        </div>
                        <!-- button -->
                        <div>
                              <a href="{{ route('admin.nouvelle.commande') }}" class="btn btn-primary">
                                   <i class='bx bxs-arrow-from-right me-1'></i> Retour
                              </a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- row -->
               <div class="row">
                  <div class="col-xl-12 col-12 mb-5">
                     <!-- card -->
                     <div class="card h-100 card-lg">
                        <div class="card-body p-6">
                           <div class="d-md-flex justify-content-between mb-3">
                              <div class="d-flex align-items-center mb-2 mb-md-0">
                                 <h3 class="mb-0">COMMANDE: #{{ $commande->numero_facture }}</h3>
                              </div>
                              <!-- select option -->
                              <div class="d-md-flex">
                                 <!-- button -->
                                 <div class="ms-md-3">
                                    <a href="{{ route('admin.pdf.commande', $commande) }}" class="btn btn-secondary">
                                        <i class='bx bxs-file-pdf'></i> Télécharger
                                   </a>
                                 </div>
                              </div>
                           </div>

                           <div class="mt-8">
                              <div class="row">
                                 <!-- address -->
                                 <div class="col-lg-6 col-md-6 col-12">
                                    <div class="mb-6">
                                       <h4>Informations du client</h4>
                                       <p><strong>Nom :</strong> {{ $commande->client->nom }}</p>
                                       <p><strong>Prénom :</strong> {{ $commande->client->prenom }}</p>
                                       <p><strong>Téléphone :</strong> {{ $commande->client->contact }}</p>
                                       <p><strong>Lieu d'habitation :</strong> {{ $commande->client->adresse }}</p>
                                    </div>
                                 </div>
                                 <!-- address -->
                                 <div class="col-lg-6 col-md-6 col-12">
                                    <div class="mb-6">
                                       <h4>Informations sur la Commande</h4>
                                       <p><strong>Facture N° :</strong> {{ $commande->numero_facture }}</p>
                                       <p><strong>Date :</strong> {{ $commande->created_at->format("d-m-Y H:i:s") }}</p>
                                       <p><strong>Adresse de livraison :</strong> {{ $commande->adresse_livraison }}</p>
                                       <p><strong>Frais de livraison :</strong> <span style="color: green">{{ getprice($commande->frais_livraison) }}</span></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-12">
                              <div class="table-responsive">
                                 <!-- Table -->
                                 <table class="table mb-0 text-nowrap table-centered">
                                    <!-- Table Head -->
                                    <thead class="bg-light">
                                       <tr class="text-center">
                                          <th>Référence</th>
                                          <th>Image</th>
                                          <th>Nom</th>
                                          <th>Quantité</th>
                                          <th>Prix Unitaire <br>en Fcfa</th>
                                          <th>Total <br>en Fcfa</th>
                                          <th>Vendeur</th>
                                       </tr>
                                    </thead>
                                    <!-- tbody -->
                                    <tbody>
                                        @foreach($commande->detailcommandes as $detailcommande)
                                             <tr class="text-center">
                                                <td>{{ $detailcommande->produit->reference }}</td>
                                                  <td style="width: 135px;">
                                                       <img src="{{ asset(Storage::url($detailcommande->produit->image)) }}" style="width: 60%; height: auto;" alt="" class="icon-shape icon-lg" />
                                                  </td>
                                                  <td>
                                                       <h4 class="mb-0 h5">{{ $detailcommande->produit->nom }}</h4>
                                                  </td>
                                                  <td>{{ $detailcommande->quantite }}</td>
                                                  <td><span class="text-body">{{ strrev(wordwrap(strrev($detailcommande->prix_unitaire), 3, ' ', true)) }}F</span></td>
                                                  <td>{{ strrev(wordwrap(strrev($detailcommande->prix_total), 3, ' ', true)) }}F</td>
                                                  <td>{{ $detailcommande->produit->vendeur->nom_entreprise }}</td>
                                             </tr>
                                        @endforeach
                                       
                                       <tr>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td colspan="2" class="fw-medium text-dark">
                                             <!-- text -->
                                             Sous Total :
                                          </td>
                                          <td class="fw-medium text-dark">
                                             <!-- text -->
                                             {{ strrev(wordwrap(strrev($commande->total_prix), 3, ' ', true)) }}F
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td class="border-bottom-0 pb-0"></td>
                                          <td colspan="2" class="fw-medium text-dark">
                                             <!-- text -->
                                             Frais
                                          </td>
                                          <td class="fw-medium text-dark">
                                             <!-- text -->
                                             {{ strrev(wordwrap(strrev($commande->frais_livraison), 3, ' ', true)) }}F
                                          </td>
                                       </tr>

                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td colspan="2" class="fw-semibold text-dark">
                                             <!-- text -->
                                             Grand Total
                                          </td>
                                          <td class="fw-semibold text-dark">
                                             <!-- text -->
                                             {{ strrev(wordwrap(strrev($commande->total_prix + $commande->frais_livraison), 3, ' ', true)) }}F
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="card-body p-6">
                           <div class="row">
                              <div class="col-md-12">
                                 <h5>Notes Commandes</h5>
                                 <textarea class="form-control mb-3" rows="3" placeholder="Write note for order">@if($commande->note_commande) {{ $commande->note_commande }} @else Aucune note n'a été laissé. @endif</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          <!-- End Container Fluid -->

         

@endsection