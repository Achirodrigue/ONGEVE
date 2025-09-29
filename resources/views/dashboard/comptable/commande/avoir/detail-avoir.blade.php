@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header d-print-none">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <!-- <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-no-gutter">
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
              </ol>
            </nav> -->

            <h1 class="page-header-title">Details de l'avoir de {{ $clientdevisavoir->numero_devis }} de la facture <span class="text-warning">{{ $clientdevisavoir->clientdevis->numero_devis }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('comptable.commande.client.all.avoir', $clientdevisavoir->clientdevis) }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0 mx-auto">
          <!-- Card -->

          <!-- Footer -->
          <div class="d-flex justify-content-end d-print-none gap-3 mb-5">
            <a class="btn btn-white" href="{{ route('pdf.avoir', $clientdevisavoir) }}" target="_blank">
              <i class="bi-file-earmark-arrow-down me-1"></i> PDF
            </a>
          </div>
          <!-- End Footer -->
           
          <div class="card card-lg">
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
                    <h2>
                      Facture d'avoir #
                    </h2>
                    <span class="d-block">{{ $clientdevisavoir->numero_devis }}</span>
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
                  <h4>{{ $clientdevisavoir->clientdevis->client->nom }}</h4>
                  <address>
                    {{ $clientdevisavoir->clientdevis->client->contact }}<br>
                    {{ $clientdevisavoir->clientdevis->client->email }}<br>
                    {{ $clientdevisavoir->clientdevis->client->adresse_postale }}<br>
                  </address>
                </div>
                <!-- End Col -->

                <div class="col-md text-md-end">
                  <dl class="row">
                    <dt class="col-sm-8">Désignation:</dt>
                    <dd class="col-sm-4">@if($clientdevisavoir->clientdevis->TDF == null) Vente de produit @elseif($clientdevisavoir->clientdevis->TDF == 1) Location de produit @else Prestation de service @endif</dd>
                  </dl>
                  <!-- <dl class="row">
                    <dt class="col-sm-8">Délai de livraison:</dt>
                    <dd class="col-sm-4">@if($clientdevisavoir->clientdevis->delai_livraison) {{ $clientdevisavoir->clientdevis->delai_livraison }} @else En cours @endif</dd>
                  </dl> -->
                  <dl class="row">
                    <dt class="col-sm-8">Statut facture vente:</dt>
                    <dd class="col-sm-4">@if($clientdevisavoir->clientdevis->status == null) Impayé @elseif($clientdevisavoir->clientdevis->status == 1) Payé @else Partielle @endif</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-8">Reste à payer:</dt>
                    <dd class="col-sm-4">{{ getprice($clientdevisavoir->clientdevis->total_payer - $clientdevisavoir->clientdevis->versement) }} F</dd>
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
                      <th>Designation</th>
                      <th>@if($clientdevisavoir->clientdevis->TDF != 2) Quantité @else Passage @endif</th>
                      <th>Prix unitaire (Fcfa)</th>
                      <th class="table-text-end">Total (Fcfa)</th>
                    </tr>
                  </thead>

                  <tbody>
                    @if($clientdevisavoir->clientdevis->TDF != 2) 
                        @foreach($clientdevisavoir->clientdevisavoirprods as $clientdevisavoirprod)
                          <tr>
                            <td>
                              <h5 class="text-inherit mb-0">
                                {{ $clientdevisavoirprod->clientdevisprod->produit->nom }} 
                                @if($clientdevisavoirprod->clientdevisprod->clientdevisremise && 
                                    $clientdevisavoirprod->clientdevisprod->clientdevisremise->TR)
                                  <span class="text-danger font-remise">({{ $clientdevisavoirprod->clientdevisprod->clientdevisremise->remise }}%)</span>
                                @endif
                              </h5>
                            </td>
                            <td>{{ $clientdevisavoirprod->quantite }}</td>
                            <td>
                              {{ getprice($clientdevisavoirprod->clientdevisprod->prix_unitaire) }}
                              @if($clientdevisavoirprod->clientdevisprod->clientdevisremise && 
                                  $clientdevisavoirprod->clientdevisprod->clientdevisremise->TR)
                                <span class="text-danger font-remise">({{ getprice($clientdevisavoirprod->clientdevisprod->clientdevisremise->prix_remise) }}%)</span>
                              @endif
                            </td>
                            <td class="table-text-end">{{ getprice($clientdevisavoirprod->prix_total) }}</td>
                          </tr>
                        @endforeach
                    @else
                        @foreach($clientdevisavoir->clientdevisavoirprestations as $clientdevisavoirprestation)
                          <tr>
                            <td>
                              <h5 class="text-inherit mb-0">
                                {{ $clientdevisavoirprestation->clientdevisprestation->designation }}
                              </h5>
                            </td>
                            <td>{{ $clientdevisavoirprestation->quantite }}</td>
                            <td>{{ getprice($clientdevisavoirprestation->clientdevisprestation->prix_unitaire) }}</td>
                            <td class="table-text-end">{{ getprice($clientdevisavoirprestation->prix_total) }}</td>
                          </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- End Table -->

              <hr class="my-5">

              <div class="row justify-content-md-end mb-3">
                <div class="col-md-8 col-lg-7">
                  <dl class="row text-sm-end">
                    <dt class="col-sm-6">Sous total:</dt>
                    <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->total_ttc) }}</dd>
                    <!-- <dt class="col-sm-6">Frais:</dt>
                    <dd class="col-sm-6">@if($clientdevisavoir->clientdevis->frais) {{ getpricefr($clientdevisavoir->clientdevis->frais) }} @else Aucun @endif</dd> -->
                    <!-- @if($clientdevisavoir->clientdevis->frais) <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->clientdevis->frais) }}</dd> @endif -->
                    <dt class="col-sm-6">Tax:</dt>
                    <dd class="col-sm-6">@if($clientdevisavoir->tva) {{ getpricefr($clientdevisavoir->tva) }} @else Aucune @endif</dd>
                    <!-- @if($clientdevisavoir->tva) <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->tva) }}</dd> @endif -->
                    @if($clientdevisavoir->airsi) 
                      <dt class="col-sm-6">AIRSI <span class="font-remise">({{ $clientdevisavoir->airsi }}%)</span> :</dt>
                      <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->airsi_montant) }}</dd> 
                    @endif
                    <!-- @if($clientdevisavoir->airsi) <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->airsi) }}</dd> @endif -->
                    <!-- <dt class="col-sm-6">Timbre:</dt>
                    <dd class="col-sm-6">@if($clientdevisavoir->clientdevis->timbre) {{ getpricefr($clientdevisavoir->clientdevis->timbre) }} @else Aucun @endif</dd> -->
                    <!-- @if($clientdevisavoir->clientdevis->timbre) <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->clientdevis->timbre) }}</dd> @endif -->
                    <dt class="col-sm-6">Total:</dt>
                    <!-- <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->total_ttc + $clientdevisavoir->clientdevis->frais + $clientdevisavoir->tva + $clientdevisavoir->airsi_montant + $clientdevisavoir->clientdevis->timbre) }}</dd> -->
                    <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->total_payer) }}</dd>
                    <!-- <dd class="col-sm-6">{{ getpricefr($clientdevisavoir->total_payer + $clientdevisavoir->clientdevis->timbre + $clientdevisavoir->clientdevis->frais) }}</dd> -->
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
          <!-- End Card -->
        </div>

      </div>
    </div>
    <!-- End Content -->

    <!-- End Footer -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->


@endsection