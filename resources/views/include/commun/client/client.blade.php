
  <div class="modal fade" id="editClient{{ $client->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le client <span class="text-warning">{{ $client->nom }} {{ $client->prenom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commercial.client.update', $client) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
                <input type="text" name="nom" value="{{ $client->nom }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
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
                <input type="text" name="prenom" value="{{ $client->prenom }}" class="form-control" id="nom" placeholder="Entrer un prenom" aria-label="Entrer un prenom" required>
                @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Genre</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="genre" required class="js-select form-select w-auto" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }'>
                    @if($client->genre === "Homme")
                      <option value="Homme" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>Homme</option>
                      <option value="Femme" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-primary me-2"></span>HS Team</span>'>Femme</option>
                    @else
                      <option value="Femme" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-primary me-2"></span>HS Team</span>'>Femme</option>
                      <option value="Homme" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>Homme</option>
                    @endif
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-calendar-event nav-icon"></i>
                  <div class="flex-grow-1">Date de naissance</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="naissance" class="visually-hidden form-label">Date de naissance</label>
                <input type="date" name="naissance" value="{{ $client->naissance }}" required id="naissance" class="flatpickr-custom form-control mb-2" placeholder="Entrer une date de naissance" data-hs-flatpickr-options='{
                        "dateFormat": "m/d/Y",
                        "mode": "range",
                        "minDate": "12/01/2020"
                      }'>
                @error('naissance') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Contact</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="contact" class="visually-hidden form-label">Contact</label>
                <input type="number" name="contact" required minlength="8" value="{{ $client->contact }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact">
                @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Email</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="email" class="visually-hidden form-label">Email</label>
                <input type="email" name="email" required value="{{ $client->email }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Plafond d'achat</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="Pachat" class="visually-hidden form-label">Plafond d'achat</label>
                <input type="number" name="Pachat" min="1" minlength="1" required value="{{ $client->Pachat }}" class="form-control" id="Pachat">
                @error('Pachat') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Adresse postale complète</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="adresse_postale" class="visually-hidden form-label">Adresse postale complète</label>
                <input type="text" name="adresse_postale" value="{{ $client->adresse_postale }}" class="form-control" id="adresse_postale" placeholder="Entrer une adresse postale complète" aria-label="Entrer une adresse postale complète">
                @error('adresse_postale') <span class="text-danger">{{ $message }}</span> @enderror
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

  <div class="modal fade" id="deleteClient{{ $client->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer le client <span class="text-warning">{{ $client->nom }} {{ $client->prenom }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('comptable.client.destroy', $client) }}" method="POST">
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

  <div class="modal fade" id="infoClient{{ $client->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur <span class="text-warning">{{ $client->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

          <!-- Body -->
          <div class="modal-body">
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Référence</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reference" class="visually-hidden form-label">Référence</label>
                <input type="text" value="{{ $client->reference }}" class="form-control" readonly>
              </div>
            </div>
            @if($client->TC)
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Genre</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="nom" class="visually-hidden form-label">Date</label>
                  <input type="text" value="{{ $client->clientinfo->genre }}" class="form-control" readonly>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">date de naissance</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Remise en %</label>
                  <input type="text" value="{{ $client->clientinfo->naissance }}" class="form-control" readonly>
                </div>
              </div>
            @else
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Interlocuteur</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="interlocuteur" class="visually-hidden form-label">Interlocuteur</label>
                  <input type="text" value="{{ $client->clientinfo->interlocuteur }}" class="form-control" readonly>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Forme juridique</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Prix remise</label>
                  <input type="text" value="{{ $client->clientinfo->forme_juridique }}" class="form-control" readonly>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Numéro d'identification</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Prix remise</label>
                  <input type="text" value="{{ $client->clientinfo->numero_identifie }}" class="form-control" readonly>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Domaine</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Prix remise</label>
                  <input type="text" value="{{ $client->clientinfo->domaine }}" class="form-control" readonly>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Siege social</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Prix remise</label>
                  <input type="text" value="{{ $client->clientinfo->siege_social }}" class="form-control" readonly>
                </div>
              </div>
              
              @if($client->commercial_id)
                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-list-ul nav-icon"></i>
                      <div class="flex-grow-1">Commercial</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="prenom" class="visually-hidden form-label">commercial</label>
                    <input type="text" value="{{ $client->commercial->nom }} {{ $client->commercial->prenom }}" class="form-control" readonly>
                  </div>
                </div>
              @endif
            @endif
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