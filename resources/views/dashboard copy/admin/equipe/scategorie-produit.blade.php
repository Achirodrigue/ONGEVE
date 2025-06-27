@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="row">
                         <div class="col-xl-4">
                              <div class="card">
                                   <div class="card-header border-0">
                                        <div class="search-bar me-3 mb-1">
                                             <span><i class="bx bx-search-alt"></i></span>
                                             <input type="search" class="form-control" id="search"
                                                  placeholder="Search ...">
                                        </div>
                                   </div>
                              </div>
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
                                                       <li class="breadcrumb-item active">All Product</li>
                                                  </ol>
                                                  <p class="mb-0 text-muted">Showing all <span
                                                            class="text-dark fw-semibold">5,786</span> items results</p>
                                             </div>

                                             <div>
                                                  <div class="d-flex flex-wrap gap-2">
                                                       
                                                       <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Folder">
                                                            <button type="button" class="btn btn-outline-secondary me-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                 <i class="bx bx-folder fs-18"></i>
                                                                 {{ $souscategorie->nom }}  <span class="text-warning">({{ $souscategorie->produits->count() }})</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                 <a class="dropdown-item" href="{{ route('admin.produit.index') }}">All sous categories</span></a>
                                                                 @foreach($souscategories as $souscateg)
                                                                      <a class="dropdown-item" @if($souscateg->produits->count() > 0) href="{{ route('admin.sous.categorie.produit', $souscateg) }}" @else href="#" @endif>{{ $souscateg->nom }} <span class="text-warning">({{ $souscateg->produits->count() }})</span></a>
                                                                 @endforeach
                                                            </div>
                                                       </div>
                                                       <!--<button type="button" class="btn btn-outline-secondary me-1">
                                                            <i class="bx bx-cog me-1"></i>
                                                            More Setting
                                                       </button>-->
                                                       <a href="{{ route('admin.produit.create') }}"
                                                            class="btn btn-success me-1"><i class="bx bx-plus"></i>
                                                            Nouveau Produit
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
                                   <div class="col-xl-4 col-md-4">
                                        <div class="card produit h-auto">
                                             @if(!$produit->isvalide)
                                                  <span class="position-absolute top-0 start-0 p-3">
                                                       <button type="button"
                                                            class="btn btn-soft-danger avatar-sm d-inline-flex align-items-center justify-content-center fs-12">
                                                            Block
                                                       </button>
                                                  </span>
                                             @endif 
                                             @if($produit->promo)
                                                  <span class="position-absolute top-0 end-0 p-3">
                                                       <button type="button"
                                                            class="btn btn-soft-danger avatar-sm d-inline-flex align-items-center justify-content-center fs-12">
                                                            Promo
                                                       </button>
                                                  </span>
                                             @endif
                                             @if(!$produit->stock)
                                                  <span class="position-absolute top-48 end-0 p-3">
                                                       <button type="button"
                                                            class="btn btn-soft-danger avatar-sm d-inline-flex align-items-center justify-content-center fs-12">
                                                            Fin
                                                       </button>
                                                  </span>
                                             @endif

                                             <img src="{{ asset(Storage::url($produit->image)) }}" alt="" class="img-fluid ">

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
                                                                 {{ $produit->promo }} Fcfa <small class="text-muted"> | </small>
                                                                 <span class="fs-16 text-decoration-line-through">{{ $produit->prix }} F</span>
                                                            @else
                                                                 {{ $produit->prix }} Fcfa
                                                            @endif
                                                       </h4>
                                                  </div>
                                             </div>

                                        </div>
                                        @include('include.produit')
                                   </div>
                              @endforeach
                         </div>

                         @if($produits->count() >= 12)
                              <div class="py-3 border-top">
                                   <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end mb-0">
                                             <li class="page-item">{{ $produits->links() }}</li>
                                        </ul>
                                   </nav>
                              </div>
                         @endif
                    @else
                         <div class="row">
                              <div class="col-12">
                                   <div class="card p-2">
                                        <div class="card-header border-0">
                                             <h4 class="fw-bold text-center">
                                                  Désolé! Aucun produit disponible dans la sous catégorie <span class="text-warning">{{ $souscategorie->nom }}</span>.
                                             </h4>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endif
               </div>
               <!-- End Container Fluid -->


@endsection