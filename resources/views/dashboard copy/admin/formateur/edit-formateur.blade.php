@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modifier le formateur {{ $formateur->nom }} {{ $formateur->prenom }}<a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.formateur.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.formateur.update', $formateur) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ $formateur->nom }}" class="form-control" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prenom" class="form-label">Prenom *</label>
                                                  <input type="text" name="prenom" id="prenom" value="{{ $formateur->prenom }}" class="form-control" required>
                                                  @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="contact" class="form-label">Contact *</label>
                                                  <input type="number" name="contact" id="contact" value="{{ $formateur->contact }}" class="form-control" required>
                                                  @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="email" class="form-label">Email *</label>
                                                  <input type="email" name="email" id="email" value="{{ $formateur->email }}" class="form-control" required>
                                                  @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="adresse" class="form-label">Lieu d'habitation *</label>
                                                  <input type="text" name="adresse" id="adresse" value="{{ $formateur->adresse }}" class="form-control" required>
                                                  @error('adresse') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <label for="crater" class="form-label">Domaine *</label>
                                             <select name="domaine" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater">
                                                  <option value="{{ $formateur->domaine }}">{{ $formateur->domaine }}</option>
                                                  <option value="Informatique">Informatique</option>
                                                  <option value="Electro-menager">Electro-menager</option>
                                                  <option value="Mode">Mode</option>
                                                  <option value="Autre">Autre</option>
                                             </select>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle photo (facultatif)</label>
                                                  <input type="file" name="photo" id="photo" class="form-control">
                                                  @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Modifier</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.formateur.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection