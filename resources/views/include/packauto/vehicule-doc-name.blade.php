  <!-- edit New Category Modal -->
  <div class="modal fade" id="editVehiculeDocName{{ $pvehiculedocname->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le document de véhicule <span class="text-danger">{{ $pvehiculedocname->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('packauto.pvehiculedocname.update', $pvehiculedocname) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <!-- Body -->
          <div class="modal-body">
            <!-- Form -->
              <input type="text" name="nom" value="{{ $pvehiculedocname->nom }}" class="form-control" required>
              @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
            <!-- End Form -->
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
              <div class="col-sm-auto">
                <div class="d-flex gap-3">
                  <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Sortir</button>
                  <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- End Footer -->
        </form>
        
      </div>
    </div>
  </div>
  <!-- End Create New API Key Modal -->

  <!-- delete New Category Modal -->
  <div class="modal fade" id="deleteVehiculeDocName{{ $pvehiculedocname->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer le document de véhicule <span class="text-danger">{{ $pvehiculedocname->nom }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('packauto.pvehiculedocname.destroy', $pvehiculedocname) }}" method="POST">
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