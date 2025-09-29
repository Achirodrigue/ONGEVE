
<div class="modal fade" id="addAffectation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Affecter un emprunt à un véhicule
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('commun.emprunt.vehicule.store') }}" enctype="multipart/form-data">
        @csrf
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
                                @foreach(chauffeurs() as $pchauffeur)
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
                        <input type="date" name="date_debut" value="{{ old('date_debut') }}" class="form-control" id="date_debut" placeholder="Entrer une date de début d'emprunt" required>
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
                        <input type="date" name="date_fin" value="{{ old('date_fin') }}" class="form-control" id="date_fin" placeholder="Entrer une Date de fin d'emprunt">
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
                        <textarea name="mission" id="mission" class="form-control" value="{{ old('mission') }}" required></textarea>
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
                                @foreach(vehicules() as $pvehicule)
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
            <button type="submit" id="processEvent" class="btn btn-primary">Emprunter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
</div>