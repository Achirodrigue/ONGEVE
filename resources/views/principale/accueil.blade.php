@extends('principale.layout.app')
@section('body')

@include('include.principale.message')


<!-- Hero Slider Start Article reconditionné-->


<section class="section gi-hero m-tb-40 background">
    <div class="container">
        <div class="gi-main-content">
            <div class="gi-slider-content">
                <div class="gi-main-slider">
                    <div class="gi-slider swiper-container main-slider-nav main-slider-dot">
                        <!-- Une seule fois, contenu fixe  slider-animation-->
                        <div class="gi-slide-content fixed-slide-content" style="position: absolute; margin: 0; max-width: 100%;">
                            <p class="p-letter color">{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y') }}</p>
                            <h1 class="gi-slide-title text-uppercase opopop">
                                <span class="color">Votre</span>
                                <span class="ravmel-color1">boutique</span>
                                <span class="color">en ligne</span>
                            </h1>
                            <!-- <div class="gi-slide-btn">
                                <a href="#" class="gi-btn-1 background">Catalogue 
                                    <i class="fi-rr-angle-double-small-right" aria-hidden="true"></i>
                                </a>
                            </div> -->
                        </div>

                        <div class="swiper-wrapper">
                            <div class="gi-slide-item swiper-slide d-flex slide-1">
                            </div>
                            <div class="gi-slide-item swiper-slide d-flex slide-2">
                            </div>
                        </div>
                        <div class="swiper-pagination swiper-pagination-white"></div>
                        <div class="swiper-buttons">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 


<!-- <section class="section gi-hero m-tb-40 background">
    <div class="container">
        <div class="gi-main-content">
            <div class="gi-slider-content">
                <div class="gi-main-slider">
                    <div class="gi-slider swiper-container main-slider-nav main-slider-dot">
                        <div class="swiper-wrapper">
                            <div class="gi-slide-item swiper-slide d-flex slide-1">
                                <div class="gi-slide-content slider-animation">
                                    <p class="p-letter color">{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}
                                        <b></b>
                                    </p>
                                    <h1 class="gi-slide-title text-uppercase">
                                        <span class="color">Votre</span>
                                        <span class="ravmel-color1">boutique</span>
                                        <span class="color">en ligne</span>
                                    </h1>
                                    <div class="gi-slide-btn">
                                        <a href="#" class="gi-btn-1 background">Catalogue <i
                                                class="fi-rr-angle-double-small-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="gi-slide-item swiper-slide d-flex slide-2">
                                <div class="gi-slide-content slider-animation">
                                    <p class="p-letter color">{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}
                                        <b></b>
                                    </p>
                                    <h1 class="gi-slide-title text-uppercase">
                                        <span class="color">Votre</span>
                                        <span class="ravmel-color2">boutique</span>
                                        <span class="color">en ligne</span>
                                    </h1>
                                    <div class="gi-slide-btn">
                                        <a href="#" class="gi-btn-1 background">Catalogue <i
                                                class="fi-rr-angle-double-small-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination swiper-pagination-white"></div>
                        <div class="swiper-buttons">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Hero Slider End -->

<!-- Team Section -->
<section class="gi-team-section padding-tb-40 background">
    <div class="container">
        @if(produit()->count() > 0)
        <div class="section-title-2 align-items-start">
            <h2 class="gi-title">Fraîchement <span>arrivé !</span></h2>
            <p>Découvrez ces nouvelles pépites ! Innovation, qualité et plaisir garantis.</p>
        </div>
        <div class="gi-team owl-carousel">
            <!-- -->
            @foreach(categories() as $categorie)
            @php
            $ss = $categorie->souscategories->count();
            $total = 0;
            if($ss > 0)
            {
            foreach($categorie->souscategories as $souscategorie)
            {
            if($souscategorie->produits->where('isvalide', 1)->count() > 0)
            {
            $total++;
            }
            }
            }
            @endphp
            @if($categorie->souscategories->count() > 0 && $total > 0)
            @foreach($categorie->souscategories as $souscategories)
            @if($souscategories->produits->where('isvalide', 1)->count() > 0)
            @php
            $produitC = $souscategories->produits()->where('isvalide', 1)->orderBy('updated_at','desc')->get()->take(2)
            @endphp
            @foreach($produitC as $produit)
            <div class="gi-team-box">
                <div class="gi-product-content">
                    <div class="gi-product-inner">
                        <div class="gi-pro-image-outer">
                            <div class="gi-pro-image">
                                <a href="{{ route('detail.produit', $produit) }}" class="image">
                                    <span class="label veg">
                                        <span class="dot"></span>
                                    </span>
                                    <div id="carou{{ $produit->id }}Interval" class="carousel slide" data-bs-ride="carousel">
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
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carou{{ $produit->id }}Interval" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carou{{ $produit->id }}Interval" data-bs-slide="next">
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
            @endif
            @endforeach
            @endif
            @endforeach
        </div>
        @else
        <div class="section-title-2">
            <h2 class="gi-title">Fraîchement <span>arrivé !</span></h2><!--Fraîchement arrivé ! Découvrez ces nouvelles pépites ! Innovation, qualité et plaisir garantis.-->
            <p>Desolé! Aucune nouvelle arrivé.</p>
        </div>
        @endif
    </div>
</section>
<!-- Facts Section End -->

<!-- Banner section -->
<section class="gi-banner padding-tb-40 wow fadeInUp background" data-wow-duration="2s">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="gi-animated-banner" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="200">
                    <h2 class="d-none">Sacs à main Dame</h2>
                    <div class="gi-bnr-detail" style="padding-right: 20px;">
                        <div class="gi-bnr-info">
                            <h2 class="color">Des Articles en Promo à GOGO !</h2>
                            <h3 class="ravmel-color3">Profitez de nos réductions.</h3>
                            <h3 class="ravmel-color3">Offre exclusive !<br> Dans la limite des stocks disponibles.</h3>
                            <h3><span class="color">Dépêchez-vous !!!</span></h3>
                            <a href="{{ route('all.produit.promo') }}" class="gi-btn-2">Tout voir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner section End -->

<!-- New Product tab Area Start -->
<section class="gi-product-tab gi-products padding-tb-40 wow fadeInUp background" data-wow-duration="2s">
    <div class="container">
        <div class="gi-tab-title">
            <div class="gi-main-title">
                <div class="section-title">
                    <div class="section-detail">
                        <h2 class="gi-title">La qualité, <span class="ravmel-color2 text-underline">c'est chez nous.</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="gi-tab-title">
            <div class="gi-pro-tab">
                <ul class="gi-pro-tab-nav align-items-center nav">
                    <li class="nav-item mb-4"><a class="nav-link nav-link-perso color active" data-bs-toggle="tab" href="#allCategorie">All Produit</a></li>
                    @if(categories()->count() > 0)
                    @foreach(categories() as $categorie)
                    @php
                    $ss = $categorie->souscategories->count();
                    $total = 0;
                    if($ss > 0)
                    {
                    foreach($categorie->souscategories as $souscategorie)
                    {
                    if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                    {
                    $total++;
                    }
                    }
                    }
                    @endphp
                    @if($categorie->souscategories->count() > 0 && $total > 0)
                    <li class="nav-item mb-4"><a class="nav-link nav-link-perso color" data-bs-toggle="tab" href="#categorie{{ $categorie->id }}">{{ $categorie->nom }}</a></li>
                    @endif
                    @endforeach
                    @endif
                    <li class="nav-item mb-4"><a class="nav-link nav-link-perso color" data-bs-toggle="tab" href="#allPR">Produit reconditionné</a></li>
                </ul>
            </div>
        </div>

        <div class="row m-b-minus-24px">
            <div class="col">
                <div class="tab-content">
                    <div class="tab-pane fade show active product-block" id="allCategorie">
                        <div class="row">
                            @foreach($produits as $produit)
                                <div class="col-md-4 col-sm-6 col-xs-6 gi-col-5 gi-product-box">
                                    <div class="gi-product-content">
                                        <div class="gi-product-inner">
                                            <div class="gi-pro-image-outer">
                                                <div class="gi-pro-image">
                                                    <a href="{{ route('detail.produit', $produit) }}" class="image">

                                                        <span class="label veg">
                                                            <span class="dot"></span>
                                                        </span>
                                                        <div id="carousel{{ $produit->id }}ExampleInterval" class="carousel slide" data-bs-ride="carousel">
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
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $produit->id }}ExampleInterval" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $produit->id }}ExampleInterval" data-bs-slide="next">
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
                                                            <!-- <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                        class="fi-rr-heart"></i></a> -->
                                                            <a href="#" class="gi-btn-group quickview"
                                                                data-link-action="quickview" title="Quick view"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addProduitPanier{{ $produit->id }}"><i
                                                                    class="fi-rr-eye"></i></a>
                                                            <!-- <a href="{{ route('post.formation', $produit) }}" class="gi-btn-group compare"
                                                                    title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
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
                                                <a href="{{ route('detail.produit', $produit) }}">
                                                    <h6 class="gi-pro-stitle">{{ $produit->nom }}</h6>
                                                </a>
                                                <h5 class="gi-pro-title">
                                                    <a href="{{ route('detail.produit', $produit) }}">{{ $produit->description }}</a>
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
                                @include('include.principale.produit')
                            @endforeach
                        </div>
                    </div>
                    @if(categories()->count() > 0)
                    @foreach(categories() as $categorie)
                    @php
                    $ss = $categorie->souscategories->count();
                    $total = 0;
                    if($ss > 0)
                    {
                    foreach($categorie->souscategories as $souscategorie)
                    {
                    if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                    {
                    $total++;
                    }
                    }
                    }
                    @endphp
                    @if($categorie->souscategories->count() > 0 && $total > 0)
                    <div class="tab-pane fade" id="categorie{{ $categorie->id }}">
                        <div class="row">
                            @foreach($categorie->souscategories as $souscategories)
                            @if($souscategories->produits->where('isvalide', 1)->count() > 0)
                            @foreach($souscategories->produits->where('isvalide', 1) as $produit)
                            <div class="col-md-4 col-sm-6 col-xs-6 gi-col-5 gi-product-box">
                                <div class="gi-product-content">
                                    <div class="gi-product-inner">
                                        <div class="gi-pro-image-outer">
                                            <div class="gi-pro-image">
                                                <a href="{{ route('detail.produit', $produit) }}" class="image">
                                                    <!-- Image carousel -->
                                                    <span class="label veg">
                                                        <span class="dot"></span>
                                                    </span>
                                                    <div id="carousel{{ $produit->id }}Example" class="carousel slide" data-bs-ride="carousel">
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
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $produit->id }}Example" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $produit->id }}Example" data-bs-slide="next">
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
                                                        <!-- <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                                        class="fi-rr-heart"></i></a> -->
                                                        <a href="#" class="gi-btn-group quickview"
                                                            data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addProduitPanierDeux{{ $produit->id }}"><i
                                                                class="fi-rr-eye"></i></a>
                                                        <!-- <a href="{{ route('post.formation', $produit) }}" class="gi-btn-group compare"
                                                                                    title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
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
                                                <a href="{{ route('detail.produit', $produit) }}">{{ $produit->description }}</a>
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
                                                    <span class="new-price">{{ $produit->promo }} Fcfa</span>
                                                    <span class="old-price">{{ $produit->prix }} F</span>
                                                    @else
                                                    <span class="new-price">{{ $produit->prix }} Fcfa</span>
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
                            @include('include.principale.produit-deux')
                            @endforeach
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                    
                    <div class="tab-pane fade" id="allPR">
                        <div class="row">
                            @foreach($produits->where('etat', 0) as $produit)
                                <div class="col-md-4 col-sm-6 col-xs-6 gi-col-5 gi-product-box">
                                    <div class="gi-product-content">
                                        <div class="gi-product-inner">
                                            <div class="gi-pro-image-outer">
                                                <div class="gi-pro-image">
                                                    <a href="{{ route('detail.produit', $produit) }}" class="image">

                                                        <span class="label veg">
                                                            <span class="dot"></span>
                                                        </span>
                                                        <div id="caro{{ $produit->id }}uselExamp" class="carousel slide" data-bs-ride="carousel">
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
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#caro{{ $produit->id }}uselExamp" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#caro{{ $produit->id }}uselExamp" data-bs-slide="next">
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
                                                        <!-- <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                    class="fi-rr-heart"></i></a> -->
                                                        <a href="#" class="gi-btn-group quickview"
                                                            data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addProduitPanierTrois{{ $produit->id }}"><i
                                                                class="fi-rr-eye"></i></a>
                                                        <!-- <a href="{{ route('post.formation', $produit) }}" class="gi-btn-group compare"
                                                                title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
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
                                                <a href="{{ route('detail.produit', $produit) }}">
                                                    <h6 class="gi-pro-stitle">{{ $produit->nom }}</h6>
                                                </a>
                                                <h5 class="gi-pro-title">
                                                    <a href="{{ route('detail.produit', $produit) }}">{{ $produit->description }}</a>
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
                                @include('include.principale.produit-trois')
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product tab Area End -->

<!-- Offer Banner Section Start -->
<section class="gi-offer-section padding-tb-40 background">
    <div class="container">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-duration="2s">
                <div class="gi-ofr-banners">
                    <div class="gi-bnr-body">
                        <div class="gi-bnr-img">
                            <span class="lbl">Nos formations</span>
                            <img src="assets/img/banner/2.jpg" alt="banner">
                        </div>
                        <div class="gi-bnr-detail align-items-center">
                            <h5>Formation</h5>
                            <p>Adapté pour tous !</p>
                            <a href="{{ route('all.formation') }}" class="gi-btn-2">Formations disponibles</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-duration="2s">
                <div class="gi-ofr-banners m-t-767">
                    <div class="gi-bnr-body">
                        <div class="gi-bnr-img">
                            <span class="lbl">Opportunité à saisir</span>
                            <img src="assets/img/banner/3.jpg" alt="banner">
                        </div>
                        <div class="gi-bnr-detail align-items-center">
                            <h5>Produits reconditionnés</h5>
                            <p>Visitez nos produits reconditionnés.</p>
                            <a href="{{ route('all.produit.reconditionne') }}" class="gi-btn-2">Voir maintenant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Offer section end -->

<!-- Service Section -->
<section class="gi-service-section padding-tb-40 background">
    <div class="container">
        <div class="row m-tb-minus-12">
            <div class="gi-ser-content gi-ser-content-1 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp">
                <div class="gi-ser-inner">
                    <div class="gi-service-image">
                        <i class="fi fi-ts-truck-moving"></i>
                    </div>
                    <div class="gi-service-desc">
                        <h3>Livraison</h3>
                        <p>
                            Expédition soignée et suivi efficace.
                            <br>
                            Votre satisfaction est notre priorité !
                        </p>
                    </div>
                </div>
            </div>
            <div class="gi-ser-content gi-ser-content-2 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp"
                data-wow-delay=".4s">
                <div class="gi-ser-inner">
                    <div class="gi-service-image">
                        <i class="fi fi-ts-hand-holding-seeding"></i>
                    </div>
                    <div class="gi-service-desc">
                        <h3>Assistance 24h/7</h3>
                        <p>
                            Contactez-nous :
                            <br>
                            24 heures sur 24 & 7 jours sur 7
                        </p>
                    </div>
                </div>
            </div>
            <div class="gi-ser-content gi-ser-content-3 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp"
                data-wow-delay=".6s">
                <div class="gi-ser-inner">
                    <div class="gi-service-image">
                        <i class="fa fa-headset"></i>
                    </div>
                    <div class="gi-service-desc">
                        <h3>Service client</h3>
                        <p>
                            Écoute et efficacité
                            <br>
                            au service de vos besoins.
                        </p>
                    </div>
                </div>
            </div>
            <div class="gi-ser-content gi-ser-content-4 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp"
                data-wow-delay=".8s">
                <div class="gi-ser-inner">
                    <div class="gi-service-image">
                        <i class="fi fi-ts-donate"></i>
                    </div>
                    <div class="gi-service-desc">
                        <h3>Paiement sécurisé</h3>
                        <p>
                            Payez en toute sécurité.
                            <br>
                            Payez en toute confiance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Section End -->

<!-- Trending, Top Rated Start -->
<section class="gi-offer-section padding-tb-40 background">
    <div class="container">
        <div class="row">
            <div
                class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content wow fadeInUp">
                <div class="gi-banner-inner">
                    <div class="gi-banner-block gi-banner-block-1">
                        <div class="banner-block">
                            <div class="banner-content align-items-center">
                                <div class="banner-text text-center">
                                    <span class="gi-banner-title">Conseils et astuces</span>
                                </div>
                                <a href="{{ route('conseil.astuce') }}" class="gi-btn-2">Voir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content mt-767-40 wow fadeInUp"
                data-wow-delay=".4s">
                <div class="col-md-12">
                    <div class="section-title">
                        <div class="section-detail">
                            <h2 class="gi-title">Produit en <span>Promo</span></h2>
                        </div>
                    </div>
                </div>
                <div class="gi-trending-slider">
                    @if(produitpromo()->count() > 0)
                    @foreach(produitpromo() as $produit)
                    <div class="col-sm-12 gi-all-product-block">
                        <div class="gi-all-product-inner">
                            <div class="gi-pro-image-outer">
                                <div class="gi-pro-image">
                                    <a href="{{ route('detail.produit', $produit) }}" class="image">
                                        <img class="main-image" src="{{ asset(Storage::url($produit->image)) }}"
                                            alt="Product">
                                    </a>
                                </div>
                            </div>
                            <div class="gi-pro-content">
                                <h5 class="gi-pro-title"><a href="{{ route('detail.produit', $produit) }}"
                                        title="Healthy Nutmix, 200g Pack">{{ $produit->nom }}</a></h5>
                                <h6 class="gi-pro-stitle"><a href="{{ route('detail.produit', $produit) }}">{{ $produit->souscategorie->nom }}</a></h6>
                                <div class="gi-pro-rat-price">
                                    <div class="gi-pro-rat-pri-inner">
                                        <span class="gi-price">
                                            @if($produit->promo)
                                            <span class="new-price">{{ getprice($produit->promo) }}</span>
                                            <span class="old-price">{{ getprice($produit->prix) }}</span>
                                            @else
                                            <span class="new-price">{{ getprice($produit->prix) }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if($produit->stock && $produit->qtyStock >= 1)
                                <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                    @csrf
                                    <button type="submit" title="Ajouter au panier"
                                        class="gi-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h5 class="text-danger">Aucun produit en promo</h5>
                    @endif
                </div>
            </div>
            <!-- Top Rated -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content mt-1199-40 wow fadeInUp"
                data-wow-delay=".6s">
                <div class="col-md-12">
                    <div class="section-title">
                        <div class="section-detail">
                            <h2 class="gi-title">Nouvelle <span>Arrivé</span></h2>
                        </div>
                    </div>
                </div>
                <div class="gi-rated-slider">
                    @if(produit()->count() > 0)
                    @foreach(produit() as $produit)
                    <div class="col-sm-12 gi-all-product-block">
                        <div class="gi-all-product-inner">
                            <div class="gi-pro-image-outer">
                                <div class="gi-pro-image">
                                    <a href="{{ route('detail.produit', $produit) }}" class="image">
                                        <img class="main-image" src="{{ asset(Storage::url($produit->image)) }}"
                                            alt="Product">
                                    </a>
                                </div>
                            </div>
                            <div class="gi-pro-content">
                                <h5 class="gi-pro-title"><a href="{{ route('detail.produit', $produit) }}">{{ $produit->nom }}</a>
                                </h5>
                                <h6 class="gi-pro-stitle"><a href="{{ route('detail.produit', $produit) }}">{{ $produit->souscategorie->nom }}</a></h6>
                                <div class="gi-pro-rat-price">
                                    <div class="gi-pro-rat-pri-inner">
                                        <span class="gi-price">
                                            @if($produit->promo)
                                            <span class="new-price">{{ getprice($produit->promo) }}</span>
                                            <span class="old-price">{{ getprice($produit->prix) }}</span>
                                            @else
                                            <span class="new-price">{{ getprice($produit->prix) }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if($produit->stock && $produit->qtyStock >= 1)
                                <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                    @csrf
                                    <button type="submit" title="Ajouter au panier"
                                        class="gi-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h5 class="text-danger">Aucune Nouvelle Arrivé</h5>
                    @endif
                </div>
            </div>
            <!-- Top Selling -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content mt-1199-40 wow fadeInUp"
                data-wow-delay=".8s">
                <div class="col-md-12">
                    <div class="section-title">
                        <div class="section-detail">
                            <h2 class="gi-title">Veilleur <span>Vendu</span></h2>
                        </div>
                    </div>
                </div>
                <div class="gi-trending-slider">
                    @if(produitAncien()->count() > 0)
                    @foreach(produitAncien() as $produit)
                    <div class="col-sm-12 gi-all-product-block">
                        <div class="gi-all-product-inner">
                            <div class="gi-pro-image-outer">
                                <div class="gi-pro-image">
                                    <a href="{{ route('detail.produit', $produit) }}" class="image">
                                        <img class="main-image" src="{{ asset(Storage::url($produit->image)) }}"
                                            alt="Product">
                                    </a>
                                </div>
                            </div>
                            <div class="gi-pro-content">
                                <h5 class="gi-pro-title"><a href="{{ route('detail.produit', $produit) }}">{{ $produit->nom }}</a>
                                </h5>
                                <h6 class="gi-pro-stitle"><a href="{{ route('detail.produit', $produit) }}">{{ $produit->souscategorie->nom }}</a></h6>
                                <div class="gi-pro-rat-price">
                                    <div class="gi-pro-rat-pri-inner">
                                        <span class="gi-price">
                                            @if($produit->promo)
                                            <span class="new-price">{{ getprice($produit->promo) }}</span>
                                            <span class="old-price">{{ getprice($produit->prix) }}</span>
                                            @else
                                            <span class="new-price">{{ getprice($produit->prix) }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if($produit->stock && $produit->qtyStock >= 1)
                                <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                    @csrf
                                    <button type="submit" title="Ajouter au panier"
                                        class="gi-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h5 class="text-danger">Pas de meilleur vendu</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trending, Top Rated End -->


@endsection