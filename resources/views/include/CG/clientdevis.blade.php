  <div class="modal fade" id="addtransactioncommande{{ $clientdevis->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une nouvelle transaction à la commande <span class="text-danger">{{ $clientdevis->numero_devis }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header mt-0">
          <h4 class="modal-title">Reste à payer : <span class="text-danger">{{ getprice($clientdevis->total_payer - $clientdevis->versement) }}F</span></h4>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.client.devis.transaction.store', $clientdevis) }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Reference de la transaction</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reference" class="visually-hidden form-label">Reference de la transaction</label>
                <input type="text" min="1" name="reference" value="{{ old('reference') }}" class="form-control" id="reference" placeholder="Entrer la reference de la transaction" required>
                @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Montant de la transaction</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="montant" class="visually-hidden form-label">Montant de la transaction</label>
                <input type="number" min="1" name="montant" value="{{ old('montant') }}" class="form-control" id="montant" placeholder="Entrer le montant de la transaction" required>
                @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Décaissement</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="decaissement" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }'>
                      <option value="Espèce">Espèce</option>
                      <option value="Chèque">Chèque</option>
                      <option value="Virement">Virement</option>
                      <option value="Money">Money</option>
                      <option value="Traite">Traite</option>
                  </select>
                </div>
              </div>
            </div>

          </div>

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Valider</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="adddevisbon{{ $clientdevis->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Associer un bon à la commande <span class="text-danger">{{ $clientdevis->numero_devis }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="POST" action="{{ route('commun.client.devis.add.bon', $clientdevis) }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Bon de commande *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="fichier" class="visually-hidden form-label">Bon de commande</label>
                <input type="file" name="fichier" class="form-control" id="fichier" required>
                @error('fichier') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Valider</button>
          </div>
          <!-- End Footer -->
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editclientdevis{{ $clientdevis->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier la facture <span class="text-danger">{{ $clientdevis->numero_devis }}</span> du client <span class="text-danger">{{ $clientdevis->client->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- <div class="modal-header mt-0">
          <h4 class="modal-title">Reste à payer : <span class="text-danger">{{ getprice($clientdevis->total_payer - $clientdevis->versement) }}F</span></h4>
        </div> -->
        <!-- End Header -->

        <form method="post" action="{{ route('commun.client.devis.update', $clientdevis) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">TVA</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="apptva" class="visually-hidden form-label">TVA</label>
                <select name="apptva" class="form-control w-100" id="" required>
                  @if($clientdevis->apptva)
                    <option value="1">TVA appliqué</option>
                    <option value="0">Suspendre la TVA</option>
                  @else($clientdevis->apptva)
                    <option value="0">TVA suspendu</option>
                    <option value="1">Appliquer la TVA</option>
                  @endif
                </select>
                @error('apptva') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Frais de livraison</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="frais" class="visually-hidden form-label">Frais de livraison</label>
                <input type="number" name="frais" value="{{ $clientdevis->frais }}" class="form-control" id="nom" aria-label="Entrer un nom">
                @error('frais') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Délai de livraison</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_livraison" class="visually-hidden form-label">Délai de livraison</label>
                <input type="text" name="delai_livraison" value="{{ $clientdevis->delai_livraison }}" class="form-control" id="delai_livraison" aria-label="Entrer un prenom">
                @error('delai_livraison') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <hr>
            
            @if(auth()->user()->role)
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">AIRSI (en %)</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="airsi" class="visually-hidden form-label">AIRSI</label>
                  <input type="number" min="1" max="100" name="airsi" value="{{ $clientdevis->airsi }}" class="form-control" id="airsi" placeholder="Entrer l'AIRSI">
                  @error('airsi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>            
              <!-- <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Timbre (en %)</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="timbre" class="visually-hidden form-label">Timbre</label>
                  <input type="number" min="1" max="100" name="timbre" value="{{ $clientdevis->timbre }}" class="form-control" id="timbre" placeholder="Entrer le monrant de la timbre">
                  @error('timbre') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>      -->
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Montant de Timbre</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="timbre_montant" class="visually-hidden form-label">Timbre</label>
                  <input type="number" name="timbre_montant" value="{{ $clientdevis->timbre_montant }}" class="form-control" id="timbre_montant" placeholder="Entrer le montant de la timbre">
                  @error('timbre_montant') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Date d'émission</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="date_emission" class="visually-hidden form-label">Date d'émission</label>
                  <input type="text" name="date_emission" value="{{ $clientdevis->date_emission }}" class="form-control" id="date_emission" placeholder="Entrer la date d'émission">
                  @error('date_emission') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Date de reception de la facture</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="daterecfacture" class="visually-hidden form-label">Date de reception de la facture</label>
                  <input type="text" name="daterecfacture" value="{{ $clientdevis->daterecfacture }}" class="form-control" id="daterecfacture" placeholder="Entrer le monrant de la timbre">
                  @error('daterecfacture') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
            @endif
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Délai de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_paiement" class="visually-hidden form-label">Délai de paiement</label>
                <select name="delai_paiement" class="form-control w-100" id="">
                  <option value="{{ $clientdevis->delai_paiement }}">@if($clientdevis->delai_paiement) {{ $clientdevis->delai_paiement }} @else Aucun @endif</option>
                  @foreach(delaipays() as $delaipay)
                    <option value="{{ $delaipay->delaipay }}">{{ $delaipay->delaipay }}</option>
                  @endforeach
                </select>
                @error('delai_paiement') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Moyen de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="MP" class="visually-hidden form-label">Moyen de paiement</label>
                <select name="delai_paiement" class="form-control w-100" id="">
                  <option value="{{ $clientdevis->MP }}">@if($clientdevis->MP) {{ $clientdevis->MP }} @else Aucun @endif</option>
                  @foreach(moyenpays() as $moyenpay)
                    <option value="{{ $moyenpay->nom }}">{{ $moyenpay->nom }}</option>
                  @endforeach
                </select>
                @error('MP') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Objet</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="objet" class="visually-hidden form-label">objet</label>
                <input type="text" name="objet" value="{{ $clientdevis->objet }}" class="form-control" id="objet" required>
                @error('objet') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <hr>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nouveau bon de commande (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="fichier" class="visually-hidden form-label">Nouveau bon de commande (facultatif)</label>
                <input type="file" name="fichier" class="form-control" id="fichier">
                @error('fichier') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            @if($clientdevis->TDF != null)
                <hr>

                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Date de debut de prestation</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="debut" class="visually-hidden form-label">Date de debut de prestation</label>
                    <input type="date" name="debut" value="{{ $clientdevis->clientdevisinfo->debut }}" class="form-control" id="debut" placeholder="Entrer la date de debut de prestation">
                    @error('debut') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Date de fin de prestation</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="fin" class="visually-hidden form-label">Date de fin de prestation</label>
                    <input type="date" name="fin" value="{{ $clientdevis->clientdevisinfo->fin }}" class="form-control" id="fin" placeholder="Entrer la date de fin de prestation">
                    @error('fin') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Chantier (facultatif)</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="chantier" class="visually-hidden form-label">Chantier</label>
                    <input type="text" name="chantier" value="{{ $clientdevis->chantier }}" class="form-control" id="chantier" placeholder="Entrer le chantier">
                    @error('chantier') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>
            @endif

          </div>

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

  <div class="modal fade" id="infoClientdevis{{ $clientdevis->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur <span class="text-danger">{{ $clientdevis->numero_devis }}</span> du client <span class="text-danger">{{ $clientdevis->client->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">TVA</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="apptva" class="visually-hidden form-label">TVA</label>
                <input type="text" name="apptva" value="@if($clientdevis->apptva) TVA appliqué @else TVA suspendu @endif" class="form-control" id="apptva" readonly>
                @error('apptva') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Frais de livraison</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="frais" class="visually-hidden form-label">Frais de livraison</label>
                <input type="text" name="frais" value="{{ getpricefr($clientdevis->frais) }}" class="form-control" id="frais" readonly>
                @error('frais') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Délai de livraison</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_livraison" class="visually-hidden form-label">Délai de livraison</label>
                <input type="text" name="delai_livraison" value="{{ $clientdevis->delai_livraison }}" class="form-control" id="delai_livraison" readonly>
                @error('delai_livraison') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">AIRSI</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="airsi" class="visually-hidden form-label">AIRSI</label>
                <input type="text" name="airsi" value="@if($clientdevis->airsi) {{ $clientdevis->airsi }}% @endif" class="form-control" id="airsi" readonly>
                @error('airsi') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">AIRSI Montant</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="airsi_montant" class="visually-hidden form-label">AIRSI</label>
                <input type="text" name="airsi_montant" value="{{ getpricefr($clientdevis->airsi_montant) }}" class="form-control" id="airsi" readonly>
                @error('airsi_montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <!-- <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Timbre</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="timbre" class="visually-hidden form-label">Timbre</label>
                <input type="text" name="timbre" value="@if($clientdevis->timbre) {{ $clientdevis->timbre }}% @endif" class="form-control" id="timbre" readonly>
                @error('timbre') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div> -->
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Timbre Montant</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="timbre_montant" class="visually-hidden form-label">Timbre</label>
                <input type="text" name="timbre_montant" value="{{ getpricefr($clientdevis->timbre_montant) }}" class="form-control" id="timbre_montant" readonly>
                @error('timbre_montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Date d'émission</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="date_emission" class="visually-hidden form-label">Date d'émission</label>
                <input type="text" name="date_emission" value="{{ $clientdevis->date_emission }}" class="form-control" id="date_emission" readonly>
                @error('date_emission') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Date de reception de la facture</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="daterecfacture" class="visually-hidden form-label">Date de reception de la facture</label>
                <input type="text" name="daterecfacture" value="{{ $clientdevis->daterecfacture }}" class="form-control" id="daterecfacture" readonly>
                @error('daterecfacture') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Délai de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_paiement" class="visually-hidden form-label">Délai de paiement</label>
                <input type="text" name="delai_paiement" value="{{ $clientdevis->delai_paiement }}" class="form-control" id="delai_paiement" readonly>
                @error('delai_paiement') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Moyen de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="MP" class="visually-hidden form-label">Moyen de paiement</label>
                <input type="text" name="MP" value="{{ $clientdevis->MP }}" class="form-control" id="MP" readonly>
                @error('MP') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Objet</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="objet" class="visually-hidden form-label">objet</label>
                <input type="text" name="objet" value="{{ $clientdevis->objet }}" class="form-control" id="objet" readonly>
                @error('objet') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Créateur de la facture</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_paiement" class="visually-hidden form-label">Délai de paiement</label>
                <input type="text" name="commercial" value="@if($clientdevis->commercial_id) Commercial {{ $clientdevis->commercial->nom }} {{ $clientdevis->commercial->prenom }} @else Comptabilité @endif" class="form-control" id="commercial" readonly>
                @error('commercial') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            @if($clientdevis->TDF != null)
                <hr>

                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Date de debut de prestation</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="debut" class="visually-hidden form-label">Date de debut de prestation</label>
                    <input type="date" name="debut" value="{{ $clientdevis->clientdevisinfo->debut }}" class="form-control" id="debut" placeholder="Entrer la date de debut de prestation" readonly>
                    @error('debut') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Date de fin de prestation</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="fin" class="visually-hidden form-label">Date de fin de prestation</label>
                    <input type="date" name="fin" value="{{ $clientdevis->clientdevisinfo->fin }}" class="form-control" id="fin" placeholder="Entrer la date de fin de prestation" readonly>
                    @error('fin') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="d-flex align-items-center mt-2">
                      <i class="bi-people nav-icon"></i>
                      <div class="flex-grow-1">Chantier (facultatif)</div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <label for="chantier" class="visually-hidden form-label">Chantier</label>
                    <input type="text" name="chantier" value="{{ $clientdevis->chantier }}" class="form-control" id="chantier" placeholder="Entrer le chantier" readonly>
                    @error('chantier') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>
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

  <div class="modal fade" id="deleteclientdevis{{ $clientdevis->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
              Voulez-vous vraiment supprimer la facture 
              <span class="text-danger">{{ $clientdevis->numero_devis }}</span> 
              du client  <span class="text-danger">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('commun.client.devis.destroy', $clientdevis) }}" method="POST">
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

  <div class="modal fade" id="infoFneJsonComfirm{{ $clientdevis->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">FNE json de confirmation <span class="text-warning">{{ $clientdevis->numero_devis }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
            <pre class="bg-dark text-white">
@if($clientdevis->facturefne)
{{ json_encode(json_decode($clientdevis->facturefne->raw_response), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
@endif
            </pre>
        </div>
        <!-- End Body -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="devisPrestationAdd{{ $clientdevis->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header --> 
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
             Ajouter une prestation de service <span class="text-danger"></span>
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.clientdevis.prestation.store', $clientdevis) }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Désignation</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="designation" class="visually-hidden form-label">Désignation</label>
                <textarea name="designation" id="designation" class="form-control" value="{{ old('designation') }}" placeholder="Entrer une designation" required></textarea>
                @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
        
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Nombre de passage</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nbre_passage" class="visually-hidden form-label">Nombre de passage</label>
                <input type="number" min="1" name="nbre_passage" required value="{{ old('nbre_passage') }}" class="form-control" id="nbre_passage" placeholder="Entrer le nombre de passage">
                @error('nbre_passage') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Prix unitaire</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prix_unitaire" class="visually-hidden form-label">Prix unitaire</label>
                <input type="number" min="1" name="prix_unitaire" required value="{{ old('prix_unitaire') }}" class="form-control" id="prix_unitaire" placeholder="Entrer le prix unitaire">
                @error('prix_unitaire') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4 d-none">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Quantité</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="quantite" class="visually-hidden form-label">Quantité</label>
                <input type="number" min="1" name="quantite" value="{{ old('quantite') }}" class="form-control" id="quantite" placeholder="Entrer la quantité">
                @error('quantite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Unité de prestation</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="unite" class="visually-hidden form-label">Unité de vente ou de prestation</label>
                <select name="unite" class="form-control" autocomplete="off" id="unite" data-hs-tom-select-options='{
                          "searchInDropdown": false,
                          "hideSearch": true,
                          "placeholder": "Select category"
                        }'>
                  <option value="">Aucune</option>
                  <option value="L">L</option>
                  <option value="KG">KG</option>
                  <option value="Pièce">Pièce</option>
                  <option value="Carton">Carton</option>
                  <option value="Boîte">Boîte</option>
                  <option value="Sac">Sac</option>
                  <option value="Paquet">Paquet</option>
                </select>
                @error('unite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>