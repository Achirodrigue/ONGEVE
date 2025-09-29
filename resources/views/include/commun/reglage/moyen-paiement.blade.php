
  <div class="modal fade" id="editMoyenPay{{ $moyenpay->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le moyen de paiement <span class="text-danger">{{ $moyenpay->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.moyenpay.update', $moyenpay) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Moyen de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Moyen de paiement</label>
                <input type="text" name="nom" value="{{ $moyenpay->nom }}" class="form-control" id="nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
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

  <div class="modal fade" id="deleteMoyenPay{{ $moyenpay->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer la moyen de paiement <span class="text-danger">{{ $moyenpay->nom }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('commun.moyenpay.destroy', $moyenpay) }}" method="POST">
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