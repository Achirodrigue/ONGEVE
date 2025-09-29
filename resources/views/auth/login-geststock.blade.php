@extends('auth.layout.app')
@section('body')


  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain"> 

                @include('include.message.auth') 

                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Connexion du gestionnnaire de stock</h4>
                  <p class="mb-0">Entrer votre identifiant et votre mot de passe pour la connexion</p>
                </div>
                <div class="card-body">

                  <form method="post" action="{{ $url }}" class="signin-form">
							    @csrf
                    <div class="mb-3">
                      <input type="text" name="identifiant" placeholder="Identifiant" aria-label="Email" class="form-control form-control-lg @error('identifiant') is-invalid @enderror" value="{{ old('identifiant') }}" required autocomplete="email" autofocus>
                      @error('identifiant')<span class="text-danger"> {{ $message }} </span>@enderror
                    </div>
                    <div class="mb-3">
									    <input type="password" name="password" id="password" placeholder="Mot de passe" aria-label="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" required autocomplete="current-password">
                      <img src="{{ asset("auth/oeil/oeilc.png") }}" style="width: 5%; float: right; margin-top: -34px; margin-right: 3px;" id="eye" onClick="changer()">
									    @error('password')<span class="text-danger"> {{ $message }} </span>@enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Connexion</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div 
                  class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" 
                  style="background-image: url(/images/img1.jpg); background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Bienvenue cher Responsable du gestionnnaire de stock"</h4>
                <p class="text-white position-relative">Formulaire de connexion</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


@endsection