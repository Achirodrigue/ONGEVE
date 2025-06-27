@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container Fluid -->
          <div class="container">
               
               <div class="row">
                    <div class="col-xl-12">
                         <form action="{{ route('admin.recherche.produit') }}" method="get" class="app-search d-md-block me-2">
                         @csrf
                              <div class="card">
                                   <div class="card-header border-0">
                                        <div class="search-bar me-3 mb-1">
                                             <button type="submit" class="button-search"><i class="bx bx-search-alt"></i></button>
                                             <input type="search" class="form-control" id="search" name="search" placeholder="Rechercher un produit" value="{{ request()->search ?? '' }}">
                                             <input type="text" class="form-control" name="type" value="stock" readonly hidden>
                                             @error('search') <span class="text-danger color mt-3">{{ $message }}</span> @enderror
                                        </div>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header">
                                   <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                             <h5 class="card-title mb-1 anchor" id="responsive">
                                                  Stock 1 des produits sur la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.stock.global.produit.deux') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-left me-1'></i> Stock 2
                                             </a>
                                             @if(auth()->user()->role)
                                                  <!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteCommandeGenerale">
                                                       <i class="bx bx-trash me-1"></i> Generales
                                                  </a> -->
                                             @endif
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($produits->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover text-center table-centered table-bordered">
                                                  <thead class="table-light">
                                                       @php
                                                            $prixTotal = 0;
                                                            foreach($produits as $produit)
                                                            {
                                                                 $prixTotal = $prixTotal + ($produit->prix * ($produit->qtyStock - $produit->produitstat->sortie)) ;
                                                            }
                                                       @endphp

                                                       <tr>
                                                            <th colspan="8" scope="col">Inventaire du stock avec alerte du stock minimum</th>
                                                            <th scope="col">Montant du Stock</th>
                                                            <th scope="col">{{ getprice($prixTotal) }}</th>
                                                       </tr>
                                                       <tr>
                                                            <th scope="col">Designation</th>
                                                            <th scope="col">Code article</th>
                                                            <th scope="col">Stock min</th>
                                                            <th scope="col">Stock initial</th>
                                                            <th scope="col">Entrée</th>
                                                            <th scope="col">Sortie</th>
                                                            <th scope="col">Alerte stock</th>
                                                            <th scope="col">Stock final</th>
                                                            <th scope="col">P.U</th>
                                                            <th scope="col">Valeur du stock</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                  
                                                       @foreach($produits as $produit)
                                                            <tr>
                                                                 <td>{{ $produit->nom }}</td>
                                                                 <td>{{ $produit->reference }}</td>
                                                                 <td>
                                                                      @if($produit->qtyStock <= $produit->produitstat->stock_min) 
                                                                           <span class="text-danger">{{ $produit->produitstat->stock_min }}</span>
                                                                      @else
                                                                           {{ $produit->produitstat->stock_min }}
                                                                      @endif
                                                                 </td>
                                                                 <td>{{ $produit->qtyStock }}</td>
                                                                 <td>{{ $produit->produitstat->entree }}</td>
                                                                 <td>{{ $produit->produitstat->sortie }}</td>
                                                                 <td>
                                                                      @if($produit->qtyStock <= $produit->produitstat->stock_min)
                                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" viewBox="0 0 24 24">
                                                                                <path d="M12 0C5.3726 0 0 5.3726 0 12s5.3726 12 12 12 12-5.3726 12-12S18.6274 0 12 0zm4.95 16.95l-1.41 1.41L12 13.41l-3.54 3.54-1.41-1.41L10.59 12 7.05 8.46l1.41-1.41L12 10.59l3.54-3.54 1.41 1.41L13.41 12l3.54 3.54z"/>
                                                                           </svg>
                                                                      @endif
                                                                 </td>
                                                                 <td>{{ $produit->qtyStock - $produit->produitstat->sortie }}</td>
                                                                 <td>{{ getprice($produit->prix) }}</td>
                                                                 <td>{{ getprice($produit->prix * ($produit->qtyStock - $produit->produitstat->sortie)) }}</td>
                                                            </tr>
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
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


          
          

          


@endsection