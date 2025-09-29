@extends('dashboard.commercial.layout.app')
@section('body')

<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Évolution des factures du commercial <span class="text-danger">{{ $commercial->nom }} {{ $commercial->prenom }}</span></h1>
          </div>
           
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('commercial.commercial.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
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
              <a class="nav-link active" href="#">
                Factures
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table mb-5">
          <!-- Header -->
          <div class="card-header">
            <div>
              {{-- Sélecteur d'année --}}
              <form method="GET" action="{{ route('commercial.commercial.statistique.annee', $commercial) }}" class="mb-4">
                  <label for="year">Choisir l'année :</label>
                  <select name="year" id="year" onchange="this.form.submit()" class="form-control w-auto d-inline-block">
                      @for ($y = $startYear; $y <= $currentYear; $y++)
                          <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>{{ $y }}</option>
                      @endfor
                  </select>
              </form>
            </div>
            <div>
              {{-- Graphique --}}
              <canvas id="devisChart"></canvas>
            </div>
          </div>
          <!-- End Header -->
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div class="card card-table">
          <!-- Header -->
          <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0 w-100">
              <form>
                <!-- Search -->
                <div class="input-group input-group-merge input-group-flush">
                  <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                  </div>
                  <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                </div>
                <!-- End Search -->
              </form>
            </div>
            
          </div>
          <!-- End Header -->

          <!-- Table -->
          <div class="table-responsive datatable-custom">
            <table id="datatable" class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
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
                }'>
              <thead class="thead-light">
                <tr>
                  <th>Mois</th>
                  <th>Nombre de devis</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($chartData as $monthName => $total)
                    @php
                        $monthNumber = \Carbon\Carbon::parse($monthName)->month;
                        // Obtenir le nom en français
                        \Carbon\Carbon::setLocale('fr');
                        $monthNameFr = \Carbon\Carbon::createFromDate(null, $monthNumber, 1)->translatedFormat('F');
                    @endphp
                    <tr>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-warning btn-sm">
                            {{ $monthNameFr }}
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ $total }}</td>
                      <td class="text-center fw-bold">
                        <div class="btn-group" role="group">
                          @if($total > 0)
                            <a class="btn btn-white btn-sm" href="{{ route('commercial.commercial.statistique.mois', [$commercial, $selectedYear, $monthNumber]) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          @else Aucun devis @endif
                        </div>
                      </td>
                    </tr>
                @endforeach
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
                    <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
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
                  <span id="datatableWithPaginationInfoTotalQty"></span>
                </div>
              </div>
              <!-- End Col -->

              <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                  <!-- Pagination -->
                  <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                </div>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- End Footer -->
      </div>
      <!-- End Card -->

    </div>
    <!-- End Content -->
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = @json(array_values($chartData));
    const labels = @json(array_keys($chartData));

    new Chart(document.getElementById('devisChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de devis',
                data: chartData,
                borderWidth: 2,
                borderColor: 'blue',
                fill: false
            }]
        }
    });
</script>
            


@endsection