@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container Fluid -->
          <div class="container">

          
               <div class="row">
                    <div class="col-xl-4">
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

                    <div class="col-xl-8">
                         <div class="card">
                              <div class="card-header border-0">
                                   <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                        <div>
                                             <ol class="breadcrumb mb-0">
                                                  <li class="breadcrumb-item fw-medium"><a
                                                            href="javascript: void(0);"
                                                            class="text-dark">Resultat des produits pour la recherche ({{ $produits->total() }})</a></li>
                                                  <li class="breadcrumb-item active"><span class="text-warning">{{ request()->search }}</span></li>
                                             </ol>
                                             <!-- <p class="mb-0 text-muted">Showing all <span
                                                       class="text-dark fw-semibold">5,786</span> items results</p> -->
                                        </div>
                                   </div>

                                   @include('include.message')
                              </div>
                         </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header">
                                   <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                             <h5 class="card-title mb-1 anchor" id="responsive">
                                             Stock des produits sur la plateformes <a class="anchor-link" href="#responsive">#</a>
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
                                                                           <iconify-icon icon="solar:clock-circle-outline" class="fs-24 align-middle text-danger"></iconify-icon>
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
                                             Désolé! Aucun produit trouvé pour la recherche <span class="text-warning">{{ request()->search ?? 'Aucune recherche' }}</span> 
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body -->
                    </div> <!-- end col -->
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


          
          

          


@endsection