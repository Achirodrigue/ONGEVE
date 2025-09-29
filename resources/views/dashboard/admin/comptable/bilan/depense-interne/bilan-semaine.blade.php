@extends('dashboard.admin.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Bilans par semaine des dépenses internes effectuer sur la plateforme <span class="badge bg-soft-dark text-dark ms-2">{{ $depenses->count() }}</span></h1>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
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

          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#">Bilans mensuels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.mois.depense.interne') }}" tabindex="-1" aria-disabled="true">Bilans par mois</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.trimestre.depense.interne') }}" tabindex="-1" aria-disabled="true">Bilans trimestriels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.annee.depense.interne') }}" tabindex="-1" aria-disabled="true">Bilans annuels</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      @if($depenses->count() > 0)
        @php $n = 1; @endphp
        @foreach ($depenses as $semaine => $factures)
          <div class="card card-table mb-5">
              <!-- Header -->
              <div class="card-header card-header-content-md-between">
                <h4 class="card-header-title">{{ $semaine }}</h4>
              </div>
              <!-- End Header -->

              @if($factures->count() > 0)
                <div class="card-header card-header-content-md-between">
                  <div class="mb-2 mb-md-0 w-100">
                    <form>
                      <!-- Search -->
                      <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-search"></i>
                        </div>
                        <input id="datatable{{$n}}Search" type="search" class="form-control" placeholder="Rechercher une facture" aria-label="Search users">
                      </div>
                      <!-- End Search -->
                    </form>
                  </div>
                </div>

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                  <table id="datatable" class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                      "columnDefs": [{
                          "targets": [0],
                          "orderable": false
                        }],
                      "order": [],
                      "info": {
                        "totalQty": "#datatable{{$n}}WithPaginationInfoTotalQty"
                      },
                      "search": "#datatable{{$n}}Search",
                      "entries": "#datatable{{$n}}Entries",
                      "pageLength": 12,
                      "isResponsive": false,
                      "isShowPaging": false,
                      "pagination": "datatable{{$n}}Pagination"
                    }'>
                    <thead class="thead-light">
                      <tr>
                        <th>N°</th>
                        <th>Date</th>
                        <th>Designation</th>
                        <th>Montant sorti (Fcfa)</th>
                      </tr>
                    </thead>

                    <tbody>
                      @php $i = 1 ; @endphp
                      @forelse($factures as $depense)
                        <tr>
                          <td class="fw-bold">{{ $i++ }}</td>
                          <td class="fw-bold">{{ $depense->date }}</td>
                          <td class="fw-bold">{{ $depense->designation }}</td>
                          <td class="fw-bold">{{ getprice($depense->montant) }}</td> 
                        </tr>
                      @empty
                          <tr><td colspan="3">Aucune Depense interne</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                  <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm mb-2 mb-sm-0">
                      <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Pagination:</span>

                        <!-- Select -->
                        <div class="tom-select-custom">
                          <select id="datatable{{$n}}Entries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true
                                  }'>
                            <option value="12">12</option>
                            <option value="14" selected>14</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
                          </select>
                        </div>
                        <!-- End Select -->

                        <span class="text-secondary me-2">of</span>

                        <!-- Pagination Quantity -->
                        <span id="datatable{{$n}}WithPaginationInfoTotalQty"></span>
                      </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                      <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        <nav id="datatable{{$n}}Pagination" aria-label="Activity pagination"></nav>
                      </div>
                    </div>
                    <!-- End Col -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- End Footer -->

              @else
                  <!-- Header -->
                  <div class="card-header card-header-content-md-between p-4">
                    <h5 class="fw-bold mb-0 text-center">Désolé! Aucune dépense interne disponible pour cette semaine sur la plateforme</h5>
                  </div>
                  <!-- End Header -->
              @endif   
          </div>
          @php $n++; @endphp
        @endforeach
      @else
          <!-- Header -->
          <div class="card-header card-header-content-md-between p-4">
            <h3 class="fw-bold mb-0 text-center">Désolé! Aucune dépense interne disponible sur la plateforme</h3>
          </div>
          <!-- End Header -->
      @endif
      <!-- End Card -->

    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->


@endsection