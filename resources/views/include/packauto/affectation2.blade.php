<div class="modal fade" id="infoChauffeur{{ $paffectation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur le chauffeur <span class="text-danger">{{ $paffectation->pchauffeur->nom }} {{ $paffectation->pchauffeur->prenom }}</span> </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Nom</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="nom" class="visually-hidden form-label">Nom</label>
                    <input type="text" name="nom" value="{{ $paffectation->pchauffeur->nom }}" class="form-control" id="nom" required readonly>
                    @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Prénom</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="prenom" class="visually-hidden form-label">Prénom</label>
                    <input type="text" name="prenom" value="{{ $paffectation->pchauffeur->prenom }}" class="form-control" id="prenom" required readonly>
                    @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Contact</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="contact" class="visually-hidden form-label">Contact</label>
                    <input type="number" name="contact" value="{{ $paffectation->pchauffeur->contact }}" class="form-control" id="contact" required readonly>
                    @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Email</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="email" class="visually-hidden form-label">Email</label>
                    <input type="email" name="email" value="{{ $paffectation->pchauffeur->email }}" class="form-control" id="email" readonly required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Numéro de permis</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="permis_numero" class="visually-hidden form-label">Numéro de permis</label>
                    <input type="text" name="permis_numero" value="{{ $paffectation->pchauffeur->permis_numero }}" class="form-control" id="permis_numero" required readonly>
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
                    <input type="date" name="permis_validite" value="{{ $paffectation->pchauffeur->permis_validite }}" class="form-control" id="permis_validite" required readonly>
                    @error('permis_validite') <span class="text-danger">{{ $message }}</span> @enderror
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

<div class="modal fade" id="infoVehicule{{ $paffectation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur le véhicule <span class="text-danger">{{ $paffectation->pvehicule->marque }} : {{ $paffectation->pvehicule->immatriculation }}</span> </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

          <!-- Body -->
          <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Marque</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="marque" class="visually-hidden form-label">Marque</label>
                        <input type="text" name="marque" value="{{ $paffectation->pvehicule->marque }}" class="form-control" id="marque" required readonly>
                        @error('marque') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Modèle</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="modele" class="visually-hidden form-label">Modèle</label>
                        <input type="text" name="modele" value="{{ $paffectation->pvehicule->modele }}" class="form-control" id="modele" required readonly>
                        @error('modele') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-list-ul nav-icon"></i>
                        <div class="flex-grow-1">Immatriculation</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="immatriculation" class="visually-hidden form-label">Immatriculation</label>
                        <input type="text" name="immatriculation" value="{{ $paffectation->pvehicule->immatriculation }}" class="form-control" id="immatriculation" required readonly>
                        @error('immatriculation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-list-ul nav-icon"></i>
                        <div class="flex-grow-1">Année de mise en circulation</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="annee" class="visually-hidden form-label">Année de mise en circulation</label>
                        <input type="text" name="annee" value="{{ $paffectation->pvehicule->annee }}" class="form-control" id="annee" required readonly>
                        @error('annee') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
              
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-list-ul nav-icon"></i>
                        <div class="flex-grow-1">kilométrage actuel du véhicule</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="kilometrage" class="visually-hidden form-label">kilométrage actuel du véhicule</label>
                        <input type="text" name="kilometrage" value="{{ $paffectation->pvehicule->kilometrage }}" class="form-control" id="kilometrage" required readonly>
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
                        <input type="date" name="date_achat" value="{{ $paffectation->pvehicule->date_achat }}" class="form-control" id="date_achat" required readonly>
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
                        <input type="text" name="statut" value="{{ $paffectation->pvehicule->statut }}" class="form-control" id="statut" required readonly>
                        @error('statut') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Catégorie</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="pcategorievehicule_id" class="visually-hidden form-label">Catégorie</label>
                        <input type="text" name="pcategorievehicule_id" value="{{ $paffectation->pvehicule->pcategorievehicule->nom }}" class="form-control" id="pcategorievehicule_id" required readonly>
                        @error('pcategorievehicule_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            @if($paffectation->pvehicule->photo)
                <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($paffectation->pvehicule->photo)) }}">
                    <i class="bi-eye me-1"></i> Photo
                </a>
            @endif

            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
          </div>
          <!-- End Footer -->
      </div>
    </div>
</div>

<div class="modal fade" id="deleteAffectation{{ $paffectation->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment supprimer l'emprunt de 
              <span class="text-danger">{{ $paffectation->pchauffeur->nom }} {{ $paffectation->pchauffeur->prenom }}</span>
              du <span class="text-danger">{{ $paffectation->created_at->format('d/m/Y H:i') }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.paffectation.destroy', $paffectation) }}" method="POST">
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

<div class="modal fade" id="editAffectation{{ $paffectation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Modifier l'emprunt de 
            <span class="text-danger">{{ $paffectation->pchauffeur->nom }} {{ $paffectation->pchauffeur->prenom }}</span>
            du <span class="text-danger">{{ $paffectation->created_at->format('d/m/Y H:i') }}</span> ??
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('packauto.paffectation.update', $paffectation) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Chauffeur</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="pchauffeur_id" class="visually-hidden form-label">Chauffeur</label>
                        @if(chauffeurs()->count() > 0)
                            <select name="pchauffeur_id" class="form-control" id="pchauffeur_id">
                                <option value="{{ $paffectation->pchauffeur->id }}">{{ $paffectation->pchauffeur->nom }} {{ $paffectation->pchauffeur->prenom }} : {{ $paffectation->pchauffeur->contact }}</option>
                                @foreach(chauffeurs()->where('id','!=',$paffectation->pchauffeur->id) as $pchauffeur)
                                    <option value="{{ $pchauffeur->id }}">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }} : {{ $pchauffeur->contact }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="pchauffeur_id" class="form-control" id="pchauffeur_id" tabindex="1" placeholder="Désolé! Aucun chauffeur disponible" required readonly>
                        @endif
                        @error('pchauffeur_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Date de début d'emprunt *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="date_debut" class="visually-hidden form-label">Date de début d'emprunt *</label>
                        <input type="date" name="date_debut" value="{{ $paffectation->date_debut }}" class="form-control" id="date_debut" placeholder="Entrer une date de début d'emprunt" required>
                        @error('date_debut') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Date de fin d'emprunt</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="date_fin" class="visually-hidden form-label">Date de fin d'emprunt</label>
                        <input type="date" name="date_fin" value="{{ $paffectation->date_fin }}" class="form-control" id="date_fin" placeholder="Entrer une Date de fin d'emprunt">
                        @error('date_fin') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Mission *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="mission" class="visually-hidden form-label">Mission *</label>
                        <textarea name="mission" id="mission" class="form-control" value="{{ old('mission') }}" required>{{ $paffectation->mission }}</textarea>
                        @error('mission') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Véhicule</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="pvehicule_id" class="visually-hidden form-label">Véhicule</label>
                        @if(vehicules()->count() > 0)
                            <select name="pvehicule_id" class="form-control" id="pvehicule_id">
                                <option value="{{ $paffectation->pvehicule->id }}">{{ $paffectation->pvehicule->marque }} : {{ $paffectation->pvehicule->immatriculation }}</option>
                                @foreach(vehicules()->where('id','!=',$paffectation->pvehicule->id) as $pvehicule)
                                    <option value="{{ $pchauffeur->id }}">{{ $pvehicule->marque }} : {{ $pvehicule->immatriculation }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="pvehicule_id" class="form-control" id="pvehicule_id" placeholder="Désolé! Aucun véhicule disponible" required readonly>
                        @endif
                        @error('pvehicule_id') <span class="text-danger">{{ $message }}</span> @enderror
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

<div class="modal fade" id="ApprouverAffectation{{ $paffectation->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment approuver l'emprunt de 
              <span class="text-danger">{{ $paffectation->pchauffeur->nom }} {{ $paffectation->pchauffeur->prenom }}</span>
              du <span class="text-danger">{{ $paffectation->created_at->format('d/m/Y H:i') }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.approuve.emprunt', $paffectation) }}" method="POST">
        @csrf
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

<div class="modal fade" id="CloturerAffectation{{ $paffectation->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment cloturer l'emprunt de 
              <span class="text-danger">{{ $paffectation->pchauffeur->nom }} {{ $paffectation->pchauffeur->prenom }}</span>
              du <span class="text-danger">{{ $paffectation->created_at->format('d/m/Y H:i') }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.cloture.emprunt', $paffectation) }}" method="POST">
        @csrf
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