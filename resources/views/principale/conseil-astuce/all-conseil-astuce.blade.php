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
                            <h2 class="gi-breadcrumb-title">Astuces et conseils</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="#">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">Très enrichissant</li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <!-- Faq section -->
    <section class="gi-faq padding-tb-40 background">
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

            <div class="section-title-2">
                <h2 class="gi-title">Astuces & <span>Conseils</span></h2>
                <p>Des idées concrètes pour améliorer vos performances, inspirer vos équipes et innover.</p>
            </div>
            <div class="row">
                @if($conseilastuces->count() > 0)
                    @php $n=1; @endphp
                    @foreach($conseilastuces as $conseilastuce)
                        @php $uniqueId = 'accordion-'.$loop->index; @endphp
                        <div class="col-lg-6">
                            <div class="gi-accordion style-1" id="accordion-parent-{{ $uniqueId }}">
                                <div class="gi-accordion-item mb-2">
                                    <h4 class="gi-accordion-header">
                                        {{ $conseilastuce->titre }}
                                    </h4>
                                    <div class="gi-accordion-body @if($n<=1) show @endif" id="{{ $uniqueId }}" >
                                        <p class="px-3">{{ $conseilastuce->contenu }}</p>
                                        
                                        @if($conseilastuce->fichier)
                                            @if(pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "png" ||
                                                        pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "jpg" ||
                                                        pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "jpeg")
                                                <div class="chat-conversation-text ms-0">
                                                    <div class="chat-ctext-wrap text-center">
                                                        <a href="javascript:void(0);">
                                                            <img src="{{ asset(Storage::url($conseilastuce->fichier)) }}" alt="attachment" style="height: 100px;" class="img-thumbnail me-1">
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- <div class="chat-conversation-text ms-0">
                                                    <div class="chat-ctext-wrap text-center">
                                                        <a href="javascript:void(0);">
                                                            <img src="{{ asset("admin/assets/images/small/img-1.jpg") }}" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                        </a>
                                                    </div>
                                                </div> -->
                                            @else
                                                <div class="chat-conversation-text ms-0">
                                                    <div class="chat-ctext-wrap text-center">
                                                        <video controls style="height: auto; width: 80%;" class="img-thumbnail me-1">
                                                            <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/mp4">
                                                            <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/mp3">
                                                            <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/avi">
                                                            Votre navigateur ne supporte pas la lecture de vidéos.
                                                        </video>

                                                        <!-- <iframe src="{{ asset("admin/video/eveil.mp4") }}" autoplay="false" frameborder="0" style="height: auto;" class="img-thumbnail me-1"></iframe> -->
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $n++; @endphp
                    @endforeach
                @else
                    <h4 class="mb-3 mt-4 fw-semibold fs-16 text-danger text-center">Désolé! Aucun conseil publié sur la plateforme</h4>
                @endif

                <!-- <div class="col-lg-6 m-t-991">
                    <div class="gi-accordion style-1">
                        <div class="gi-accordion-item">
                            <h4 class="gi-accordion-header">
                                Refund policy for customer.
                            </h4>
                            <div class="gi-accordion-body show">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem
                                Ipsum has been the industry's standard <code>dummy text</code> ever since the 1500s,
                                when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                        <div class="gi-accordion-item">
                            <h4 class="gi-accordion-header">
                                Exchange policy for customer.
                            </h4>
                            <div class="gi-accordion-body">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem
                                Ipsum has been the industry's standard <code>dummy text</code> ever since the 1500s,
                                when an Ipsum has been the industry's
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                        <div class="gi-accordion-item">
                            <h4 class="gi-accordion-header">
                                How to buy many products at a time?
                            </h4>
                            <div class="gi-accordion-body">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem
                                Ipsum has been the industry's standard <code>dummy text</code> ever.
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                        <div class="gi-accordion-item">
                            <h2 class="gi-accordion-header">
                                Give a way products available.
                            </h2>
                            <div class="gi-accordion-body">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem
                                Ipsum has been the industry's standard <code>dummy text</code> ever since the 1500s,
                                when an
                                Ipsum has been the industry's standard <code>dummy text</code> ever since the 1500s.
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                        <div class="gi-accordion-item">
                            <h4 class="gi-accordion-header">
                                What is the multi vendor services?
                            </h4>
                            <div class="gi-accordion-body">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Faq section End -->


@endsection