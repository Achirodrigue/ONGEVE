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
                            <h2 class="gi-breadcrumb-title">Catégorie de produit : {{ $categorie->nom }}</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">{{ $categorie->nom }}</li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <!-- Shop section -->
    <section class="gi-shop padding-tb-40 background">
        <div class="container">
            <!-- Shop Banners Start -->
            <div class="padding-b-40 m-b-40">
                <div class="row">
                    <div class="col-md-6">
                        <div class="gi-ofr-banners">
                            <div class="gi-bnr-body">
                                <div class="gi-bnr-img">
                                    <span class="lbl">70% Off</span>
                                    <img src="{{ asset("principale/assets/img/banner/5.jpg") }}" alt="banner">
                                </div>
                                <div class="gi-bnr-detail">
                                    <h5>Fresh Fruits & veggies</h5>
                                    <p>The flavor of something special.</p>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gi-ofr-banners m-t-767">
                            <div class="gi-bnr-body">
                                <div class="gi-bnr-img">
                                    <span class="lbl">50% Off</span>
                                    <img src="{{ asset("principale/assets/img/banner/6.jpg") }}" alt="banner">
                                </div>
                                <div class="gi-bnr-detail">
                                    <h5>Tasty Snack & Fastfood</h5>
                                    <p>A healthy meal for every one.</p>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="gi-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    <div class="gi-pro-list-top d-flex">
                        <div class="col-md-6 gi-grid-list">
                            <div class="gi-gl-btn">
                                <button class="grid-btn btn-grid-50">
                                    <i class="fi fi-rr-apps"></i>
                                </button>
                                <button class="grid-btn btn-list-50 active">
                                    <i class="fi fi-rr-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->


                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row">
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
                                    @foreach($categorie->souscategories as $souscategorie) 
                                        @if($souscategorie->produits->where('isvalide', 1)->count() > 0)  
                                            @foreach($souscategorie->produits->where('isvalide', 1) as $produit)
                                                <div
                                                    class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 gi-product-box pro-gl-content">
                                                    <div class="gi-product-content">
                                                        <div class="gi-product-inner">
                                                            <div class="gi-pro-image-outer">
                                                                <div class="gi-pro-image">
                                                                    <a href="{{ route('detail.produit', $produit) }}" class="image">
                                                                        <!-- Image carousel -->
                                                                        <span class="label veg">
                                                                            <span class="dot"></span>
                                                                        </span>
                                                                        <div id="carouselExample{{ $produit->id }}Interval" class="carousel slide" data-bs-ride="carousel">
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
                                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $produit->id }}Interval" data-bs-slide="prev">
                                                                                <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                                                                <span class="visually-hidden">Previous</span>
                                                                            </button>
                                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $produit->id }}Interval" data-bs-slide="next">
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
                                                                        <a href="#" class="gi-btn-group quickview"
                                                                            data-link-action="quickview" title="Quick view"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#addProduitPanier{{ $produit->id }}"><i
                                                                                class="fi-rr-eye"></i></a>
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
                                        @endif  
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--Shop content End -->

                </div>
                <!-- Sidebar Area Start -->
                <div class="gi-shop-sidebar col-lg-3 order-lg-first col-md-12 order-md-last m-t-991">
                    <div id="shop_sidebar">
                        <div class="gi-sidebar-wrap">
                            <!-- Sidebar Category Block -->
                            <div class="gi-sidebar-block drop">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Categories</h3>
                                </div>
                                @foreach(categories() as $categ)  
                                    @php 
                                        $ss = $categ->souscategories->count();
                                        $total = 0;
                                        if($ss > 0)
                                        {
                                            foreach($categ->souscategories as $souscategorie)
                                            {
                                                if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                                                {
                                                    $total++;
                                                }
                                            }
                                        }
                                    @endphp 
                                
                                    @if($categ->souscategories->count() > 0 && $total > 0)
                                        <div class="gi-sb-block-content pt-2">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" class="gi-sidebar-block-item main drop @if($categorie->id === $categ->id) text-warning @endif">{{ $categ->nom }}</a>
                                                    <ul @if($categorie->id === $categ->id) style="display: block;" @endif>
                                                        @foreach($categ->souscategories as $souscategorie)  
                                                            @if($souscategorie->produits->where('isvalide', 1)->count() > 0)  
                                                                <li>
                                                                    <div class="gi-sidebar-sub-item"><a href="{{ route('scategorie.produit', $souscategorie) }}">{{ $souscategorie->nom }}
                                                                        <span>{{ $souscategorie->produits->where('isvalide', 1)->count() }}</span></a>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Sidebar Price Block -->
                            <div class="gi-sidebar-block">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Prix</h3>
                                </div>
                                <div class="gi-sb-block-content gi-price-range-slider es-price-slider">
                                    <div class="gi-price-filter">
                                        <div class="gi-price-input">
                                            <label class="filter__label">
                                                De<input type="text" class="filter__input">
                                            </label>
                                            <span class="gi-price-divider"></span>
                                            <label class="filter__label">
                                                à<input type="text" class="filter__input">
                                            </label>
                                        </div>
                                        <div id="gi-sliderPrice" class="filter__slider-price" data-min="1"
                                            data-max="1000000" data-step="10"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar tags -->
                            <div class="gi-sidebar-block">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Tags</h3>
                                </div>
                                <div class="gi-tag-block gi-sb-block-content d-flex flex-column">
                                    @if(categories()->count() > 0)   
                                        @php $n = 1; @endphp

                                        @foreach(categories() as $categorie)   
                                            @if($categorie->souscategories->count() > 0 && CategScateg($categorie) > 0)
                                                <a href="{{ route('categorie.produit', $categorie) }}" class="gi-btn-2 mb-2">{{ $categorie->nom }}</a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop section End -->
    

@endsection    