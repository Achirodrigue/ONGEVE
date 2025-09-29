
  <div class="modal fade" id="editVehicule{{ $pvehicule->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le véhicule <span class="text-danger">{{ $pvehicule->marque }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('packauto.pvehicule.update', $pvehicule) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="modal-body">
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Marque *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="marque" class="visually-hidden form-label">Marque *</label>
                      <input type="text" name="marque" value="{{ $pvehicule->marque }}" class="form-control" id="marque" placeholder="Entrer une marque" aria-label="Entrer une marque" required>
                      @error('marque') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Modèle *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="modele" class="visually-hidden form-label">Modèle *</label>
                      <input type="text" name="modele" value="{{ $pvehicule->modele }}" class="form-control" id="modele" placeholder="Entrer un modèle" aria-label="Entrer un modèle" required>
                      @error('modele') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
              
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">Immatriculation *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="immatriculation" class="visually-hidden form-label">Immatriculation *</label>
                      <input type="text" name="immatriculation" required value="{{ $pvehicule->immatriculation }}" class="form-control" id="immatriculation" placeholder="Entrer une immatriculation" aria-label="Entrer une immatriculation">
                      @error('immatriculation') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
              
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">Année de mise en circulation *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="annee" class="visually-hidden form-label">Année de mise en circulation *</label>
                      <input type="text" name="annee" value="{{ $pvehicule->annee }}" class="form-control" id="annee" placeholder="Entrer l'année de circulation" aria-label="Entrer l'année de circulation">
                      @error('annee') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
              
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">kilométrage actuel du véhicule *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="kilometrage" class="visually-hidden form-label">kilométrage actuel du véhicule *</label>
                      <input type="text" name="kilometrage" value="{{ $pvehicule->kilometrage }}" class="form-control" id="kilometrage" placeholder="Entrer le kilometrage" aria-label="Entrer le kilometrage">
                      @error('kilometrage') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Date d'achat</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="date_achat" class="visually-hidden form-label">Date d'achat</label>
                      <input type="date" name="date_achat" value="{{ $pvehicule->date_achat }}" class="form-control" id="date_achat" placeholder="Entrer une date d'achat" aria-label="Entrer une date d'achat">
                      @error('date_achat') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Etat du vehicule</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="statut" class="visually-hidden form-label">Etat du vehicule</label>
                      <select name="statut" class="form-control" id="statut">
                        <option value="{{ $pvehicule->statut }}">{{ $pvehicule->statut }}</option>
                        <option value="actif">Actif</option>
                        <option value="accidenté">Accidenté</option>
                        <option value="vendu">Vendu</option>
                        <option value="maintenance">Maintenance</option>
                      </select>
                      @error('statut') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="row mb-4">
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
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Catégorie *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="pcategorievehicule_id" class="visually-hidden form-label">Catégorie *</label>
                      <select name="pcategorievehicule_id" class="form-control" id="pcategorievehicule_id" required>
                          <option value="{{ $pvehicule->pcategorievehicule->id }}">{{ $pvehicule->pcategorievehicule->nom }}</option>
                          @foreach(categorieVehicule()->where('id','!=', $pvehicule->pcategorievehicule->id) as $pcategorievehicule)
                              <option value="{{ $pcategorievehicule->id }}">{{ $pcategorievehicule->nom }}</option>
                          @endforeach
                      </select>
                      @error('pcategorievehicule_id') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
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

  <div class="modal fade" id="infoVehicule{{ $pvehicule->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur le véhicule <span class="text-danger">{{ $pvehicule->marque }}</span> </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

          <!-- Body -->
          <div class="modal-body">
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Marque *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="marque" class="visually-hidden form-label">Marque *</label>
                      <input type="text" name="marque" value="{{ $pvehicule->marque }}" class="form-control" id="marque" placeholder="Entrer une marque" aria-label="Entrer une marque" required>
                      @error('marque') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Modèle *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="modele" class="visually-hidden form-label">Modèle *</label>
                      <input type="text" name="modele" value="{{ $pvehicule->modele }}" class="form-control" id="modele" placeholder="Entrer un modèle" aria-label="Entrer un modèle" required>
                      @error('modele') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
              
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">Immatriculation *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="immatriculation" class="visually-hidden form-label">Immatriculation *</label>
                      <input type="text" name="immatriculation" required value="{{ $pvehicule->immatriculation }}" class="form-control" id="immatriculation" placeholder="Entrer une immatriculation" aria-label="Entrer une immatriculation">
                      @error('immatriculation') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
              
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">Année de mise en circulation *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="annee" class="visually-hidden form-label">Année de mise en circulation *</label>
                      <input type="text" name="annee" value="{{ $pvehicule->annee }}" class="form-control" id="annee" placeholder="Entrer l'année de circulation" aria-label="Entrer l'année de circulation">
                      @error('annee') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
              
              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">kilométrage actuel du véhicule *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="kilometrage" class="visually-hidden form-label">kilométrage actuel du véhicule *</label>
                      <input type="text" name="kilometrage" value="{{ $pvehicule->kilometrage }}" class="form-control" id="kilometrage" placeholder="Entrer le kilometrage" aria-label="Entrer le kilometrage">
                      @error('kilometrage') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Date d'achat</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="date_achat" class="visually-hidden form-label">Date d'achat</label>
                      <input type="date" name="date_achat" value="{{ $pvehicule->date_achat }}" class="form-control" id="date_achat" placeholder="Entrer une date d'achat" aria-label="Entrer une date d'achat">
                      @error('date_achat') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>

              <!-- <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Etat du vehicule</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="statut" class="visually-hidden form-label">Etat du vehicule</label>
                      <select name="statut" class="form-control" id="statut">
                          <option value="Actif">Actif</option>
                          <option value="Accidenté">Accidenté</option>
                          <option value="Vendu">Vendu</option>
                          <option value="Maintenance">Maintenance</option>
                      </select>
                      @error('statut') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div> -->

              <div class="row mb-4">
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
              </div>

              <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                      <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Catégorie *</div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <label for="pcategorievehicule_id" class="visually-hidden form-label">Catégorie *</label>
                      <select name="pcategorievehicule_id" class="form-control" id="pcategorievehicule_id" required>
                          <option value="{{ $pvehicule->pcategorievehicule->id }}">{{ $pvehicule->pcategorievehicule->nom }}</option>
                          @foreach(categorieVehicule()->where('id','!=', $pvehicule->pcategorievehicule->id) as $pcategorievehicule)
                              <option value="{{ $pcategorievehicule->id }}">{{ $pcategorievehicule->nom }}</option>
                          @endforeach
                      </select>
                      @error('pcategorievehicule_id') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
              </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
          </div>
          <!-- End Footer -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteVehicule{{ $pvehicule->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment supprimer le véhicule <span class="text-danger">{{ $pvehicule->marque }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.pvehicule.destroy', $pvehicule) }}" method="POST">
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

  <div class="modal fade" id="addVehiculeDocument{{ $pvehicule->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <!-- Header --> 
                <div class="modal-header">
                    <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau document au véhicule<span class="text-danger">{{ $pvehicule->marque }}</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- End Header -->

                <form method="post" action="{{ route('packauto.vehicule.document.store', $pvehicule) }}" enctype="multipart/form-data">
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
                            <label for="pvehiculedocname_id" class="visually-hidden form-label">Type de document *</label>
                            <select name="pvehiculedocname_id" class="form-control" id="pvehiculedocname_id" required>
                                @foreach(vehiculedocnames() as $pvehiculedocname)
                                    <option value="{{ $pvehiculedocname->id }}">{{ $pvehiculedocname->nom }}</option>
                                @endforeach
                            </select>
                            @error('pvehiculedocname_id') <span class="text-danger">{{ $message }}</span> @enderror
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