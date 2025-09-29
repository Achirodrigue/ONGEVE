@if($ppanne->pchauffeur)
    <div class="modal fade" id="infoChauffeur{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
            <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur le chauffeur <span class="text-danger">{{ $ppanne->pchauffeur->nom }} {{ $ppanne->pchauffeur->prenom }}</span> </h4>
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
                        <input type="text" name="nom" value="{{ $ppanne->pchauffeur->nom }}" class="form-control" id="nom" required readonly>
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
                        <input type="text" name="prenom" value="{{ $ppanne->pchauffeur->prenom }}" class="form-control" id="prenom" required readonly>
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
                        <input type="number" name="contact" value="{{ $ppanne->pchauffeur->contact }}" class="form-control" id="contact" required readonly>
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
                        <input type="email" name="email" value="{{ $ppanne->pchauffeur->email }}" class="form-control" id="email" readonly required>
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
                        <input type="text" name="permis_numero" value="{{ $ppanne->pchauffeur->permis_numero }}" class="form-control" id="permis_numero" required readonly>
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
                        <input type="date" name="permis_validite" value="{{ $ppanne->pchauffeur->permis_validite }}" class="form-control" id="permis_validite" required readonly>
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
@endif

<div class="modal fade" id="infoVehicule{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur le véhicule <span class="text-danger">{{ $ppanne->pvehicule->marque }} : {{ $ppanne->pvehicule->immatriculation }}</span> </h4>
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
                        <input type="text" name="marque" value="{{ $ppanne->pvehicule->marque }}" class="form-control" id="marque" required readonly>
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
                        <input type="text" name="modele" value="{{ $ppanne->pvehicule->modele }}" class="form-control" id="modele" required readonly>
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
                        <input type="text" name="immatriculation" value="{{ $ppanne->pvehicule->immatriculation }}" class="form-control" id="immatriculation" required readonly>
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
                        <input type="text" name="annee" value="{{ $ppanne->pvehicule->annee }}" class="form-control" id="annee" required readonly>
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
                        <input type="text" name="kilometrage" value="{{ $ppanne->pvehicule->kilometrage }}" class="form-control" id="kilometrage" required readonly>
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
                        <input type="date" name="date_achat" value="{{ $ppanne->pvehicule->date_achat }}" class="form-control" id="date_achat" required readonly>
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
                        <input type="text" name="statut" value="{{ $ppanne->pvehicule->statut }}" class="form-control" id="statut" required readonly>
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
                        <input type="text" name="pcategorievehicule_id" value="{{ $ppanne->pvehicule->pcategorievehicule->nom }}" class="form-control" id="pcategorievehicule_id" required readonly>
                        @error('pcategorievehicule_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            @if($ppanne->pvehicule->photo)
                <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($ppanne->pvehicule->photo)) }}">
                    <i class="bi-eye me-1"></i> Photo
                </a>
            @endif

            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
          </div>
          <!-- End Footer -->
      </div>
    </div>
</div>

<div class="modal fade" id="deletePanne{{ $ppanne->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment supprimer la panne signalée par
              <span class="text-danger">{{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom : auth()->user()->nom." ".auth()->user()->prenom }}</span>
              du <span class="text-danger">{{ $ppanne->created_at->format('d/m/Y H:i') }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.ppanne.destroy', $ppanne) }}" method="POST">
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

<div class="modal fade" id="editPanne{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Modifier la panne signalée par
            <span class="text-danger">{{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom : auth()->user()->nom." ".auth()->user()->prenom }}</span>
            du <span class="text-danger">{{ $ppanne->created_at->format('d/m/Y H:i') }}</span> ??
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('packauto.ppanne.update', $ppanne) }}" enctype="multipart/form-data">
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
                                <option value="{{ $ppanne->pchauffeur_id }}">
                                    {{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom." : ".$ppanne->pchauffeur->contact : "Responsable : ".auth()->user()->nom." ".auth()->user()->prenom }}
                                </option>
                                @foreach(chauffeurs()->where('id','!=',$ppanne->pchauffeur_id) as $pchauffeur)
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
                        <div class="flex-grow-1">Date de constat de la panne *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="date_panne" class="visually-hidden form-label">Date de constat de la panne *</label>
                        <input type="date" name="date_panne" value="{{ $ppanne->date_panne }}" class="form-control" id="date_panne" placeholder="Entrer une date de constat de la panne" required>
                        @error('date_panne') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Déffaillances constatées *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="description" class="visually-hidden form-label">Déffaillances constatées *</label>
                        <textarea name="description" id="description" class="form-control" value="{{ old('description') }}" required>{{ $ppanne->description }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <option value="{{ $ppanne->pvehicule->id }}">{{ $ppanne->pvehicule->marque }} : {{ $ppanne->pvehicule->immatriculation }}</option>
                                @foreach(vehicules()->where('id','!=',$ppanne->pvehicule->id) as $pvehicule)
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

<div class="modal fade" id="attesterEntretienPanne{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Attestation d'entretien de la panne signalée par
            <span class="text-danger">{{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom : auth()->user()->nom." ".auth()->user()->prenom }}</span>
            du <span class="text-danger">{{ $ppanne->created_at->format('d/m/Y H:i') }}</span> ??
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('packauto.panne.attester', $ppanne) }}" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Date d'entretien *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="date_entretien" class="visually-hidden form-label">Date d'entretien *</label>
                        <input type="date" name="date_entretien" value="{{ old('date_entretien') }}" class="form-control" id="date_entretien" placeholder="Entrer une date d'entretien" required>
                        @error('date_entretien') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Observations *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="observation" class="visually-hidden form-label">Observations *</label>
                        <textarea name="description" id="observation" class="form-control" value="{{ old('description') }}" placeholder="Entrer une observation"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>  

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Coût de l'entretien (en FCFA)</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="cout" class="visually-hidden form-label">Coût de l'entretien (en FCFA)</label>
                        <input type="number" name="cout" value="{{ old('cout') }}" class="form-control" id="cout" placeholder="Entrer le coût de l'entretien (en FCFA)" required>
                        @error('cout') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Garage</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="garage" class="visually-hidden form-label">Garage</label>
                        <input type="text" name="garage" value="{{ old('garage') }}" class="form-control" id="garage" placeholder="Entrer le nom du garage">
                        @error('garage') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer gap-3">
              <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
              <button type="submit" id="processEvent" class="btn btn-primary">Attester</button>
            </div>
            <!-- End Footer -->
        </form>
        </div>
    </div>
</div>

@if($ppanne->pentretien)
    <div class="modal fade" id="infoEntretien{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header mb-0">
            <h4 class="modal-title" id="createAKIKeyModalLabel">
                Information sur l'entretien de la panne signalée par
                <span class="text-danger">{{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom : auth()->user()->nom." ".auth()->user()->prenom }}</span>
                du <span class="text-danger">{{ $ppanne->created_at->format('d/m/Y H:i') }}</span> ??
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Date d'entretien *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="date_entretien" class="visually-hidden form-label">Date d'entretien *</label>
                        <input type="date" name="date_entretien" value="{{ $ppanne->pentretien->date_entretien }}" class="form-control" id="date_entretien" placeholder="Entrer une date d'entretien" readonly>
                        @error('date_entretien') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Observations *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="observation" class="visually-hidden form-label">Observations *</label>
                        <textarea name="description" id="observation" class="form-control" placeholder="Entrer une observation" readonly>{{ $ppanne->pentretien->description }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>  

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Coût de l'entretien (en FCFA)</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="cout" class="visually-hidden form-label">Coût de l'entretien (en FCFA)</label>
                        <input type="numeric" name="cout" value="{{ getprice($ppanne->pentretien->cout) }}" class="form-control" id="cout" placeholder="Entrer le coût de l'entretien (en FCFA)" readonly>
                        @error('cout') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Garage</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="garage" class="visually-hidden form-label">Garage</label>
                        <input type="text" name="garage" value="{{ $ppanne->pentretien->garage }}" class="form-control" id="garage" placeholder="Entrer le nom du garage" readonly>
                        @error('garage') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer gap-3">
                <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
                <button type="submit" id="processEvent" class="btn btn-primary">Attester</button>
            </div>
            <!-- End Footer -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAttesterEntretienPanne{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header mb-0">
            <h4 class="modal-title" id="createAKIKeyModalLabel">
                Modifier l'entretien de la panne signalée par
                <span class="text-danger">{{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom : auth()->user()->nom." ".auth()->user()->prenom }}</span>
                du <span class="text-danger">{{ $ppanne->created_at->format('d/m/Y H:i') }}</span> ??
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('packauto.panne.attester.update', $ppanne->pentretien) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Date d'entretien *</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="date_entretien" class="visually-hidden form-label">Date d'entretien *</label>
                            <input type="date" name="date_entretien" value="{{ $ppanne->pentretien->date_entretien }}" class="form-control" id="date_entretien" placeholder="Entrer une date d'entretien" required>
                            @error('date_entretien') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Observations *</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="observation" class="visually-hidden form-label">Observations *</label>
                            <textarea name="description" id="observation" class="form-control" placeholder="Entrer une observation">{{ $ppanne->pentretien->description }}</textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Coût de l'entretien (en FCFA)</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="cout" class="visually-hidden form-label">Coût de l'entretien (en FCFA)</label>
                            <input type="number" name="cout" value="{{ $ppanne->pentretien->cout }}" class="form-control" id="cout" placeholder="Entrer le coût de l'entretien (en FCFA)" required>
                            @error('cout') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Garage</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="garage" class="visually-hidden form-label">Garage</label>
                            <input type="text" name="garage" value="{{ $ppanne->pentretien->garage }}" class="form-control" id="garage" placeholder="Entrer le nom du garage">
                            @error('garage') <span class="text-danger">{{ $message }}</span> @enderror
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
@endif


<div class="modal fade" id="infoPanne{{ $ppanne->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Information sur la panne signalée par
            <span class="text-danger">{{ $ppanne->pchauffeur ? $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom : auth()->user()->nom." ".auth()->user()->prenom }}</span>
            du <span class="text-danger">{{ $ppanne->created_at->format('d/m/Y H:i') }}</span> ??
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Date de constat de la panne *</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="date_panne" class="visually-hidden form-label">Date de constat de la panne *</label>
                    <input type="date" name="date_panne" value="{{ $ppanne->date_panne }}" class="form-control" id="date_panne" placeholder="Entrer une date de constat de la panne" readonly>
                    @error('date_panne') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Déffaillances constatées *</div>
                    </div>
                </div>
                <div class="col-sm">
                    <label for="description" class="visually-hidden form-label">Déffaillances constatées *</label>
                    <textarea name="description" id="description" class="form-control" value="{{ old('description') }}" readonly>{{ $ppanne->description }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
</div>