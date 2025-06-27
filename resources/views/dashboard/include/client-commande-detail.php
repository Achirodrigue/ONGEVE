          <div class="card card-lg mb-5">
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
                    <span class="d-block">{{ $clientdevis->numero_devis }}</span>
                  </div>

                  <!-- <address class="text-dark">
                    45 Roker Terrace<br>
                    Latheronwheel<br>
                    KW5 8NW, London<br>
                    United Kingdom
                  </address> -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <div class="row justify-content-md-between mb-3">
                <div class="col-md">
                  <h4>Facturer à:</h4>
                  <h4>{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</h4>
                  <address>
                    {{ $clientdevis->client->contact }}<br>
                    {{ $clientdevis->client->email }}<br>
                    {{ $clientdevis->client->adresse_postale }}<br>
                  </address>
                </div>
                <!-- End Col -->

                <div class="col-md text-md-end">
                  <dl class="row">
                    <dt class="col-sm-8">Frais:</dt>
                    <dd class="col-sm-4">@if($clientdevis->frais) {{ getprice($clientdevis->frais) }} F @else En cours d'attribution @endif</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-8">Délai de livraison:</dt>
                    <dd class="col-sm-4">@if($clientdevis->delai_livraison) {{ $clientdevis->delai_livraison }} @else En cours @endif</dd>
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
                    @foreach($clientdevis->clientdevisprods as $clientdevisprod)
                      <tr>
                        <td>
                          <a class="d-flex align-items-center" href="#">
                            <div class="flex-shrink-0">
                              <img class="avatar avatar-lg" src="{{ asset(Storage::url($clientdevisprod->produit->image)) }}" alt="Image Description">
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <h5 class="text-inherit mb-0">{{ $clientdevisprod->produit->nom }} <span class="text-danger font-remise">({{ $clientdevisprod->clientremise->remise }}%)</span></h5>
                            </div>
                          </a>
                        </td>
                        <td>{{ $clientdevisprod->quantite }}</td>
                        <td>{{ getprice($clientdevisprod->prix_unitaire) }}</td>
                        <td class="table-text-end">{{ getprice($clientdevisprod->prix_total) }}</td>
                      </tr>
                    @endforeach

                    <!-- <tr>
                      <th>Web project</th>
                      <td>1</td>
                      <td>24</td>
                      <td class="table-text-end">$1250</td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              <!-- End Table -->

              <hr class="my-5">

              <div class="row justify-content-md-end mb-3">
                <div class="col-md-8 col-lg-7">
                  <dl class="row text-sm-end">
                    <dt class="col-sm-6">Sous total:</dt>
                    <dd class="col-sm-6">{{ getprice($clientdevis->total_ttc) }}F</dd>
                    <dt class="col-sm-6">Tax:</dt>
                    <dd class="col-sm-6">{{ getprice($clientdevis->tva) }}F</dd>
                    <dt class="col-sm-6">Total:</dt>
                    <dd class="col-sm-6">{{ getprice($clientdevis->total_ttc + $clientdevis->frais + $clientdevis->tva) }}F</dd>
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
          </div>