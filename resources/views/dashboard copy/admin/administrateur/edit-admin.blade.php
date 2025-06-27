@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modifier l'admin {{ $admin->nom }} {{ $admin->prenom }}<a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.admin.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.admin.update', $admin) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ $admin->nom }}" class="form-control" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prenom" class="form-label">Prenoms *</label>
                                                  <input type="text" name="prenom" id="prenom" value="{{ $admin->prenom }}" class="form-control" required>
                                                  @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="contact" class="form-label">Contact *</label>
                                                  <input type="number" name="contact" id="contact" value="{{ $admin->contact }}" class="form-control" required>
                                                  @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="email" class="form-label">Email Professionnel *</label>
                                                  <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control" required>
                                                  @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="identifiant" class="form-label">Identifiant *</label>
                                                  <input type="text" name="identifiant" id="identifiant" value="{{ $admin->identifiant }}" class="form-control" required>
                                                  @error('identifiant') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle Photo *</label>
                                                  <input type="file" name="photo" id="photo" class="form-control">
                                                  @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        @php 
                                             if($admin->role) { $value = "super_admin" ; $nom = "Super Admin"; }else{ $value = "admin" ; $nom = "Admin"; }
                                        @endphp
                                        <div class="col-12 mb-3">
                                             <label for="crater" class="form-label">Role *</label>
                                             <select name="roles" id="monSelect" onchange="toggleInput()" required class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater">
                                                  <option value="{{ $value }}">{{ $nom }}</option>
                                                  @if($admin->role)
                                                       <option value="admin">Admin</option>
                                                  @else
                                                       <option value="super_admin">Super Admin</option>
                                                  @endif
                                             </select>
                                        </div>

                                        @if(!$admin->role)
                                             <div class="col-lg-12 mb-3" id="monInput">
                                                  <label for="crater" class="form-label">Secteur d'activité *</label>
                                                  <select name="secteur" class="form-control" id="crater" data-choices data-choices-groups
                                                       data-placeholder="Select Crater">
                                                       @if(!$admin->role)
                                                            @if($admin->adminsecteur->secteur_id)
                                                                 <option value="{{ $admin->adminsecteur->secteur_id }}">{{ $admin->adminsecteur->secteur->nom }}</option>
                                                            @else
                                                                 <option value="">Tout les secteurs</option>
                                                            @endif
                                                       @endif
                                                       @foreach($secteurs as $secteur)
                                                            <option value="{{ $secteur->id }}">{{ $secteur->nom }}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                        @endif
                                        
                                        <div class="col-lg-12">
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
                                                  <a href="{{ route('admin.admin.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection