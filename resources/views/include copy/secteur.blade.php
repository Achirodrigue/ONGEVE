    <!-- Modal delete-->
    <div class="modal fade" id="deleteSecteur{{ $secteur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer le secteur <span class="fw-bold">{{ $secteur->nom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.secteur.destroy', $secteur) }}" method="POST">
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
    <div class="modal fade" id="editSecteur{{ $secteur->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modifier le secteur {{ $secteur->nom }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.secteur.update', $secteur) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category-title" class="form-label">Nom de la secteur</label>
                                    <input type="text" name="nom" value="{{ $secteur->nom }}" id="category-title" class="form-control" required>
                                    @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category-title" class="form-label">Frais de livraison</label>
                                    <input type="number" name="frais_livraison" value="{{ $secteur->frais_livraison }}" id="category-title" class="form-control" required>
                                    @error('frais_livraison') <span class="text-danger"> {{ $message }} </span> @enderror
                                </div>
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
