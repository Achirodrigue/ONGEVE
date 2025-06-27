@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="row">
                         <div class="col-xl-4">
                              <form action="{{ route('admin.recherche.produit') }}" method="get" class="app-search d-md-block me-2">
                              @csrf
                                   <div class="card">
                                        <div class="card-header border-0">
                                             <div class="search-bar me-3 mb-1">
                                                  <button type="submit" class="button-search"><i class="bx bx-search-alt"></i></button>
                                                  <input type="search" class="form-control" id="search" name="search" placeholder="Rechercher un produit" value="{{ request()->search ?? '' }}">
                                                  @error('search') <span class="text-danger color">{{ $message }}</span> @enderror
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
                                                                 class="text-dark">Categories</a></li>
                                                       <li class="breadcrumb-item active">Tout les Produits reconditionnés</li>
                                                  </ol>
                                                  <!-- <p class="mb-0 text-muted">Showing all <span
                                                            class="text-dark fw-semibold">5,786</span> items results</p> -->
                                             </div>

                                             <div>
                                                  <div class="d-flex flex-wrap gap-2">
                                                       
                                                       <!-- <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Folder">
                                                            <button type="button" class="btn btn-outline-secondary me-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                 <i class="bx bx-folder fs-18"></i>
                                                                 Sous catégories
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                 <a class="dropdown-item" href="{{ route('admin.produit.index') }}">All sous categories  <span class="text-warning">({{ $produits->count() }})</span></a>
                                                                 @foreach($souscategories as $souscategorie)
                                                                      <a class="dropdown-item" @if($souscategorie->produits->count() > 0) href="{{ route('admin.sous.categorie.produit', $souscategorie) }}" @else href="#" @endif>
                                                                           {{ $souscategorie->nom }} <span class="text-warning">({{ $souscategorie->produits->count() }})</span>
                                                                      </a>
                                                                 @endforeach
                                                            </div>
                                                       </div> -->
                                                       <!--<button type="button" class="btn btn-outline-secondary me-1">
                                                            <i class="bx bx-cog me-1"></i>
                                                            More Setting
                                                       </button>-->
                                                       <a href="{{ route('admin.produit.create') }}"
                                                            class="btn btn-success me-1"><i class="bx bx-plus"></i>
                                                            Nouveau Produit
                                                       </a>
                                                       <a href="{{ route('admin.produit.index') }}" class="btn btn-primary">
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


                    @if($produits->count() > 0)
                         <div class="row">
                              @foreach($produits as $produit)
                                   <div class="col-xl-4 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="card produit h-100">
                                             <!-- <h4
                                                  class="badge bg-success text-light fs-14 z-3 m-2 py-1 px-2 position-absolute top-0 start-0">
                                                  New Arrival</h4> -->
                                             @if(!$produit->isvalide)
                                                  <span class="position-absolute z-index top-0 start-0 p-3">
                                                       <button type="button"
                                                            class="btn btn-soft-danger absolute-btn avatar-sm d-inline-flex align-items-center justify-content-center fs-12">
                                                            Block
                                                       </button>
                                                  </span>
                                             @endif 
                                             @if($produit->promo)
                                                  <span class="position-absolute z-index top-0 end-0 p-3">
                                                       <button type="button"
                                                            class="btn btn-soft-danger absolute-btn avatar-sm d-inline-flex align-items-center justify-content-center fs-12">
                                                            Promo
                                                       </button>
                                                  </span>
                                             @endif
                                             @if(!$produit->stock || $produit->qtyStock <= 0)
                                                  <span class="position-absolute z-index top-48 end-0 p-3">
                                                       <button type="button"
                                                            class="btn btn-soft-danger absolute-btn avatar-sm d-inline-flex align-items-center justify-content-center fs-12">
                                                            Fin
                                                       </button>
                                                  </span>
                                             @endif

                                             <!-- Image carousel -->
                                             <div id="carouselExampleInterval{{ $produit->id }}" class="carousel slide" data-bs-ride="carousel">
                                                  <div class="carousel-inner">
                                                       <div class="carousel-item active" data-bs-interval="5000">
                                                            <img src="{{ asset(Storage::url($produit->produitimg->image1)) }}" class="d-block w-100" alt="...">
                                                       </div>
                                                       @if($produit->produitimg->image2)
                                                            <div class="carousel-item" data-bs-interval="5000">
                                                                 <img src="{{ asset(Storage::url($produit->produitimg->image2)) }}" class="d-block w-100" alt="...">
                                                            </div>
                                                       @endif
                                                       @if($produit->produitimg->image3)
                                                            <div class="carousel-item" data-bs-interval="5000">
                                                                 <img src="{{ asset(Storage::url($produit->produitimg->image3)) }}" class="d-block w-100" alt="...">
                                                            </div>
                                                       @endif
                                                       @if($produit->produitimg->image4)
                                                            <div class="carousel-item">
                                                                 <img src="{{ asset(Storage::url($produit->produitimg->image4)) }}" class="d-block w-100" alt="...">
                                                            </div>
                                                       @endif
                                                  </div>
                                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval{{ $produit->id }}" data-bs-slide="prev">
                                                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                       <span class="visually-hidden">Previous</span>
                                                  </button>
                                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval{{ $produit->id }}" data-bs-slide="next">
                                                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                       <span class="visually-hidden">Next</span>
                                                  </button>
                                             </div>

                                             <!-- <img src="{{ asset(Storage::url($produit->image)) }}" alt="" class="img-fluid "> -->

                                             <div class="p-1"></div>

                                             <div class="card-body" style="box-shadow: 0px 0px 5px 0px white;">
                                                  <a href="ecommerce-product-details.html"
                                                       class="text-dark fw-medium fs-16 text-truncate d-block">
                                                       {{ $produit->nom }}
                                                  </a>

                                                  <div class="my-1">
                                                       <div>
                                                            <p>@if($produit->description) {{ $produit->description }} @else Aucune description @endif</p>
                                                       </div>
                                                       <!-- <div class="d-flex gap-2 text-truncate">
                                                            <span class="d-flex text-warning fs-18">
                                                                 <i class="bx bxs-star"></i>
                                                                 <i class="bx bxs-star"></i>
                                                                 <i class="bx bxs-star"></i>
                                                                 <i class="bx bxs-star"></i>
                                                                 <i class="bx bxs-star-half"></i>
                                                            </span>
                                                            <p class="fw-medium fs-15 text-dark mb-0">
                                                                 4.5 <span class="text-muted fs-13">(55 Review)</span>
                                                            </p>
                                                       </div> -->
                                                       <div>
                                                            <p class="fw-medium fs-15 text-dark mb-0">
                                                                 Quantités : <span class="text-warning fs-13">{{ $produit->qtyStock }} (en stock)</span>
                                                            </p>
                                                            <p class="fw-medium fs-15 text-dark mb-0">
                                                                 Référence : <span class="text-warning fs-13">{{ $produit->reference }}</span>
                                                            </p>
                                                            <p class="fw-medium fs-15 text-dark mb-0">
                                                                 Boutique : <span class="text-warning fs-13">{{ $produit->vendeur->nom_entreprise }}</span>
                                                            </p>
                                                            <p class="fw-medium fs-15 text-dark mb-0">
                                                                 Etat : <span class="text-warning fs-13">@if($produit->etat) Neuf @else Reconditionné @endif</span>
                                                            </p>
                                                            <p class="fw-medium fs-15 text-dark mb-0">
                                                                Sortie : <span class="text-warning fs-13">{{ $produit->mvente }}</span>
                                                            </p>
                                                       </div>
                                                  </div>

                                                  <hr class="mx-n3">  

                                                  <div class="d-flex align-items-center mt-3 ">
                                                       <div class="d-flex flex-wrap gap-2">
                                                            <!-- archive, spam & delete -->
                                                            <div class="btn-group">
                                                                 <a href="{{ route('admin.produit.edit', $produit) }}">
                                                                      <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark as spam" data-bs-original-title="Mark as spam">
                                                                           <i class="bx bx-edit fs-18"></i>
                                                                      </button>
                                                                 </a>
                                                                 <a href="#" data-bs-toggle="modal" data-bs-target="#deleteProduit{{ $produit->id }}">
                                                                      <button type="button" class="btn btn-light"><i class="bx bx-trash fs-18"></i></button>
                                                                 </a>
                                                            </div>

                                                            <!-- move to -->
                                                            <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Folder">
                                                                 <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                      <i class="bx bx-folder fs-18"></i> Action
                                                                 </button>
                                                                 <div class="dropdown-menu">
                                                                      <a class="dropdown-item" href="{{ route('admin.etat.produit', $produit) }}">Etat : 
                                                                           @if($produit->isvalide)
                                                                                <span class="text-warning">Activé</span>
                                                                           @else
                                                                                <span class="text-danger">Désactivé</span>
                                                                           @endif
                                                                      </a>
                                                                      <a class="dropdown-item" href="{{ route('admin.stock.produit', $produit) }}">Stock : 
                                                                           @if($produit->stock)
                                                                                <span class="text-warning">Disponible</span>
                                                                           @else
                                                                                <span class="text-danger">Epuisé</span>
                                                                           @endif
                                                                      </a>
                                                                      
                                                                      @if($produit->promo) <hr> @endif
                                                                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPromoProduit{{ $produit->id }}">Promotion :  
                                                                           <span class="text-danger">@if($produit->promo) Modifier @else Ajouter @endif</span>
                                                                      </a>
                                                                      @if($produit->promo)
                                                                           <a class="dropdown-item" href="{{ route('admin.promo.produit.destroy', $produit) }}">Promotion :  
                                                                                <span class="text-danger">Retirer</span>
                                                                           </a>
                                                                      @endif

                                                                      @if($produit->produitimg->image2 || $produit->produitimg->image3 || $produit->produitimg->image4) 
                                                                           <hr> 
                                                                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ProduitImageDestroy{{ $produit->id }}">Image :  
                                                                                <span class="text-danger">Supprimer une image</span>
                                                                           </a>
                                                                      @endif
                                                                      
                                                                      @if($produit->avisprods->count() > 0) 
                                                                           <hr>
                                                                           <a class="dropdown-item" href="{{ route('admin.avis.produit', $produit) }}">
                                                                                <span class="text-danger">{{ $produit->avisprods->count() }} Avis(s)</span>
                                                                           </a>
                                                                      @endif
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <hr class="mx-n3">

                                                  <div class="d-flex justify-content-center align-items-center mt-3 text-truncate">
                                                       <h4 class="d-flex align-items-center gap-1 mb-0">
                                                            @if($produit->promo)
                                                                 {{ getprice($produit->promo) }} <small class="text-muted"> | </small>
                                                                 <span class="fs-16 text-decoration-line-through">{{ getprice($produit->prix) }}</span>
                                                            @else
                                                                 {{ getprice($produit->prix) }}
                                                            @endif
                                                       </h4>
                                                       <!--
                                                       <h2 class="fw-medium my-3">
                                                            $80.00 
                                                            <span class="fs-16 text-decoration-line-through">$100.00</span>
                                                            <small class="text-danger ms-2">(30%Off)</small>
                                                       </h2>
                                                       -->
                                                  </div>
                                             </div>

                                        </div>

                                        @include('include.produit')
                                   </div>                    
                              @endforeach
                         </div>

                         <!-- @if($produits->count() >= 20)@endif -->
                              <div class="py-3 border-top">
                                   <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end mb-0">
                                             <li class="page-item">{{ $produits->links() }}</li>
                                        </ul>
                                   </nav>
                              </div>
                         
                    @else
                         <div class="row">
                              <div class="col-12">
                                   <div class="card p-2">
                                        <div class="card-header border-0">
                                             <h4 class="fw-bold text-center">
                                                  Désolé! Aucun produit reconditionné disponible sur la plateforme.
                                             </h4>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endif
               </div>
               <!-- End Container Fluid -->

@endsection