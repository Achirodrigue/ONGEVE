  <div class="modal fade" id="infoFneJsonComfirm{{ $clientdevisavoir->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">FNE json de confirmation <span class="text-warning">{{ $clientdevisavoir->numero_devis }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
          @if($clientdevisavoir->facturefneavoir) 
            <pre class="bg-dark text-white">
{{ json_encode(json_decode($clientdevisavoir->facturefneavoir->raw_response), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
            </pre>
          @else
            <h4>Aucune reponse</h4>
          @endif
        </div>
        <!-- End Body -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteClientdevisAvoir{{ $clientdevisavoir->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer l'avoir <span class="text-warning">{{ $clientdevisavoir->numero_devis }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('comptable.commande.avoir.destroy', $clientdevisavoir) }}" method="POST">
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