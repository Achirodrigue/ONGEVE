@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modification de la formation {{ $formation->nom }}
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.formation.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.formation.update', $formation) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ $formation->nom }}" class="form-control" placeholder="Entrer un nom" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prix" class="form-label">Prix *</label>
                                                  <input type="number" name="prix" id="prix" value="{{ $formation->prix }}" class="form-control" placeholder="Entrer un prix" required>
                                                  @error('prix') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="lieu" class="form-label">Lieu *</label>
                                                  <input type="text" name="lieu" id="contact" value="{{ $formation->lieu }}" class="form-control" required>
                                                  @error('lieu') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="date_debut" class="form-label">Date de debut *</label>
                                                  <input type="date" name="date_debut" id="date" value="{{ $formation->date_debut }}" class="form-control" required>
                                                  @error('date_debut') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="date_fin" class="form-label">Date de fin (facultative)</label>
                                                  <input type="date" name="date_fin" id="date_fin" value="{{ $formation->date_fin }}" class="form-control" required>
                                                  @error('date_fin') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="heure" class="form-label">Heure de debut et fin (facultative)</label>
                                                  <input type="text" name="heure" id="heure" value="{{ $formation->heure }}" class="form-control" required>
                                                  @error('heure') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle image (facultative)</label>
                                                  <input type="file" name="image" id="image" class="form-control">
                                                  @error('image') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                             <div class="mb-0">
                                                  <label for="description" class="form-label">Description *</label>
                                                  <textarea name="description" class="form-control bg-light-subtle" id="description" rows="7"
                                                       placeholder="entrer une description" required>{{ $formation->description }}</textarea>
                                                  @error('description') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Modifier</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.formation.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection