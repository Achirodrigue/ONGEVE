@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modifier le livreur {{ $livreur->nom }} {{ $livreur->prenom }}<a class="anchor-link" href="#responsive">#</a>
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
                              
                              <form method="POST" action="{{ route('admin.livreur.update', $livreur) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ $livreur->nom }}" class="form-control" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prenom" class="form-label">Prenom *</label>
                                                  <input type="text" name="prenom" id="prenom" value="{{ $livreur->prenom }}" class="form-control" required>
                                                  @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="contact" class="form-label">Contact *</label>
                                                  <input type="number" name="contact" id="contact" value="{{ $livreur->contact }}" class="form-control" required>
                                                  @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="email" class="form-label">Email *</label>
                                                  <input type="email" name="email" id="email" value="{{ $livreur->email }}" class="form-control" required>
                                                  @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="adresse" class="form-label">Lieu d'habitation *</label>
                                                  <input type="text" name="adresse" id="adresse" value="{{ $livreur->adresse }}" class="form-control" required>
                                                  @error('adresse') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle photo (facultatif)</label>
                                                  <input type="file" name="photo" id="photo" class="form-control">
                                                  @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="admin" class="form-label">Administrateur *</label>
                                                  <select name="admin" class="form-control" id="admin" required>
                                                       <option value="{{ $livreur->admin->id }}">{{ $livreur->admin->nom }} {{ $livreur->admin->prenom }}</option>
                                                       @foreach($admins as $admin)
                                                            <option value="{{ $admin->id }}">{{ $admin->nom }} {{ $admin->prenom }}</option>
                                                       @endforeach
                                                  </select>
                                                  @error('admin') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="identifiant" class="form-label">Identifiant *</label>
                                                  <input type="text" name="identifiant" id="identifiant" value="{{ $livreur->identifiant }}" class="form-control" required>
                                                  @error('identifiant') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="password" class="form-label">Nouveau Mot de passe (facultatif)</label>
                                                  <input type="password" name="passwords" id="password" value="{{ old('password') }}" class="form-control" placeholder="Entrer un mot de passe">
                                                  <img src="{{ asset("auth/oeil/oeilc.png") }}" style="width: 18px; float: right; margin-right: 3px; margin-top: -30px;" class="mr-3" id="eye" onClick="changer()">
                                                  @error('password') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Modifier</button>
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