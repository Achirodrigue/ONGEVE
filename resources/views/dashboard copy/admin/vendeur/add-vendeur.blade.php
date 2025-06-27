@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Ajouter une boutique <a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.vendeur.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.vendeur.store') }}" enctype="multipart/form-data">
                              @csrf
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom_entreprise" class="form-label">Nom entreprise*</label>
                                                  <input type="text" name="nom_entreprise" id="nom_entreprise" value="{{ old('nom_entreprise') }}" class="form-control" placeholder="Entrer un nom d'entreprise" required>
                                                  @error('nom_entreprise') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom_prenom_gerant" class="form-label">Nom et prenom du gerant *</label>
                                                  <input type="text" name="nom_prenom_gerant" id="nom_prenom_gerant" value="{{ old('nom_prenom_gerant') }}" class="form-control" placeholder="Nom et prenom du gerant" required>
                                                  @error('nom_prenom_gerant') <span class="text-danger"> {{ $message }} </span> @enderror
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
                                                  <label for="adresse" class="form-label">Localisation *</label>
                                                  <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" class="form-control" placeholder="Entrer une adresse" required>
                                                  @error('adresse') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <label for="domaine" class="form-label">Domaine d'activité *</label>
                                             <input type="text" name="domaine" id="domaine" value="{{ old('domaine') }}" class="form-control" placeholder="Entrer un domaine d'activité" required>
                                             @error('domaine') <span class="text-danger"> {{ $message }} </span> @enderror
                                        </div>
                                        
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="logo" class="form-label">Logo *</label>
                                                  <input type="file" name="logo" id="logo" value="{{ old('logo') }}" class="form-control" placeholder="Entrer une logo">
                                                  @error('logo') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Valider</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.vendeur.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection