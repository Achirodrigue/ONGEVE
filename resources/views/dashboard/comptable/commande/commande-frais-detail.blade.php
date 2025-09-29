@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-md-8">
            <div class="row">
              <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title">Details des frais de la facture <span class="text-danger">{{ $clientdevis->numero_devis }}</span> de <span class="text-danger">{{ $clientdevis->client->nom }}</span> 
                </h1>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="row justify-content-end">
              <div class="col-auto mb-2">
                <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addclientdevisfraisdetail">
                  <i class="bi-person-plus-fill me-1"></i> Ajouter un frais
                </a>
              </div>
              <div class="col-auto mb-2">
                <a class="btn btn-primary" href="{{ route('comptable.commande.client.impaye') }}">
                  <i class="bi-arrow-return-left me-1"></i> Retour
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#">Détails des frais de facture</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table mb-3">
          @if($clientdevisfraisdetails->count() > 0)
            <!-- Table -->
            <div class="table-responsive datatable-custom">
              <table class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 12,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'
                >
                <thead class="thead-light">
                  <tr>
                    <th colspan="3" scope="col" class="fw-bold text-black">Montant des frais de la facture (Fcfa)</th>
                    <th scope="col" class="fw-bold text-black">{{ getprice($clientdevis->frais) }}</th>
                  </tr>
                  <tr>
                    <th>N°</th>
                    <th>Designation</th>
                    <th>Montant (Fcfa)</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php $n = 1 ; @endphp
                  @foreach($clientdevisfraisdetails as $clientdevisfraisdetail)
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td class="fw-bold">{{ $clientdevisfraisdetail->nom }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisfraisdetail->montant) }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editclientdevisfraisdetail{{ $clientdevisfraisdetail->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteclientdevisfraisdetail{{ $clientdevisfraisdetail->id }}">
                            <i class="bi-trash dropdown-item-icon"></i>
                          </a>
                        </div>
                      </td>
                    </tr>

                    @include('include.commun.frais-detail')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h4 class="fw-bold mb-0 text-center">Désolé! Aucun detail de frais n'a été associé à cette facture</h4>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->

    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <div class="modal fade" id="addclientdevisfraisdetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une designation de frais</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.client.devis.frais.detail.store', $clientdevis) }}" enctype="multipart/form-data">
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
                <label for="nom" class="visually-hidden form-label">Désignation *</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer une désignation" aria-label="Entrer une désignation" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Montant du frais *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="montant" class="visually-hidden form-label">Montant du frais *</label>
                <input type="number" min="1" name="montant" value="{{ old('montant') }}" class="form-control" required id="montant" placeholder="Entrer le montant du frais" aria-label="Entrer le montant du frais">
                @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
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


@endsection