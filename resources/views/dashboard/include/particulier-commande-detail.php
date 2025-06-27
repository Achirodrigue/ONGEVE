
            <div class="card-body">
              <div class="row justify-content-lg-between">
                <div class="col-sm order-2 order-sm-1 mb-3">
                  <div class="mb-2">
                    <img class="avatar" src="{{ asset("dashboard/img/logo1.jpg") }}" style="width: 30%;" alt="Logo">
                  </div>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto order-1 order-sm-2 text-sm-end mb-3">
                  <div class="mb-3">
                    <h2>Devis #</h2>
                    <span class="d-block">{{ $particulierdevis->numero_devis }}</span>
                  </div>

                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <div class="row justify-content-md-between mb-3">
                <div class="col-md">
                  <h4>Facturer à:</h4>
                  <h4>{{ $particulierdevis->particulier->nom }}</h4>
                  <h4>{{ $particulierdevis->particulier->domaine }}</h4>
                  <address>
                    {{ $particulierdevis->particulier->contact }}<br>
                    {{ $particulierdevis->particulier->email }}<br>
                    {{ $particulierdevis->particulier->adresse }}<br>
                  </address>
                </div>
                <!-- End Col -->

                <div class="col-md text-md-end">
                  <dl class="row">
                    <dt class="col-sm-8">Frais:</dt>
                    <dd class="col-sm-4">@if($particulierdevis->frais) {{ getprice($particulierdevis->frais) }} F @else En cours d'attribution @endif</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-8">Délai de livraison:</dt>
                    <dd class="col-sm-4">@if($particulierdevis->delai_livraison) {{ $particulierdevis->delai_livraison }} @else En cours @endif</dd>
                  </dl>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <!-- Table -->
              <div class="table-responsive">
                <table class="table table-borderless table-nowrap table-align-middle">
                  <thead class="thead-light">
                    <tr>
                      <th>Produit</th>
                      <th>Quantité</th>
                      <th>Prix unitaire (Fcfa)</th>
                      <th class="table-text-end">Total (Fcfa)</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($particulierdevis->particulierdevisprods as $particulierdevisprod)
                      <tr>
                        <td>
                          <a class="d-flex align-items-center" href="#">
                            <div class="flex-shrink-0">
                              <img class="avatar avatar-lg" src="{{ asset(Storage::url($particulierdevisprod->produit->image)) }}" alt="Image Description">
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <h5 class="text-inherit mb-0">{{ $particulierdevisprod->produit->nom }} <span class="text-danger font-remise">({{ $particulierdevisprod->particulierremise->remise }}%)</span></h5>
                            </div>
                          </a>
                        </td>
                        <td>{{ $particulierdevisprod->quantite }}</td>
                        <td>{{ getprice($particulierdevisprod->prix_unitaire) }}</td>
                        <td class="table-text-end">{{ getprice($particulierdevisprod->prix_total) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- End Table -->

              <hr class="my-5">

              <div class="row justify-content-md-end mb-3">
                <div class="col-md-8 col-lg-7">
                  <dl class="row text-sm-end">
                    <dt class="col-sm-6">Sous total:</dt>
                    <dd class="col-sm-6">{{ getprice($particulierdevis->total_ttc) }}F</dd>
                    <dt class="col-sm-6">Tax:</dt>
                    <dd class="col-sm-6">{{ getprice($particulierdevis->tva) }}F</dd>
                    <dt class="col-sm-6">Total:</dt>
                    <dd class="col-sm-6">{{ getprice($particulierdevis->total_ttc + $particulierdevis->frais + $particulierdevis->tva) }}F</dd>
                  </dl>
                  <!-- End Row -->
                </div>
              </div>
              <!-- End Row -->

              <div class="mb-3">
                <h3>Merci !</h3>
                <p>pour toute la confiance que vous nous accordez</p>
              </div>

              <!-- <p class="small mb-0">&copy; 2021 Htmlstream.</p> -->
            </div>