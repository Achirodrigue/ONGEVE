    <!-- Modal delete-->
    <div class="modal fade" id="deleteSousCategorie22{{ $scategorie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la sous catégorie <span class="fw-bold">{{ $scategorie->nom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.scategorie.destroy', $scategorie) }}" method="POST">
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

    <!-- Modal modif -->
    <div class="modal fade" id="editSousCategorie22{{ $scategorie->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modifier la sous catégorie {{ $scategorie->nom }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.scategorie.update', $scategorie) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category-title" class="form-label">Nom de la sous Categorie</label>
                                    <input type="text" name="nom" value="{{ $scategorie->nom }}" id="category-title" class="form-control" required>
                                    @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <label for="crater" class="form-label">Catégorie *</label>
                                <select name="categorie" class="form-control" id="crater" data-choices data-choices-groups
                                    data-placeholder="Select Crater" required>
                                    <option value="{{ $scategorie->categorie->id }}">{{ $scategorie->categorie->nom }}</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Retour</button>
                            <button type="submit" class="btn btn-secondary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
