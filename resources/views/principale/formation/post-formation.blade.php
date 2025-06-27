@extends('Auth.layout.app')
@section('body')

@include('include.principale.message')


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					@if (session()->has('message'))
						<div class="alert alert-warning text-center" role="alert">
							{{ session()->get('message') }}
						</div>
					@endif


					<div class="wrap d-md-flex" style="flex-direction: column-reverse;">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last" style="width: 100%; background: var(--warning);">
                            <div class="text w-100">
                                <h2>Inscription à la formation "{{ $formation->nom }}"</h2>
                                <a href="{{ route('all.formation') }}" class="btn btn-white btn-outline-white">Retour aux formation</a>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5" style="width: 100%">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Formulaire</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('post.formation.store', $formation) }}" class="signin-form" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="label" for="nom">NOM *</label>
                                            <input name="nom" type="text" id="nom" value="{{ old('nom') }}" placeholder="entrer votre nom" class="form-control" required>
                                            @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="label" for="prenom">PRENOM *</label>
                                            <input name="prenom" type="text" id="prenom" value="{{ old('prenom') }}" placeholder="entrer votre prenom" class="form-control" required>
                                            @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="label" for="name">CONTACT *</label>
                                            <input type="number" min="8" name="contact" value="{{ old('contact') }}" class="form-control" placeholder="entrer votre contact" required>
                                            @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="label" for="name">ADRESSE EMAIL *</label>
                                            <input name="email" type="email" value="{{ old('email') }}" placeholder="Exemple : email@gmail.com" class="form-control" required>
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-12 mb-3">
                                            <label class="label" for="name">ADRESSE *</label>
                                            <input name="adresse" type="text" value="{{ old('adresse') }}" placeholder="entrer votre adresse" class="form-control" required>
                                            @error('adresse') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="label" for="name">DATE NAISSANCE *</label>
                                            <input name="date_naissance" type="text" value="{{ old('date_naissance') }}" placeholder="date de naissance" class="form-control" required>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="label" for="name">NATIONALITE *</label>
                                            <select name="nationalite" value="{{ old('nationalite') }}" class="form-control" required>
                                                <option>Ivoirienne</option>
                                                <option>Camerounaise</option>
                                                <option>Malienne</option>
                                                <option>Burkinabé</option>
                                                <option>Togolaise</option>
                                                <option>Beninoise</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">Envoyer</button>
                                </div>
                            </form>
                        </div>
		      		</div>
				</div>
			</div>
		</div>
	</section>


@endsection