  <!-- edit New Category Modal -->
    <div class="modal fade" id="editChauffeurDocument{{ $pchauffeurdoc->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <!-- Header --> 
                <div class="modal-header">
                    <h4 class="modal-title" id="createAKIKeyModalLabel">
                      Modifier le document <span class="text-danger">{{ $pchauffeurdoc->pchauffeurdocname->nom }}</span> 
                      du chauffeur <span class="text-danger">{{ $pchauffeurdoc->pchauffeur->nom }} {{ $pchauffeurdoc->pchauffeur->prenom }}</span>
                    <h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- End Header -->

                <form method="post" action="{{ route('packauto.chauffeur.document.update', $pchauffeurdoc) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- Body -->
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Date d'expiration *</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="date_expiration" class="visually-hidden form-label">Date d'expiration *</label>
                            <input type="date" name="date_expiration" value="{{ $pchauffeurdoc->date_expiration }}" class="form-control" id="date_expiration" placeholder="Entrer une date d'expiration" aria-label="Entrer une date d'expiration">
                            @error('date_expiration') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="d-flex align-items-center mt-2">
                            <i class="bi-people nav-icon"></i>
                            <div class="flex-grow-1">Nouveau fichier</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="fichier" class="visually-hidden form-label">Nouveau fichier</label>
                            <input type="file" name="fichier" class="form-control" id="fichier" placeholder="Entrer un fichier" aria-label="Entrer un fichier">
                            @error('fichier') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <!-- End Body -->

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
  <!-- End Create New API Key Modal -->

  <!-- delete New Category Modal -->
  <div class="modal fade" id="deleteChauffeurDocument{{ $pchauffeurdoc->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment supprimer le document 
              <span class="text-danger">{{ $pchauffeurdoc->pchauffeurdocname->nom }}</span> 
              du chauffeur <span class="text-danger">{{ $pchauffeurdoc->pchauffeur->nom }} {{ $pchauffeurdoc->pchauffeur->prenom }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.chauffeur.document.destroy', $pchauffeurdoc) }}" method="POST">
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
  <!-- End Create New API Key Modal -->