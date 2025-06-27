@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modifier le equipe {{ $equipe->nom }} {{ $equipe->prenom }}<a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.equipe.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.equipe.update', $equipe) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ $equipe->nom }}" class="form-control" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prenom" class="form-label">Prenom *</label>
                                                  <input type="text" name="prenom" id="prenom" value="{{ $equipe->prenom }}" class="form-control" required>
                                                  @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="contact" class="form-label">Contact *</label>
                                                  <input type="number" name="contact" id="contact" value="{{ $equipe->contact }}" class="form-control" required>
                                                  @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="email" class="form-label">Email (facultatif)/*</label>
                                                  <input type="email" name="email" id="email" value="{{ $equipe->email }}" class="form-control" required>
                                                  @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="adresse" class="form-label">Adresse *</label>
                                                  <input type="text" name="adresse" id="adresse" value="{{ $equipe->adresse }}" class="form-control" required>
                                                  @error('adresse') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle photo (facultatif)</label>
                                                  <input type="file" name="photos" id="photo" class="form-control">
                                                  @error('photos') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Modifier</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.equipe.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection