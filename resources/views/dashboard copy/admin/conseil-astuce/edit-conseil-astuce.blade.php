@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modification de : {{ $conseilastuce->titre }} <a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.conseilastuce.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              <form method="POST" action="{{ route('admin.conseilastuce.update', $conseilastuce) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              
                                   <div class="row mb-3">
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="titre" class="form-label">Titre *</label>
                                                  <input type="text" name="titre" id="titre" value="{{ $conseilastuce->titre }}" class="form-control" required>
                                                  @error('titre') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="contenu" class="form-label">Contenu</label>
                                                  <textarea name="contenu" class="form-control bg-light-subtle" id="contenu" rows="7" required>{{ $conseilastuce->contenu }}</textarea>
                                                  @error('contenu') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <!-- @php 
                                             if($conseilastuce->type) { $value = "conseil" ; $nom = "Conseil"; }else{ $value = "astuce" ; $nom = "Astuce"; }
                                        @endphp
                                        <div class="col-lg-6 mb-3">
                                             <label for="crater" class="form-label">Modele *</label>
                                             <select name="types" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater" required>{{ $conseilastuce->titre }}
                                                  <option value="{{ $value }}">{{ $nom }}</option>
                                                  <option value="conseil">Conseil</option>
                                                  <option value="astuce">Astuce</option>
                                             </select>
                                        </div> -->
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Fichier (facultatif)</label>
                                                  <input type="file" name="fichier" id="fichier" value="{{ old('fichier') }}" class="form-control" placeholder="Entrer une fichier">
                                                  @error('fichier') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>

                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Modifier</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.conseilastuce.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection