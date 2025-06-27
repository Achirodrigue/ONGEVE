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
                                                  Les livraisons en cours de {{ $livreur->nom }} {{ $livreur->prenom }} <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.livreur.create') }}" class="btn btn-primary">
                                                  <i class="bx bx-plus me-1"></i>Ajouter
                                             </a>
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($livreur->commandelivreurs->where('isvalide', 0)->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom client</th>
                                                            <th scope="col">Prenom client</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Adresse de livraison</th>
                                                            <th scope="col">Prix total</th>
                                                            <th scope="col">Action</th>

                                                            
        <!-- 'commande_id',
        'livreur_id',
        'isvalide',

                                                            
        'nom',
        'prenom',
        'email',
        'contact',
        'ville',
        'adresse',

                                                            
        'adresse_livraison',
        'frais_livraison',
        'total_prix',
        'isvalide',
        'note_commande',
        'client_id' -->
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($livreur->commandelivreurs->where('isvalide', 0) as $commandelivreur)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $commandelivreur->commande->client->nom }}</td>
                                                                 <td>{{ $commandelivreur->commande->client->prenom }}</td>
                                                                 <td>{{ $commandelivreur->commande->client->contact }}</td>
                                                                 <td>{{ $commandelivreur->commande->adresse_livraison }}</td>
                                                                 <td>
                                                                      {{ strrev(wordwrap(strrev($commandelivreur->commande->total_prix + $commandelivreur->commande->frais_livraison), 3, ' ', true)) }}F
                                                                 </td>
                                                                 <!-- <td>
                                                                      <span><button type="button" class="btn btn-sm @if($livreur->isvalide) btn-light @else btn-danger @endif">
                                                                           @if($livreur->isvalide) active @else bloqué @endif
                                                                      </button></span>
                                                                 </td> -->
                                                                 <!-- <td>{{ $livreur->type_livreur }}</td>
                                                                 <td>
                                                                      @if($livreur->photo)
                                                                           <div class="swiper-slide avatar-sm">
                                                                                <div class="chat-user-status-box">
                                                                                     <span><img src="{{ asset(Storage::url($livreur->photo)) }}" alt="avatar-2" class="img-fluid avatar-sm rounded-circle avatar-border" /></span>
                                                                                </div>
                                                                           </div>
                                                                      @else Aucune @endif
                                                                 </td>
                                                                 <td>                                                                 
                                                                      <button type="button" class="btn btn-sm btn-soft-warning px-3 fw-bold">{{ $livreur->produits->count() }}</button>
                                                                 </td> -->
                                                                 <td>
                                                                      <a href="{{ route('admin.livreur.edit', $livreur) }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                      </a>
                                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#deleteLivreur{{ $livreur->id }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                      </a>
                                                                 </td>
                                                            </tr>

                                                            @include('include.livreur')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucun livreur sur la plateformes
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