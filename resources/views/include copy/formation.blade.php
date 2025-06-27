    <!-- Modal delete-->
    <div class="modal fade" id="deleteFormation{{ $formation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la formation <span class="fw-bold">{{ $formation->nom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.formation.destroy', $formation) }}" method="POST">
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
    <div class="modal fade" id="AffecterFormateurFormation{{ $formation->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Affecter un formateur à la formation en <span class="text-warning">{{ $formation->nom }}</span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.affectation.formateur.store', $formation) }}" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        @if($formateurs->count() >= 1)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="category-title" class="form-label">Formateur</label>
                                        <select name="formateur_id" id="" class="form-control" required>
                                            @foreach($formateurs as $formateur)
                                                <option value="{{ $formateur->id }}">{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                                            @endforeach
                                        </select>
                                        @error('formateur_id') <span class="text-danger"> {{ $message }} </span> @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="category-title" class="form-label">Désolé! Aucun formateur n'a été ajouté sur la plateforme</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Retour</button>
                            <button type="submit" class="btn btn-secondary">Affecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>