@extends('dashboard.commercial.layout.app')
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

            <h1 class="page-header-title">Details du devis de <span class="text-warning">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('commercial.devis.client.encours') }}">
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
                    <h2>@if($clientdevis->clientdevisinfo->isvalide) Commande @else Devis @endif #</h2>
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
                  <h4>{{ $clientdevis->client->nom }}</h4>
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
                          <h5 class="text-inherit mb-0">{{ $clientdevisprod->produit->nom }} @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR)<span class="text-danger font-remise">({{ $clientdevisprod->clientdevisremise->remise }}%)</span>@endif</h5>
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
          <!-- End Card -->

          <!-- Footer -->
          <div class="d-flex justify-content-end d-print-none gap-3">
            <a class="btn btn-white" href="{{ route('pdf.devis.commande.client', $clientdevis) }}" target="_blank">
              <i class="bi-file-earmark-arrow-down me-1"></i> PDF
            </a>

            @if(!$clientdevis->clientdevisinfo->isvalide)
            <a class="btn btn-primary" href="{{ route('commercial.devis.client.convertir.update', $clientdevis) }}">
              <i class="bi-printer me-1"></i> Convertir en commande
            </a>
            @endif
          </div>
          <!-- End Footer -->
        </div>

        <!-- <div class="col-lg-4">
          <div class="card d-print-none">
            <div class="card-header card-header-content-between">
              <h4 class="card-header-title">History</h4>

              <div class="hs-unfold">
                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" id="reportsOverviewDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi-three-dots-vertical"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-1">
                  <span class="dropdown-header">Settings</span>

                  <a class="dropdown-item" href="#">
                    <i class="bi-share-fill dropdown-item-icon"></i> Share reports
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="bi-download dropdown-item-icon"></i> Download
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="bi-alt dropdown-item-icon"></i> Connect other apps
                  </a>

                  <div class="dropdown-divider"></div>

                  <span class="dropdown-header">Feedback</span>

                  <a class="dropdown-item" href="#">
                    <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                  </a>
                </div>
              </div>
            </div>

            <div class="card-body">
              <span class="h1 d-block mb-3">175 <span class="h4 text-body">Invoices</span></span>

              <div class="progress rounded-pill">
                <div class="progress-bar" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: 2%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <hr class="my-0">

            <div class="card-body">
              <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                  <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="bi-chevron-left"></i>
                  </a>
                </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
                  <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="bi-chevron-right"></i>
                  </a>
                </span>

                <ul class="nav nav-segment nav-fill" id="invoicesStatusTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="true">
                      <span class="legend-indicator bg-primary"></span>Paid (162)
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">
                      <span class="legend-indicator bg-warning"></span>Pending (10)
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="declined-tab" data-bs-toggle="tab" href="#declined" role="tab" aria-controls="declined" aria-selected="true">
                      <span class="legend-indicator bg-danger"></span>Declined (3)
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
    <!-- End Content -->

    <!-- Footer -->

    <div class="footer">
      <div class="row justify-content-between align-items-center">
        <div class="col">
          <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
        </div>
        <!-- End Col -->

        <div class="col-auto">
          <div class="d-flex justify-content-end">
            <!-- List Separator -->
            <ul class="list-inline list-separator">
              <li class="list-inline-item">
                <a class="list-separator-link" href="#">FAQ</a>
              </li>

              <li class="list-inline-item">
                <a class="list-separator-link" href="#">License</a>
              </li>

              <li class="list-inline-item">
                <!-- Keyboard Shortcuts Toggle -->
                <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                  <i class="bi-command"></i>
                </button>
                <!-- End Keyboard Shortcuts Toggle -->
              </li>
            </ul>
            <!-- End List Separator -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>

    <!-- End Footer -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->


@endsection