@extends('principale.layout.app')
@section('body')

    @include('include.principale.message')

    <!-- Breadcrumb start -->
    <div class="gi-breadcrumb m-b-40 background">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="gi-breadcrumb-title">Mon panier</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">Page panier</li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->
   
    <!-- Cart section -->
    <section class="gi-cart-section padding-tb-40 background">
        <!-- <h2 class="d-none">Cart Page</h2> -->
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="gi-cart-rightside col-lg-4 col-md-12">
                    <div class="gi-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="gi-sidebar-block">
                            <div class="gi-sb-title">
                                <h3 class="gi-sidebar-title">Solde à verser</h3>
                            </div>
                            <!-- <div class="gi-sb-block-content">
                                <h4 class="gi-ship-title">Estimate Shipping</h4>
                                <div class="gi-cart-form">
                                    <p>Enter your destination to get a shipping estimate</p>
                                    <form action="#" method="post">
                                        <span class="gi-cart-wrap">
                                            <label>Zip/Postal Code</label>
                                            <input type="text" name="postalcode" placeholder="Zip/Postal Code">
                                        </span>
                                    </form>
                                </div>
                            </div> -->

                            <div class="gi-sb-block-content">
                                <div class="gi-cart-summary-bottom">
                                    <div class="gi-cart-summary">
                                        <div>
                                            <span class="text-left">Sous Total</span>
                                            <span class="text-right">{{ getprice(Cart::subtotal()) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-left"><i class="bi bi-truck" style="font-size: 2em;"></i> Frais de livraison</span>
                                            <span class="text-right">0F pour l'instant</span>
                                        </div>
                                        <!-- <div>
                                            <span class="text-left">Coupan Discount</span>
                                            <span class="text-right"><a class="gi-cart-coupan">Apply Coupan</a></span>
                                        </div>
                                        <div class="gi-cart-coupan-content">
                                            <form class="gi-cart-coupan-form" name="gi-cart-coupan-form" method="post"
                                                action="#">
                                                <input class="gi-coupan" type="text" required=""
                                                    placeholder="Enter Your Coupan Code" name="gi-coupan" value="">
                                                <button class="gi-btn-2" type="submit" name="subscribe"
                                                    value="">Apply</button>
                                            </form>
                                        </div> -->
                                        <div class="gi-cart-summary-total">
                                            <span class="text-left">Total à payer</span>
                                            <span class="text-right">{{ getprice(Cart::subtotal()) }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gi-cart-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- cart content Start -->
                    <div class="gi-cart-content">
                        <div class="gi-cart-inner">
                            <div class="row">
                                @if ( Cart::count() > 0 )
                                    <form action="{{ route('cart.updateMultiple') }}" method="POST">
                                    @csrf
                                        <div class="table-content cart-table-content">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th>Prix</th>
                                                        <th style="text-align: center;">Quantité</th>
                                                        <th>Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Cart::content() as $produit)
                                                        <tr>
                                                            <td data-label="Product" class="gi-cart-pro-name">
                                                                <a href="{{ route('detail.produit', $produit->model->id) }}">
                                                                    <img class="gi-cart-pro-img mr-4"
                                                                        src="{{ asset(Storage::url($produit->model->image)) }}" alt="">
                                                                        {{ $produit->model->nom }}
                                                                </a>
                                                            </td>
                                                            <td data-label="Price" class="gi-cart-pro-price">
                                                                <span class="amount">{{ getprice($produit->price) }}</span>
                                                            </td>
                                                            <td data-label="Quantity" class="gi-cart-pro-qty"
                                                                style="text-align: center;">
                                                                <div class="cart-qty-plus-minus">
                                                                    <input class="cart-plus-minus" type="number"
                                                                        name="produit[{{ $produit->rowId }}][qty]" min="1" max="{{ $produit->model->qtyStock }}" value="{{ $produit->qty }}">
                                                                    @error('produit[{{ $produit->rowId }}][qty]') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                                </div>
                                                            </td>
                                                            <td data-label="Total" class="gi-cart-pro-subtotal">{{ getprice($produit->subtotal()) }}</td>
                                                            <td data-label="Remove" class="gi-cart-pro-remove">
                                                                <a href="{{ route('retirer.produit.panier', $produit->rowId) }}"><i class="gicon gi-trash-o"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <!-- <tr>
                                                        <td data-label="Product" class="gi-cart-pro-name">
                                                            <a href="product-left-sidebar.html">
                                                                <img class="gi-cart-pro-img mr-4"
                                                                    src="assets/img/product-images/2_1.jpg" alt="">Dates
                                                                Value Pack Pouch
                                                            </a>
                                                        </td>
                                                        <td data-label="Price" class="gi-cart-pro-price">
                                                            <span class="amount">$75.00</span>
                                                        </td>
                                                        <td data-label="Quantity" class="gi-cart-pro-qty"
                                                            style="text-align: center;">
                                                            <div class="cart-qty-plus-minus">
                                                                <input class="cart-plus-minus" type="text"
                                                                    name="cartqtybutton" value="1">
                                                            </div>
                                                        </td>
                                                        <td data-label="Total" class="gi-cart-pro-subtotal">$75.00</td>
                                                        <td data-label="Remove" class="gi-cart-pro-remove">
                                                            <a href="#"><i class="gicon gi-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td data-label="Product" class="gi-cart-pro-name"><a
                                                                href="product-left-sidebar.html">
                                                                <img class="gi-cart-pro-img mr-4"
                                                                    src="assets/img/product-images/3_1.jpg"
                                                                    alt="">Californian Almonds Value Pack
                                                            </a>
                                                        </td>
                                                        <td data-label="Price" class="gi-cart-pro-price">
                                                            <span class="amount">$48.00</span>
                                                        </td>
                                                        <td data-label="Quantity" class="gi-cart-pro-qty"
                                                            style="text-align: center;">
                                                            <div class="cart-qty-plus-minus">
                                                                <input class="cart-plus-minus" type="text"
                                                                    name="cartqtybutton" value="1">
                                                            </div>
                                                        </td>
                                                        <td data-label="Total" class="gi-cart-pro-subtotal">$48.00</td>
                                                        <td data-label="Remove" class="gi-cart-pro-remove">
                                                            <a href="#"><i class="gicon gi-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td data-label="Product" class="gi-cart-pro-name"><a
                                                                href="product-left-sidebar.html">
                                                                <img class="gi-cart-pro-img mr-4"
                                                                    src="assets/img/product-images/4_1.jpg" alt="">Banana
                                                                Chips Snacks & Spices
                                                            </a>
                                                        </td>
                                                        <td data-label="Price" class="gi-cart-pro-price">
                                                            <span class="amount">$95.00</span>
                                                        </td>
                                                        <td data-label="Quantity" class="gi-cart-pro-qty"
                                                            style="text-align: center;">
                                                            <div class="cart-qty-plus-minus">
                                                                <input class="cart-plus-minus" type="text"
                                                                    name="cartqtybutton" value="1">
                                                            </div>
                                                        </td>
                                                        <td data-label="Total" class="gi-cart-pro-subtotal">$95.00</td>
                                                        <td data-label="Remove" class="gi-cart-pro-remove">
                                                            <a href="#"><i class="gicon gi-trash-o"></i></a>
                                                        </td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="gi-cart-update-bottom">
                                                    <a href="{{ route('facturation') }}" class="gi-btn-2 text-white mr-2" style="text-decoration: none;">Finaliser ma commande</a>
                                                    <button type="submit" class="gi-btn-2">Mettre à jour</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="col-12 text-center">
                                        <h4><b>Désolé! Votre panier est vide.</b></h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Cart section End -->

    <!-- New product section -->
    <!-- <section class="gi-new-product padding-tb-40 background">
        <div class="container">
            <div class="row overflow-hidden m-b-minus-24px">
                <div class="gi-new-prod-section col-lg-12">
                    <div class="gi-products">
                        @if($produits->count() > 0)
                            <div class="section-title-2" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="200">
                                <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                                <p>Browse The Collection of Top Products</p>
                            </div>
                            <div class="gi-new-block m-minus-lr-12" data-aos="fade-up" data-aos-duration="2000"
                                data-aos-delay="300">
                                <div class="new-product-carousel owl-carousel gi-product-slider">
                                    
                                    @foreach($produits as $produit)
                                        <div class="gi-product-content">
                                            <div class="gi-product-inner">
                                                <div class="gi-pro-image-outer">
                                                    <div class="gi-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <span class="label veg">
                                                                <span class="dot"></span>
                                                            </span>
                                                            <img class="main-image" src="{{ asset(Storage::url($produit->image)) }}"
                                                                alt="Product">
                                                            <img class="hover-image" src="{{ asset(Storage::url($produit->image)) }}"
                                                                alt="Product">
                                                        </a>
                                                        <span class="flags">
                                                            <span class="sale">Sale</span>
                                                        </span>
                                                        <div class="gi-pro-actions">
                                                            <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                    class="fi-rr-heart"></i></a>
                                                            <a href="#" class="gi-btn-group quickview"
                                                                data-link-action="quickview" title="Quick view"
                                                                data-bs-toggle="modal" data-bs-target="#gi_quickview_modal"><i
                                                                    class="fi-rr-eye"></i></a>
                                                            <a href="javascript:void(0)" class="gi-btn-group compare"
                                                                title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                            <a href="javascript:void(0)" title="Add To Cart"
                                                                class="gi-btn-group add-to-cart"><i
                                                                    class="fi-rr-shopping-basket"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gi-pro-content">
                                                    <a href="shop-left-sidebar-col-3.html">
                                                        <h6 class="gi-pro-stitle">{{ $produit->nom }}</h6>
                                                    </a>
                                                    <h5 class="gi-pro-title">
                                                        <a href="product-left-sidebar.html">{{ $produit->description }}</a>
                                                    </h5>
                                                    <div class="gi-pro-rat-price">
                                                        <span class="gi-pro-rating">
                                                            <i class="gicon gi-star fill"></i>
                                                            <i class="gicon gi-star fill"></i>
                                                            <i class="gicon gi-star fill"></i>
                                                            <i class="gicon gi-star fill"></i>
                                                            <i class="gicon gi-star"></i>
                                                        </span>
                                                        <span class="gi-price">
                                                            @if($produit->promo)
                                                                <span class="new-price">{{ $produit->promo }} F</span>
                                                                <span class="old-price">{{ $produit->prix }} F</span>
                                                            @else
                                                                <span class="new-price">{{ $produit->prix }} F</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="gi-product-content">
                                        <div class="gi-product-inner">
                                            <div class="gi-pro-image-outer">
                                                <div class="gi-pro-image">
                                                    <a href="product-left-sidebar.html" class="image">
                                                        <img class="main-image" src="assets/img/product-images/3_1.jpg"
                                                            alt="Product">
                                                        <img class="hover-image" src="assets/img/product-images/3_1.jpg"
                                                            alt="Product">
                                                    </a>
                                                    <span class="flags">
                                                        <span class="sale">Sale</span>
                                                    </span>
                                                    <div class="gi-pro-actions">
                                                        <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                class="fi-rr-heart"></i></a>
                                                        <a href="#" class="gi-btn-group quickview"
                                                            data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal" data-bs-target="#gi_quickview_modal"><i
                                                                class="fi-rr-eye"></i></a>
                                                        <a href="javascript:void(0)" class="gi-btn-group compare"
                                                            title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                        <a href="javascript:void(0)" title="Add To Cart"
                                                            class="gi-btn-group add-to-cart"><i
                                                                class="fi-rr-shopping-basket"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gi-pro-content">
                                                <a href="shop-left-sidebar-col-3.html">
                                                    <h6 class="gi-pro-stitle">Cookies</h6>
                                                </a>
                                                <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Multi-Grain
                                                        Jaggery Combo Cookies</a></h5>
                                                <div class="gi-pro-rat-price">
                                                    <span class="gi-pro-rating">
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star"></i>
                                                        <i class="gicon gi-star"></i>
                                                        <span class="qty">10 kg</span>
                                                    </span>
                                                    <span class="gi-price">
                                                        <span class="new-price">$25.00</span>
                                                        <span class="old-price">$30.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="section-title-2" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="200">
                                <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                                <p>Désolé! Aucun produit disponible</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- New product section End -->

    
    <!-- Team Section -->
    <section class="gi-team-section padding-tb-40 background">
        <div class="container">
            @if(produit()->count() > 0)
                <div class="section-title-2">
                    <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                    <p>Decouvrez des produits exellents et de bonnes qualité.</p>
                </div>
                <div class="gi-team owl-carousel">
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
                    <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                    <p>Decouvrez des produits exellents et de bonnes qualité.</p>
                </div>
            @endif
        </div>
    </section>
    <!-- Facts Section End -->



@endsection