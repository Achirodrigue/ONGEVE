@extends('dashboard.admin.layout.appError')
@section('body')


     <div class="d-flex flex-column h-100 p-3">
          <div class="d-flex flex-column flex-grow-1">
               <div class="row h-100">
                    <div class="col-xxl-7">
                         <div class="row align-items-center justify-content-center h-100">
                              <div class="col-lg-10">
                                   <div class="auth-logo mb-3 text-center">
                                        <a href="{{ route('accueil') }}" class="logo-dark">
                                             <img src="{{ asset("principale/assets/img/logo/logo.png") }}" width="15%" alt="logo dark">
                                        </a>

                                        <a href="{{ route('accueil') }}" class="logo-light">
                                             <img src="{{ asset("principale/assets/img/logo/logo.png") }}" width="15%" alt="logo light">
                                        </a>
                                   </div>
                                   <div class="mx-auto text-center">
                                        <img src="{{ asset("admin/assets/images/404-error.png") }}" alt="" class="img-fluid my-3">
                                   </div>
                                   <h2 class="fw-bold text-center lh-base">Oups ! La page que vous recherchez est introuvable.</h2>
                                   <p class="text-muted text-center mt-1 mb-4">Désolé, nous n'avons pas trouvé la page que vous recherchiez. Nous vous suggérons de revenir aux sections principales.</p>
                                   <div class="text-center">
                                        <a href="{{ route('accueil') }}" class="btn btn-primary">Retour à l'accueil</a>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-xxl-5 d-none d-xxl-flex">
                         <div class="card h-100 mb-0 overflow-hidden">
                              <div class="d-flex flex-column h-100">
                                   <img src="{{ asset("admin/assets/images/small/img-10.jpg") }}" alt="" class="w-100 h-100">
                              </div>
                         </div> <!-- end card -->
                    </div>
               </div>
          </div>
     </div>



@endsection