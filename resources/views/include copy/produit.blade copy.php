    <!-- Modal delete-->
    <div class="modal fade" id="deleteProduit{{ $produit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer le produit <span class="fw-bold">{{ $produit->nom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.produit.destroy', $produit) }}" method="POST">
                @csrf
                @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                        <button type="submit" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal add promo -->
    <div class="modal fade" id="addPromoProduit{{ $produit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Mettre en promo le produit {{ $produit->nom }}<br> 
                        @if($produit->promo)
                            Promo actuel : <span class="text-warning">{{ strrev(wordwrap(strrev($produit->promo), 3, ' ', true)) }}F</span>
                        @else
                            Prix actuel : <span class="text-warning">{{ strrev(wordwrap(strrev($produit->prix), 3, ' ', true)) }}F</span>
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.promo.produit.update', $produit) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category-title" class="form-label">Prix de la promotion</label>
                                    <input type="number" min="1" name="promo" id="category-title" class="form-control" required @if($produit->promo) value="{{ $produit->promo }}" @else value="{{ old('promo') }}" placeholder="entrer le prix" @endif>
                                    @error('promo') <span class="text-danger"> {{ $message }} </span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Retour</button>
                        <button type="submit" class="btn btn-secondary">@if($produit->promo) Modifier @else Ajouter @endif</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal supprimer une image -->
    <div class="modal fade" id="ProduitImageDestroy{{ $produit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Supprimer une image du produit {{ $produit->nom }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.produit.image.destroy', $produit) }}" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category-title" class="form-label">Choisir le numero de l'image</label>
                                    <select name="numero" id="" class="form-control">
                                        @if($produit->produitimg->image2)
                                            <option value="2">Image 2</option>
                                        @endif
                                        @if($produit->produitimg->image3)
                                            <option value="3">Image 3</option>
                                        @endif
                                        @if($produit->produitimg->image4)
                                            <option value="4">Image 4</option>
                                        @endif
                                    </select>
                                    @error('numero') <span class="text-danger"> {{ $message }} </span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Retour</button>
                        <button type="submit" class="btn btn-secondary">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>