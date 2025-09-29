<!-- delete New Category Modal -->
  <div class="modal fade" id="deleteProduit{{ $produit->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer le produit <span class="text-warning">{{ $produit->nom }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('magasinier.produit.destroy', $produit) }}" method="POST">
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


<div class="modal fade" id="editProdPrix{{ $produit->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le prix de <span class="text-warning">{{ $produit->nom }}</span></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-header">
        <h5>Prix actuel : <span class="text-success">{{ getprice($produit->prix) }} Fcfa</span></h5>
      </div>
      <!-- End Header -->

      <!-- Body -->
      <form method="post" action="{{ route('commercial.devis.produit.prix.update', $produit) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
        <div class="modal-body">
            <input type="number" name="prix" value="{{ $produit->prix }}" min="1" class="form-control" required>
            @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer">
          <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
            <!-- <div class="col-sm mb-2 mb-sm-0">
              <p class="modal-footer-text">What is an API? <i class="bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="API stands for application programming interface. It can be helpful to think of the API as a way for different apps to talk to one another."></i></p>
            </div> -->
            <!-- End Col -->

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