@extends('principale.layout.app')
@section('body')

    @include('include.principale.message')


    <!-- Breadcrumb start -->
    <div class="gi-breadcrumb mb-0 background">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="gi-breadcrumb-title">Details Produit</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">Produit </li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->
    @include('include.principale.produit')  

    <!-- Sart Single Product -->
    <section class="gi-single-product padding-tb-40 background">
        <div class="container">
            <div class="row">
                <div class="gi-pro-rightside gi-common-rightside col-md-12">
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-pro-img single-pro-img-no-sidebar text-center" style="width: 100%;">
                                        <div class="single-product-scroll">
                                            <div class="single-product-cover">
                                                <div class="single-slide zoom-image-hover">
                                                    <img class="img-responsive d-inline" src="{{ asset(Storage::url($produit->produitimg->image1)) }}"
                                                        alt="">
                                                </div>
                                                @if($produit->produitimg->image2)
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive d-inline" src="{{ asset(Storage::url($produit->produitimg->image2)) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                                @if($produit->produitimg->image3)
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive d-inline" src="{{ asset(Storage::url($produit->produitimg->image3)) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                                @if($produit->produitimg->image4)
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive d-inline" src="{{ asset(Storage::url($produit->produitimg->image4)) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="single-nav-thumb">
                                                <div class="single-slide">
                                                    <img class="img-responsive" src="{{ asset(Storage::url($produit->produitimg->image1)) }}"
                                                        alt="">
                                                </div>
                                                @if($produit->produitimg->image2)
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src="{{ asset(Storage::url($produit->produitimg->image2)) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                                @if($produit->produitimg->image3)
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src="{{ asset(Storage::url($produit->produitimg->image3)) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                                @if($produit->produitimg->image4)
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src="{{ asset(Storage::url($produit->produitimg->image4)) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="single-pro-desc single-pro-desc-no-sidebar m-t-991" 
                                        style="padding: 15px;
                                        position: sticky;
                                        width: 100%;
                                        top: 30px;
                                        border-radius: 5px;
                                        border: 1px solid #eee;">
                                        <div class="single-pro-content">
                                            <h5 class="gi-single-title">{{ $produit->nom }}</h5>
                                            <div class="gi-single-rating-wrap">
                                                <div class="gi-single-rating">
                                                    @for($i=1; $i <= etoileProduit($produit) ; $i++)
                                                        <i class="gicon gi-star fill"></i>
                                                    @endfor
                                                    @for($i=1; $i <= (5 - etoileProduit($produit)); $i++)
                                                        <i class="gicon gi-star-o"></i>
                                                    @endfor
                                                </div>
                                                <span class="gi-read-review">
                                                    |&nbsp;&nbsp;<a href="#gi-spt-nav-review"> ({{ $produit->avisprods->count() }}) Avis clients</a>
                                                </span>
                                            </div>

                                            <div class="gi-single-price-stoke">
                                                @if($produit->promo)
                                                    <div class="gi-single-price">
                                                        <div class="final-price">{{ getprice($produit->promo) }}<span class="price-des">{{ poucentageReduction($produit) }}%</span></div>
                                                        <div class="mrp">Prix Initial : <span>{{ getprice($produit->prix) }}</span></div>
                                                    </div>
                                                @else
                                                    <div class="gi-single-price">
                                                        <div class="final-price">PRIX : <span class="price-des">{{ getprice($produit->prix) }}</span></div>
                                                        <!-- <div class="mrp">M.R.P. : <span>{{ $produit->prix }} F</span></div> -->

                                                    </div>
                                                @endif
                                                <div class="gi-single-stoke">
                                                    <span class="gi-single-sku ravmel-color1">REF#: {{ $produit->reference }}</span>
                                                    @if($produit->stock && $produit->qtyStock >= 1)
                                                        <span class="gi-single-ps-title">EN STOCK</span>
                                                    @else
                                                        <span class="gi-single-ps-title text-danger">EPUISE</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="gi-single-desc">{{ $produit->description }}</div>

                                            <div class="gi-single-list">
                                                <ul>
                                                    <li><strong>Catégorie :</strong> {{ $produit->souscategorie->categorie->nom }}</li>
                                                    <li><strong>Sous Catégorie :</strong>  {{ $produit->souscategorie->nom }}</li>
                                                    <li><strong>Etat :</strong> Article @if($produit->etat) Neuf @else Reconditionné @endif</li>
                                                </ul>
                                            </div>

                                            @if($produit->stock && $produit->qtyStock >= 1)
                                                <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                                @csrf 
                                                    <div class="gi-single-qty" style="justify-content: space-evenly; align-items: center;">
                                                        <div class="qty-plus-minus">
                                                            <input class="qty-input" type="text" name="quantite" value="1" min="1" max="{{ $produit->qtyStock }}" required>
                                                        </div>
                                                        <div class="gi-single-cart">
                                                            <button type="submit" class="btn btn-primary panier-btn">Ajouter au panier</button>
                                                        </div>
                                                        <div class="gi-single-quickview">
                                                            <a href="#" class="gi-btn-group quickview" data-link-action="quickview"
                                                                title="Quick view" data-bs-toggle="modal"
                                                                data-bs-target="#addProduitPanier{{ $produit->id }}">
                                                                <i class="fi-rr-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif

                                            @if(Cart::content()->count() > 0)
                                                <div class="mt-3 gi-ratting-input form-submit">
                                                    <a href="{{ route('mon.panier') }}" class="gi-btn-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px;" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                        </svg>
                                                        Voir panier
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Add More and get discount content Start -->
                    <div class="single-add-more m-tb-40">
                        <div class="gi-add-more-slider owl-carousel">
                            @if(produit()->count() > 0)
                                @foreach(produit() as $prod)
                                    <div class="add-more-item">
                                        @if($prod->stock || $prod->qtyStock >= 1)
                                            <form method="post" action="{{ route('ajouter.panier.store', $prod->id) }}">
                                            @csrf
                                                <button type="submit" title="Ajouter au panier" class="gi-btn-2 perso-btn">+</button>
                                            </form>
                                        @endif
                                        <div class="add-more-img">
                                            <img src="{{ asset(Storage::url($prod->image)) }}" alt="product">
                                        </div>
                                        <div class="add-more-info">
                                            <h5>{{ $prod->nom }}</h5>
                                            <span class="gi-pro-rating">
                                                @for($i=1; $i <= etoileProduit($prod) ; $i++)
                                                    <i class="gicon gi-star fill"></i>
                                                @endfor
                                                @for($i=1; $i <= (5 - etoileProduit($prod)); $i++)
                                                    <i class="gicon gi-star"></i>
                                                @endfor
                                            </span>
                                            <span class="gi-price text-dark">
                                                @if($prod->promo)
                                                    <span class="new-price">{{ getprice($prod->promo) }}</span>
                                                    <span class="old-price">{{ getprice($prod->prix) }}</span>
                                                @else
                                                    <span class="new-price">{{ getprice($prod->prix) }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Single product tab start -->
                    <div class="gi-single-pro-tab">
                        <div class="gi-single-pro-tab-wrapper">
                            <div class="gi-single-pro-tab-nav">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                            data-bs-target="#Commentaire" type="button" role="tab"
                                            aria-controls="gi-spt-nav-details" aria-selected="true">Tout les Commentaire</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                            data-bs-target="#FaireCommantaire" type="button" role="tab"
                                            aria-controls="gi-spt-nav-info"
                                            aria-selected="false">Laisser un commentaire</button>
                                    </li>
                                </ul>

                            </div>
                            <div class="tab-content  gi-single-pro-tab-content">
                                <div id="Commentaire" class="tab-pane fade show active">
                                    <div class="row">
                                        @if($produit->avisprods->count() > 0)
                                            <div class="gi-t-review-wrapper">
                                                @foreach($produit->avisprods as $avisprod)
                                                    <div class="gi-t-review-item">
                                                        <div class="gi-t-review-content">
                                                            <div class="gi-t-review-top">
                                                                <div class="gi-t-review-name">{{ $avisprod->nom }} {{ $avisprod->prenom }}</div>
                                                                <div class="gi-t-review-rating">
                                                                    @for($i=1; $i <= $avisprod->etoile ; $i++)
                                                                        <i class="gicon gi-star fill"></i>
                                                                    @endfor
                                                                    @for($i=1; $i <= (5 - $avisprod->etoile); $i++)
                                                                        <i class="gicon gi-star-o"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="gi-t-review-bottom">
                                                                <p>{{ $avisprod->commentaire }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="gi-ratting-content">
                                                <h5>Désolé! Aucun commentaire n'a été fait pour ce produit</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="FaireCommantaire" class="tab-pane fade">
                                    <div class="row">
                                        <div class="gi-ratting-content">
                                            <h3>Ajouter un commentaire</h3>
                                            <div class="gi-ratting-form">
                                                <form action="{{ route('commentaire.produit.store', $produit) }}" method="POST">
                                                @csrf
                                                    <div class="gi-ratting-star">
                                                        <span>Des étoiles :</span>
                                                        <div class="gi-t-review-rating">
                                                            <i class="gicon gi-star fill"></i>
                                                            <i class="gicon gi-star fill"></i>
                                                            <i class="gicon gi-star-o"></i>
                                                            <i class="gicon gi-star-o"></i>
                                                            <i class="gicon gi-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="gi-ratting-input">
                                                        <input name="nom" type="text" placeholder="Entrez votre nom" value="{{ old('nom') }}" required>
                                                        @error('nom') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="gi-ratting-input">
                                                        <input name="prenom" type="text" placeholder="Entrez votre prenom" value="{{ old('prenom') }}" required>
                                                        @error('prenom') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="gi-ratting-input">
                                                        <input name="etoile" min="1" max="5" type="number" placeholder="nombre d'etoile" value="{{ old('etoile') }}" required>
                                                        @error('etoile') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="gi-ratting-input form-submit">
                                                        <textarea name="commentaire" placeholder="Entrez votre message" value="{{ old('commentaire') }}" required></textarea>
                                                        <button class="gi-btn-2" type="submit"
                                                           >Envoyer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Single Product -->

     <!-- Team Section -->
     <section class="gi-team-section padding-tb-40 background">
        <div class="container">
            @if(produit()->count() > 0)
                <div class="section-title-2">
                    <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                    <p>Decouvrez des produits exellents et de bonnes qualité.</p>
                </div>
                <div class="gi-team owl-carousel">
                    @foreach(produit() as $produit)
                        <div class="gi-team-box">
                                <div class="gi-product-content">
                                    <div class="gi-product-inner">
                                        <div class="gi-pro-image-outer">
                                            <div class="gi-pro-image">
                                                <a href="{{ route('detail.produit', $produit) }}" class="image">
                                                    <!-- Image carousel -->
                                                    <span class="label veg">
                                                        <span class="dot"></span>
                                                    </span>
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
                                                            <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval{{ $produit->id }}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon right-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                </a>
                                                @if(!$produit->stock || $produit->qtyStock <= 0)
                                                    <span class="flags stock">
                                                        <span class="sale">epuisé</span>
                                                    </span>
                                                @endif
                                                @if(!$produit->etat)
                                                    <span class="flags stock pourcentage">
                                                        <span class="sale bg-warning">REC</span>
                                                    </span>
                                                @endif
                                                @if($produit->promo)
                                                    <span class="flags">
                                                        <span class="sale">Promo</span>
                                                    </span>
                                                    <span class="flags pourcentage">
                                                        <span class="sale bg-warning">{{ poucentageReduction($produit) }}%</span>
                                                    </span>
                                                @endif
                                                <div class="gi-pro-actions">
                                                    <!-- <a href="#" class="gi-btn-group quickview"
                                                        data-link-action="quickview" title="Quick view"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addProduitPanier{{ $produit->id }}"><i
                                                            class="fi-rr-eye"></i></a> -->
                                                    @if($produit->stock && $produit->qtyStock >= 1)
                                                        <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                                        @csrf
                                                            <button type="submit" title="Ajouter au panier"
                                                            class="gi-btn-group add-to-cart"><i
                                                                class="fi-rr-shopping-basket"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gi-pro-content">
                                            <a href="#">
                                                <h6 class="gi-pro-stitle">{{ $produit->nom }}</h6>
                                            </a>
                                            <h5 class="gi-pro-title">
                                                <a href="#">{{ $produit->description }}</a>
                                            </h5>
                                            <div class="gi-pro-rat-price">
                                                <span class="gi-pro-rating">
                                                    @for($i=1; $i <= etoileProduit($produit) ; $i++)
                                                        <i class="gicon gi-star fill"></i>
                                                    @endfor
                                                    @for($i=1; $i <= (5 - etoileProduit($produit)); $i++)
                                                        <i class="gicon gi-star"></i>
                                                    @endfor
                                                </span>
                                                <span class="gi-price">
                                                    @if($produit->promo)
                                                        <span class="new-price">{{ getprice($produit->promo) }}</span>
                                                        <span class="old-price">{{ getprice($produit->prix) }}</span>
                                                    @else
                                                        <span class="new-price">{{ getprice($produit->prix) }}</span>
                                                    @endif
                                                </span>
                                            </div>
                                                        
                                            @if($produit->stock && $produit->qtyStock >= 1)
                                                <div class="gi-single-cart text-center mt-3">
                                                    <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                                    @csrf
                                                        <button type="submit" class="btn btn-primary gi-btn-1 btn-card"><i class="fi-rr-shopping-basket"></i> ajouter</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="section-title-2">
                    <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                    <p>Decouvrez des produits exellents et de bonnes qualité.</p>
                </div>
            @endif
        </div>
    </section>
    <!-- Facts Section End -->


@endsection