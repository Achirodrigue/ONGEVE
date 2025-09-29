@extends('dashboard.geststock.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">
              Bilans de la quantité des produits sortie du  
              @if($startDate)
                  du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
              @endif
              @if($endDate)
                  au {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
              @endif
              @if($TS)
                <span class="text-danger">- Type : {{ ucfirst($TS) }} </span>
              @endif
              <span class="badge bg-soft-dark text-dark ms-2">{{ $produits->count() }}</span>
            </h1>
            <!-- <h3 class="page-header-title"><span class="text-danger"></span></h3> -->
          </div>

          <div class="col-auto">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#choixPeriodeBilanFacture">
              <i class="bi-person-plus-fill me-1"></i> Nouvelle periode
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
                Bilan des produits
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
          <div class="card-header card-header-content-md-between">
            <h4 class="card-header-title">Bilan des {{ ucfirst($TS) }}s
              @if($startDate)
                  du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
              @endif
              @if($endDate)
                  au {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
              @endif
            </h4>
          </div>
          <!-- End Header -->

          @if($produits->count() > 0)
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un produit" aria-label="Rechercher un produit">
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
                    <th>N°</th>
                    <th>Produit</th>
                    <th>Total Sortie</th>
                    <th>Description</th>
                    <th>Référence</th>
                    <th>Prix unitaire</th>
                    <th>Quantités en stock</th>
                    <th>Entrepôt</th>
                    <th>N°</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1; @endphp
                  @foreach($produits as $produitSend)
                    @php $a = $n; @endphp
                    @php $produit = RechercheProduit($produitSend); @endphp
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                      </td>
                      <td class="fw-bold">{{ $produitSend->total_vendu }}</td>
                      <td class="fw-bold">
                        @if($produit->description)
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoDescProduit{{ $produit->id }}">
                              <i class="bi-eye me-1"></i>Voir
                            </a>
                          </div>
                        @else Aucune @endif
                      </td>
                      <td class="text-danger">{{ $produit->reference }}</td>
                      <td class="fw-bold">{{ getpricefr($produit->prix) }}</td>
                      <td class="text-danger">@if($produit->qtyStock) {{ $produit->qtyStock }} @else 0 @endif @if($qtyC > 0) ({{ $qtyC }} en commande) @endif</td>
                      <td class="fw-bold">{{ $produit->entrepotcateg->categorie->nom }}</td>
                      <td class="fw-bold">{{ $a }}</td>
                    </tr>
                    
                    @include('include.produit.produit')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
              @include('dashboard.IncludePage.commun.pagination.pagination')
            <!-- End Footer -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit trouvé pour cette periode sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif   
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection