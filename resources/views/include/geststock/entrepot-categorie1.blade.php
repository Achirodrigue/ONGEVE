  <div class="modal fade" id="addEntrepotCategorie{{ $categorie->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une famille à l'entrepôt <span class="text-danger">{{ $categorie->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('geststock.entrepotcateg.store', $categorie) }}" enctype="multipart/form-data">
          @csrf
          <!-- Body -->
          <div class="modal-body">
            @if(categorieprods()->count() > 0)
              <select name="categorieprod_id" id="categorieprod_id" class="form-control" required>
                @foreach(categorieprods() as $categorieprod)
                  <option value="{{ $categorieprod->id }}">{{ $categorieprod->nom }}</option>
                @endforeach
              </select>
            @else
              <p class="fw-bold mb-0">Desolé! Aucune famille de produit disponible sur la plateforme</p>
            @endif
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
              <div class="col-sm-auto">
                <div class="d-flex gap-3">
                  <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Sortir</button>
                  @if(categorieprods()->count() > 0)
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  @endif
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
  