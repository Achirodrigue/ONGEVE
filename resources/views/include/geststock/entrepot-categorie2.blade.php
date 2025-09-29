  <div class="modal fade" id="addEntrepotCategorie" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une famille de produit à un entrepôt</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('geststock.entrepotcategs.store') }}" enctype="multipart/form-data">
          @csrf
          <!-- Body -->
          <div class="modal-body">
            @if(categories()->count() > 0 && categorieprods()->count() > 0)
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Entrepôt</div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="tom-select-custom">
                    <select name="categorie_id" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                              "searchInDropdown": false,
                              "placeholder": "Select event color"
                            }'>
                      @foreach(categories() as $categorie)
                        <option value="{{ $categorie->id }}" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>{{ $categorie->nom }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Famille de produit</div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="tom-select-custom">
                    <select name="categorieprod_id" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                              "searchInDropdown": false,
                              "placeholder": "Select event color"
                            }'>
                      @foreach(categorieprods() as $categorieprod)
                        <option value="{{ $categorieprod->id }}" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>{{ $categorieprod->nom }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
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
                  @if(categories()->count() > 0 && categorieprods()->count() > 0)
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