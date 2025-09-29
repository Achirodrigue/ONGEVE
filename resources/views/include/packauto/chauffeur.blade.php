
  <div class="modal fade" id="editChauffeur{{ $pchauffeur->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le chauffeur <span class="text-danger">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('packauto.pchauffeur.update', $pchauffeur) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Nom *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="nom" class="visually-hidden form-label">Nom *</label>
                        <input type="text" name="nom" value="{{ $pchauffeur->nom }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                        @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Prénom *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="prenom" class="visually-hidden form-label">Prénom *</label>
                        <input type="text" name="prenom" value="{{ $pchauffeur->prenom }}" class="form-control" id="prenom" placeholder="Entrer un prénom" aria-label="Entrer un prénom" required>
                        @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Contact *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="contact" class="visually-hidden form-label">Contact *</label>
                        <input type="number" name="contact" value="{{ $pchauffeur->contact }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact" required>
                        @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Email *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="email" class="visually-hidden form-label">Email *</label>
                        <input type="email" name="email" value="{{ $pchauffeur->email }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email" required>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Numéro de permis *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="permis_numero" class="visually-hidden form-label">Numéro de permis *</label>
                        <input type="text" name="permis_numero" value="{{ $pchauffeur->permis_numero }}" class="form-control" id="permis_numero" placeholder="Entrer un numéro de permis" aria-label="Entrer un numéro de permis">
                        @error('permis_numero') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Date d'expiration permis</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="permis_validite" class="visually-hidden form-label">Date d'expiration permis</label>
                        <input type="date" name="permis_validite" value="{{ $pchauffeur->permis_validite }}" class="form-control" id="permis_validite" placeholder="Entrer un permis de validité" aria-label="Entrer un permis de validité">
                        @error('permis_validite') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Photo</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="photo" class="visually-hidden form-label">Photo</label>
                        <input type="file" name="photo" value="{{ old('photo') }}" class="form-control" id="photo" placeholder="Entrer une photo" aria-label="Entrer une photo">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div> -->
          </div>

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Modifier</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteChauffeur{{ $pchauffeur->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">
              Voulez-vous vraiment supprimer le chauffeur <span class="text-danger">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.pchauffeur.destroy', $pchauffeur) }}" method="POST">
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

    <div class="modal fade" id="addChauffeurDocument{{ $pchauffeur->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <!-- Header --> 
                <div class="modal-header">
                    <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau document à  <span class="text-danger">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }}</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- End Header -->

                <form method="post" action="{{ route('packauto.chauffeur.document.store', $pchauffeur) }}" enctype="multipart/form-data">
                @csrf
                <!-- Body -->
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Type de document *</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="pchauffeurdocname_id" class="visually-hidden form-label">Type de document *</label>
                            <select name="pchauffeurdocname_id" class="form-control" id="pchauffeurdocname_id" required>
                                @foreach(chauffeurdocnames() as $pchauffeurdocname)
                                    <option value="{{ $pchauffeurdocname->id }}">{{ $pchauffeurdocname->nom }}</option>
                                @endforeach
                            </select>
                            @error('pchauffeurdocname_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Date d'expiration *</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="date_expiration" class="visually-hidden form-label">Date d'expiration *</label>
                            <input type="date" name="date_expiration" value="{{ old('date_expiration') }}" class="form-control" id="date_expiration" placeholder="Entrer une date d'expiration" aria-label="Entrer une date d'expiration">
                            @error('date_expiration') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Fichier *</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="fichier" class="visually-hidden form-label">Fichier *</label>
                            <input type="file" name="fichier" value="{{ old('fichier') }}" class="form-control" id="fichier" placeholder="Entrer un fichier" aria-label="Entrer un fichier" required>
                            @error('fichier') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="modal-footer gap-3">
                    <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
                    <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
                </div>
                <!-- End Footer -->
                </form>
            </div>
        </div>
    </div>