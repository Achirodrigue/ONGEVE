
  <div class="modal fade" id="editProduit{{ $produit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le produit <span class="text-danger">{{ $produit->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('commun.produit.update', $produit) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom du produit</label>
                <input type="text" name="nom" value="{{ $produit->nom }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Prix du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prix" class="visually-hidden form-label">Prix du produit</label>
                <input type="number" name="prix" value="{{ $produit->prix }}" class="form-control" id="prix" placeholder="Entrer un prix" aria-label="Entrer un prix" required>
                @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Quantité du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="qtyStock" class="visually-hidden form-label">Quantité du produit</label>
                <input type="number" name="qtyStock" required value="{{ $produit->qtyStock }}" class="form-control" id="qtyStock" placeholder="Entrer une quantité">
                @error('qtyStock') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <!-- <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Référence du produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reference" class="visually-hidden form-label">Référence du produit</label>
                <input type="text" name="reference" value="{{ old('reference') }}" class="form-control" id="reference" placeholder="Entrer une reference">
                @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div> -->

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Catégorie du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Catégorie du produit</label>
                <select name="entrepotcateg" class="form-control w-100" id="role" required>
                  @foreach(entrepotcategs() as $entrepotcateg)
                    <option value="{{ $entrepotcateg->id }}">{{ $entrepotcateg->categorie->nom }} : {{ $entrepotcateg->categorieprod->nom }}</option>
                  @endforeach
                </select>
                @error('entrepotcateg') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Type de produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Type de produit</label>
                <select name="TP" class="form-control w-100" id="role" required>
                    @if($produit->TP)
                      <option value="1">Location</option>
                      <option value="0">Vente</option>
                    @else
                      <option value="0">Vente</option>
                      <option value="1">Location</option>
                    @endif
                </select>
                @error('TP') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Unité de vente ou de prestation *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Unité de vente ou de prestation</label>
                <select name="unite" class="form-control w-100" id="role">
                    <option value="{{ $produit->unite }}">@if($produit->unite) {{ $produit->unite }} @else Aucune @endif</option>
                    <option value="">Aucune</option>
                    <option value="L">L</option>
                    <option value="KG">KG</option>
                    <option value="Pièce">Pièce</option>
                    <option value="Carton">Carton</option>
                    <option value="Boîte">Boîte</option>
                    <option value="Sac">Sac</option>
                    <option value="Paquet">Paquet</option>
                </select>
                @error('unite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Famille du produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="famille" class="visually-hidden form-label">Famille du produit</label>
                <input type="text" name="famille" value="{{ $produit->famille }}" class="form-control" id="famille" placeholder="Entrer une famille">
                @error('famille') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Reférence du fournisseur</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reff" class="visually-hidden form-label">Reférence du fournisseur</label>
                <input type="text" name="reff" value="{{ $produit->reff }}" class="form-control" id="reff" placeholder="Entrer une Reférence">
                @error('reff') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
          </div>

          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Modifier</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteProduit{{ $produit->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">Confirmation suppression</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer le produit <span class="text-danger">{{ $produit->nom }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('commun.produit.destroy', $produit) }}" method="POST">
        @csrf
        @method('DELETE')
            <div class="modal-footer">
                <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
                    <div class="col-sm-auto">
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>