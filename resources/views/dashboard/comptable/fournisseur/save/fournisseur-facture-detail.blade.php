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

            <h1 class="page-header-title">Details de la Facture du fournisseur <span class="text-warning">{{ $fournisseurfacture->fournisseur->nom }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('comptable.fournisseur.facture.invalide') }}">
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
          <!-- <div class="d-flex justify-content-end d-print-none gap-3 mb-5">
            <a class="btn btn-white" href="#" target="_blank">
              <i class="bi-file-earmark-arrow-down me-1"></i> PDF
            </a>
          </div> -->
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
                    <h2>Facture #</h2>
                    <span class="d-block">{{ $fournisseurfacture->numero_facture }}</span>
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
                  <h4>{{ $fournisseurfacture->fournisseur->nom }}</h4>
                  <address>
                    {{ $fournisseurfacture->fournisseur->contact }}<br>
                    {{ $fournisseurfacture->fournisseur->email }}<br>
                    {{ $fournisseurfacture->fournisseur->adresse_postale }}<br>
                  </address>
                </div>
                <!-- End Col -->

                <div class="col-md text-md-end">
                  <dl class="row">
                    <dt class="col-sm-8">Total à verser:</dt>
                    <dd class="col-sm-4">{{ getprice($fournisseurfacture->total_ttc) }} F</dd>
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
                      <th class="text-center">Quantité</th>
                      <th class="text-center">Prix unitaire (Fcfa)</th>
                      <th class="table-text-end">Total (Fcfa)</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($fournisseurfacture->fournisseurfactureprods as $fournisseurfactureprod)
                      <tr>
                        <td>
                          <h5 class="text-inherit mb-0">{{ $fournisseurfactureprod->produit }}</h5>
                        </td>
                        <td class="text-center">{{ $fournisseurfactureprod->quantite }}</td>
                        <td class="text-center">{{ getprice($fournisseurfactureprod->prix_unitaire) }}</td>
                        <td class="table-text-end">{{ getprice($fournisseurfactureprod->prix_total) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- End Table -->

              <hr class="my-5">

              <div class="mb-3">
                <h3>Merci !</h3>
                <p>
                  @if($fournisseurfacture->isvalide)
                    Cette facture à été approuvé
                  @else
                    Cette facture est en cours de traitement
                  @endif
                </p>
              </div>

              <!-- <p class="small mb-0">&copy; 2021 Htmlstream.</p> -->
            </div>
          </div>
          <!-- End Card -->
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

    <!-- End Footer -->
  </main>


@endsection