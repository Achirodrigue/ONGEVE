@extends('dashboard.admin.layout.app')
@section('body')

               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Ajouter un nouveau produit <a class="anchor-link" href="#responsive">#</a>
                                        </h5>
                                   </div>
                                   <div>
                                        <a href="{{ route('admin.produit.index') }}" class="btn btn-primary">
                                             <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                        </a>
                                   </div>
                              </div> <!-- end row -->

                              @include('include.message')
                         </div>
                         <div class="card-body">
                              
                              <form method="POST" action="{{ route('admin.produit.store') }}" enctype="multipart/form-data">
                              @csrf
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom de l'article *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control" placeholder="Entrer un nom" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prix" class="form-label">Prix de l'article *</label>
                                                  <input type="number" name="prix" id="prix" value="{{ old('prix') }}" class="form-control" placeholder="Entrer un prix" required>
                                                  @error('prix') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                             <label for="crater" class="form-label">Sous catégories *</label>
                                             <select name="souscategorie" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater" required>
                                                  @foreach($souscategories as $souscategorie)
                                                       <option value="{{ $souscategorie->id }}">{{ $souscategorie->nom }}</option>
                                                  @endforeach
                                             </select>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                             <label for="crater" class="form-label">Boutique *</label>
                                             <select name="vendeur" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater" required>
                                                  @foreach($vendeurs as $vendeur)
                                                       <option value="{{ $vendeur->id }}">{{ $vendeur->nom_entreprise }}</option>
                                                  @endforeach
                                             </select>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="qtyStock" class="form-label">Quantité en Stock *</label>
                                                  <input type="number" name="qtyStock" id="qtyStock" value="{{ old('qtyStock') }}" class="form-control" placeholder="Entrer la Quantité en Stock" required>
                                                  @error('qtyStock') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-6 mb-3">
                                             <label for="crater" class="form-label">Etat *</label>
                                             <select name="etat" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater" required>
                                                  <option value="1">Neuf</option>
                                                  <option value="0">Article reconditionné</option>
                                             </select>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Image 1 *</label>
                                                  <input type="file" name="image1" id="image" value="{{ old('image1') }}" class="form-control" placeholder="Entrer une image" require>
                                                  @error('image1') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Image 2 (Facultative)</label>
                                                  <input type="file" name="image2" id="image2" value="{{ old('image2') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image2') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Image 3 (Facultative)</label>
                                                  <input type="file" name="image3" id="image3" value="{{ old('image3') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image3') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Image 4 (Facultative)</label>
                                                  <input type="file" name="image4" id="image4" value="{{ old('image4') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image4') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                             <div class="mb-0">
                                                  <label for="description" class="form-label">Description de l'article *</label>
                                                  <textarea name="description" class="form-control bg-light-subtle" id="description" rows="7"
                                                       placeholder="entrer une description" value="{{ old('description') }}" required></textarea>
                                                  @error('description') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   </div>
                                   <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                             <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-outline-secondary w-100">Valider</button>
                                             </div>
                                             <div class="col-lg-2">
                                                  <a href="{{ route('admin.produit.index') }}" class="btn btn-primary w-100">Annuler</a>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->


@endsection