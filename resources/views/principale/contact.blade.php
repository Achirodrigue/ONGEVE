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
                            <h2 class="gi-breadcrumb-title">Contactez-nous</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">Nous contacter</li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <!-- Hero Slider Start -->
    <section class="section gi-hero m-tb-40 background">
        <div class="container">
            <div class="padding-b-40 m-b-40">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gi-ofr-banners">
                            <div class="gi-bnr-body">
                                <div class="gi-bnr-img">
                                    <!-- <span class="lbl">70% Off</span> -->
                                    <img src="{{ asset("principale/assets/img/perso/contact.jpg") }}" alt="banner">
                                </div>
                                <!-- <div class="gi-bnr-detail">
                                    <h5>Fresh Fruits & veggies</h5>
                                    <p>The flavor of something special.</p>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Slider End -->

    <!-- Contact us section -->
    <section class="gi-contact padding-tb-40 background">
        <div class="container">
            <div class="section-title-2">
                <h2 class="gi-title">Entrer en <span>Contact avec nous</span></h2>
                <p style="max-width: 800px;">
                    Vous avez une question, un projet à nous soumettre ou besoin d’une assistance ?
                    Notre équipe est à votre écoute et vous répondra dans les plus brefs délais.
                </p>
            </div>
            <div class="row gi-contact-detail m-tb-minus-12">
                <div class="col-xs-12 col-sm-6 col-lg-4 p-tp-12">
                    <div class="gi-box">
                        <div class="detail">
                            <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <div class="info">
                                <h3 class="title">Mail & Site web</h3>
                                <p>
                                    <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; EmailProfessionnelle@ravmel.com
                                </p>
                                <!-- <p>
                                    <i class="fa fa-globe" aria-hidden="true"></i> &nbsp; www.yourdomain.com
                                </p> -->
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-4 p-tp-12">
                    <div class="gi-box">
                        <div class="detail">
                            <div class="icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                            <div class="info">
                                <h3 class="title">Contact</h3>
                                <p>
                                    <i class="fa fa-mobile" aria-hidden="true"></i> &nbsp; +225 01 52 52 56 57
                                </p>
                                <p>
                                    <i class="fa fa-mobile" aria-hidden="true"></i> &nbsp; +225 07 07 96 69 57
                                </p>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-4 p-tp-12 m-auto h-100">
                    <div class="gi-box h-100">
                        <div class="detail">
                            <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            <div class="info">
                                <h3 class="title">Adresse</h3>
                                <p>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; 7XXW+FHX, Abidjan, Treichville, Gare de bassam.
                                </p>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
            <div class="row p-t-80">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.7687574996853!2d-4.006090625204153!3d5.2987382946795645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebe18c02f5c7%3A0x41b4a7928a85d92d!2sRAVMEL%20INFORMATIQUE!5e0!3m2!1sfr!2sci!4v1744389228420!5m2!1sfr!2sci" 
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <form action="{{ route('message.store') }}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="nom_prenom">Nom et Prenom *</label>
                                <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" placeholder="Entrez votre nom et prenom" value="{{ old('nom_prenom') }}" required>
                                <span class="text-danger mt-0">@error('nom') {{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label for="password-contact">Contact *</label>
                                <input type="number" class="form-control" id="password-contact" name="contact" placeholder="Entrez votre numero" value="{{ old('contact') }}" required>
                                @error('contact') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="subject-contact">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>
                                @error('email') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="nom_prenom">Objet *</label>
                                <input type="text" class="form-control" id="objet" name="objet" placeholder="Entrez l'objet de votre message" value="{{ old('objet') }}" required>
                                @error('objet') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="comment-contact">Message *</label>
                                <textarea id="comment-contact" class="form-control" rows="3" name="message" value="{{ old('message') }}" required></textarea>
                                @error('message') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="gi-btn-2">Envoyer le message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

@endsection    