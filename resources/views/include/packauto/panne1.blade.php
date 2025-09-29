<div class="modal fade" id="addPanne" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Signaler une panne sur un véhicule
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('commun.panne.vehicule.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Signaleur</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="pchauffeur_id" class="visually-hidden form-label">Signaleur</label>
                        <select name="pchauffeur_id" class="form-control" id="pchauffeur_id">
                            <option value="">Moi : {{ auth()->user()->nom }} {{ auth()->user()->prenom }}</option>
                            @if(chauffeurs()->count() > 0)
                                @foreach(chauffeurs() as $pchauffeur)
                                    <option value="{{ $pchauffeur->id }}">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }} : {{ $pchauffeur->contact }}</option>
                                @endforeach
                            @endif
                        </select>
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
                        <input type="date" name="date_panne" value="{{ old('date_panne') }}" class="form-control" id="date_panne" placeholder="Entrer une date de constat de la panne" required>
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
                        <textarea name="description" id="description" class="form-control" value="{{ old('description') }}" required></textarea>
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
            <button type="submit" id="processEvent" class="btn btn-primary">Signaler</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
</div>
