@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Ajouter un livreur <a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.livreur.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.livreur.store') }}" enctype="multipart/form-data">
                              @csrf
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control" placeholder="Entrer un nom" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prenom" class="form-label">Prenom *</label>
                                                  <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="form-control" placeholder="Entrer un prenom" required>
                                                  @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="contact" class="form-label">Contact *</label>
                                                  <input type="number" name="contact" id="contact" value="{{ old('contact') }}" class="form-control" placeholder="Entrer un contact" required>
                                                  @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="email" class="form-label">Email *</label>
                                                  <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Entrer un email" required>
                                                  @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="adresse" class="form-label">Lieu d'habitation *</label>
                                                  <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" class="form-control" placeholder="Entrer une adresse" required>
                                                  @error('adresse') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">photo *</label>
                                                  <input type="file" name="photo" id="photo" value="{{ old('photo') }}" class="form-control" placeholder="Entrer une photo" required>
                                                  @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="admin" class="form-label">Administrateur *</label>
                                                  <select name="admin" class="form-control" id="admin" required>
                                                       @if($admins->count() > 0)
                                                            @foreach($admins as $admin)
                                                                 <option value="{{ $admin->id }}">{{ $admin->nom }} {{ $admin->prenom }}</option>
                                                            @endforeach
                                                       @else
                                                            <option value="{{ $admin->id }}">{{ $admin->nom }} {{ $admin->prenom }}</option>
                                                       @endif
                                                  </select>
                                                  @error('admin') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="identifiant" class="form-label">Identifiant *</label>
                                                  <input type="text" name="identifiant" id="identifiant" value="{{ old('identifiant') }}" class="form-control" placeholder="Entrer un identifiant" required>
                                                  @error('identifiant') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="password" class="form-label">Mot de passe *</label>
                                                  <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" placeholder="Entrer un mot de passe" required>
                                                  <img src="{{ asset("auth/oeil/oeilc.png") }}" style="width: 18px; float: right; margin-right: 3px; margin-top: -30px;" class="mr-3" id="eye" onClick="changer()">
                                                  @error('password') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Valider</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.livreur.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection