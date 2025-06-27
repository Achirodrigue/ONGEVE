@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    
                              <div class="card">
                                   <div class="card-header border-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                             <div>
                                                  <h5 class="card-title mb-1 anchor" id="responsive">
                                                       Produit : {{ $produit->nom }} <a class="anchor-link" href="#responsive">#</a>
                                                  </h5>
                                             </div>
                                             <div>
                                                  <!-- <img src="{{ asset(Storage::url($produit->image)) }}" alt="image" class="img-fluid rounded" width="200" />
                                                  <img src="{{ asset(Storage::url($produit->image)) }}" alt="image" class="img-fluid rounded" width="120" />
                                                  <img src="{{ asset(Storage::url($produit->image)) }}" alt="image" class="img-fluid rounded-circle" width="120" />
                                                  <img src="{{ asset(Storage::url($produit->image)) }}" alt="image" class="img-fluid img-thumbnail" width="200" /> -->
                                                  <img src="{{ asset(Storage::url($produit->image)) }}" alt="image" class="img-fluid rounded-circle img-thumbnail" width="120" />
                                             </div>
                                        </div>
                                        
                                   </div>
                              </div>

                    <div class="card">
                         <div class="card-header">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                   <div>
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Modification du produit {{ $produit->nom }} <a class="anchor-link" href="#responsive">#</a>
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
                              
                              <form method="POST" action="{{ route('admin.produit.update', $produit) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                   <div class="row mb-3">
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="nom" class="form-label">Nom de l'article *</label>
                                                  <input type="text" name="nom" id="nom" value="{{ $produit->nom }}" class="form-control" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="prix" class="form-label">Prix de l'article *</label>
                                                  <input type="number" name="prix" id="prix" value="{{ $produit->prix }}" class="form-control" required>
                                                  @error('prix') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="crater" class="form-label">Sous catégories *</label>
                                                  <select name="souscategorie" class="form-control" id="crater" data-choices data-choices-groups
                                                       data-placeholder="Select Crater" required>
                                                       <option value="{{ $produit->souscategorie->id }}">{{ $produit->souscategorie->nom }}</option>
                                                       @foreach($souscategories as $souscategorie)
                                                            <option value="{{ $souscategorie->id }}">{{ $souscategorie->nom }}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="crater" class="form-label">Boutique *</label>
                                                  <select name="vendeur" class="form-control" id="crater" data-choices data-choices-groups
                                                       data-placeholder="Select Crater" required>
                                                       <option value="{{ $produit->vendeur->id }}">{{ $produit->vendeur->nom_entreprise }}</option>
                                                       @foreach($vendeurs as $vendeur)
                                                            <option value="{{ $vendeur->id }}">{{ $vendeur->nom_entreprise }}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="qtyStock" class="form-label">Quantité en Stock *</label>
                                                  <input type="number" name="qtyStock" id="qtyStock" value="{{ $produit->qtyStock }}" min="{{ $produit->qtyStock }}" class="form-control" required>
                                                  @error('qtyStock') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-6 mb-3">
                                             <label for="crater" class="form-label">Etat *</label>
                                             <select name="etat" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater" required>
                                                  @if($produit->etat)
                                                       <option value="1">Neuf</option>
                                                       <option value="0">Article reconditionné</option>
                                                  @else
                                                       <option value="0">Article reconditionné</option>
                                                       <option value="1">Neuf</option>
                                                  @endif
                                             </select>
                                        </div>
                                        
                                        <!-- <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle image (facultative)</label>
                                                  <input type="file" name="image" id="image" class="form-control" placeholder="Entrer une nouvelle image">
                                                  @error('image') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div> -->
                                        
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">Nouvelle Image 1 (Facultative)</label>
                                                  <input type="file" name="image1" id="image" value="{{ old('image1') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image1') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">@if($produit->produitimg->image2) Nouvelle @endif Image 2 (Facultative)</label>
                                                  <input type="file" name="image2" id="image2" value="{{ old('image2') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image2') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">@if($produit->produitimg->image3) Nouvelle @endif Image 3 (Facultative)</label>
                                                  <input type="file" name="image3" id="image3" value="{{ old('image3') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image3') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="photo" class="form-label">@if($produit->produitimg->image4) Nouvelle @endif Image 4 (Facultative)</label>
                                                  <input type="file" name="image4" id="image4" value="{{ old('image4') }}" class="form-control" placeholder="Entrer une image">
                                                  @error('image4') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                             <div class="mb-0">
                                                  <label for="description" class="form-label">Description de l'article *</label>
                                                  <textarea name="description" class="form-control bg-light-subtle" id="description" rows="7"
                                                       placeholder="entrer une description" required>{{ $produit->description }}</textarea>
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