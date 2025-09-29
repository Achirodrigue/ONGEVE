@extends('dashboard.geststock.layout.app')
@section('body')


  @include('include.message.dashboard')
  @include('include.geststock.fournisseur.fournisseurfacture')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-md-6">
            <div class="row">
                <div class="col-sm mb-2 mb-sm-0">
                  <h1 class="page-header-title">Ajout de produit dans la facture du fournisseur
                    <span class="badge bg-soft-dark text-dark">{{ $fournisseurfacture->fournisseur->nom }}</span>
                  </h1>
                </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row justify-content-end">
                <div class="col-auto">
                  @if($fournisseurfacture->fournisseurfactureprods()->count() > 0)
                    <a class="btn btn-white mb-2" target="_blank" href="{{ route('pdf.devis.commande.client', $fournisseurfacture) }}">
                      <i class="bi-file-earmark-arrow-down me-1"></i> PDF
                    </a>
                    <a class="btn btn-white mb-2" href="{{ route('comptable.commande.client.detail', $fournisseurfacture) }}">
                      <i class="bi-printer me-1"></i> Finalité
                    </a>
                  @endif
                  <a class="btn btn-white mb-2" href="{{ route('comptable.commande.client.impaye') }}">
                    <i class="bi-arrow-return-left me-1"></i> Retour
                  </a>
                  <a class="btn btn-white mb-2" data-bs-toggle="modal" data-bs-target="#addproduit">
                    <i class="bi-person-plus-fill me-1"></i> Ajouter un produit
                  </a>
                  <a class="btn btn-white mb-2" href="#" data-bs-toggle="modal" data-bs-target="#editFF{{ $fournisseurfacture->id }}">
                    <i class="bi-pencil-fill me-1"></i> Modifier
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
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Etape 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Etape 2</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table mb-3">
          @if($fournisseurfacture->fournisseurfactureprods()->count() > 0)
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
                    <th colspan="5" scope="col" class="fw-bold text-black">Inventaire du Total à payer (Fcfa)</th>
                    <th scope="col" class="fw-bold text-black">{{ getprice($fournisseurfacture->total_ttc) }}</th>
                  </tr>
                  <tr>
                    <th>Produit</th>
                    <!-- <th>Description</th> -->
                    <th>Quantité</th>
                    <th>Prix unitaire (Fcfa)</th>
                    <th>Prix Total (Fcfa)</th>
                    <th>Référence</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fournisseurfacture->fournisseurfactureprods as $fournisseurfactureprod)
                    <tr>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $fournisseurfactureprod->produit->nom }}</h5>
                      </td>
                      <td class="text-danger">{{ $fournisseurfactureprod->quantite }}</td>
                      <td class="fw-bold">{{ getprice($fournisseurfactureprod->prix_unitaire) }}</td>
                      <td class="fw-bold">{{ getprice($fournisseurfactureprod->prix_total) }}</td>
                      <td class="text-danger">{{ $fournisseurfactureprod->produit->reference }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#FFProduitQtyUpdate{{ $fournisseurfactureprod->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="{{ route('geststock.fournisseur.facture.destroy.produit', $fournisseurfactureprod) }}">
                            <i class="bi-trash dropdown-item-icon"></i>
                          </a>
                        </div>
                      </td>
                    </tr>

                    @include('include.geststock.fournisseur.fournisseurfactureprod')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h4 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été associé à cette facture</h4>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div class="card card-table">
          @if(produits()->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un produit" aria-label="Search users">
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
                    <th>N°</th>
                    <th>Ajout</th>
                    <th>Produit</th>
                    <th>Prix unitaire (Fcfa)</th>
                    <th>Quantités en stock</th>
                    <th>Référence</th>
                    <th>Unité</th>
                    <th>Entrepôt</th>
                    <th>Actions</th>
                    <th>N°</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1 ; @endphp
                  @foreach(produits() as $produit)
                  @php $a = $n ; @endphp

                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addProdFF{{ $produit->id }}">
                            <i class="bi-plus me-1"></i> Ajouter
                          </a>
                        </div>
                      </td>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                      </td>
                      <td class="fw-bold">{{ getprice($produit->prix) }}</td>
                      @php 
                        $qtyC = 0;
                        foreach($produit->clientdevisprods as $clientdevisprod)
                        {
                          if($clientdevisprod->clientdevis->clientdevisinfo->isvalide && !$clientdevisprod->clientdevis->clientdevisinfo->livraison)
                          {
                            $qtyC += $clientdevisprod->quantite;
                          }
                        }
                      @endphp
                      <td class="text-danger">@if($produit->qtyStock > 0) {{ $produit->qtyStock }} @else 0 @endif @if($qtyC > 0) ({{ $qtyC }} en commande) @endif</td>
                      <td class="text-danger">{{ $produit->reference }}</td>
                      <td class="fw-bold">@if($produit->unite) {{ $produit->unite }} @else Aucune @endif</td>
                      <td class="fw-bold">{{ $produit->entrepotcateg->categorie->nom }} : {{ $produit->entrepotcateg->categorieprod->nom }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addProdFF{{ $produit->id }}">
                            <i class="bi-plus me-1"></i> Ajouter
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ $a }}</td>
                    </tr>

                    @include('include.geststock.fournisseur.produit-facture')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit de <span class="text-danger">@if($clientdevis->TD) prestation de service @else vente @endif</span> n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <div class="modal fade" id="addproduit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau comptable</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('commun.produit.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom du produit</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Prix du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prix" class="visually-hidden form-label">Prix du produit</label>
                <input type="number" name="prix" value="{{ old('prix') }}" class="form-control" id="prix" placeholder="Entrer un prix" aria-label="Entrer un prix" required>
                @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Quantité du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="qtyStock" class="visually-hidden form-label">Quantité du produit</label>
                <input type="number" name="qtyStock" required value="{{ old('qtyStock') }}" class="form-control" id="qtyStock" placeholder="Entrer une quantité">
                @error('qtyStock') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <!-- <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Référence du produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reference" class="visually-hidden form-label">Référence du produit</label>
                <input type="text" name="reference" value="{{ old('reference') }}" class="form-control" id="reference" placeholder="Entrer une reference">
                @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div> -->

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Catégorie du produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Catégorie du produit</label>
                <select name="entrepotcateg" class="form-control w-100" id="role" required>
                  @foreach(entrepotcategs() as $entrepotcateg)
                    <option value="{{ $entrepotcateg->id }}">{{ $entrepotcateg->categorie->nom }} : {{ $entrepotcateg->categorieprod->nom }}</option>
                  @endforeach
                </select>
                @error('entrepotcateg') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Type de produit *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Type de produit</label>
                <select name="TP" class="form-control w-100" id="role" required>
                    <option value="0">Vente</option>
                    <option value="1">Location</option>
                </select>
                @error('TP') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Unité de vente ou de prestation *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Unité de vente ou de prestation</label>
                <select name="unite" class="form-control w-100" id="role">
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
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Famille du produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="famille" class="visually-hidden form-label">Famille du produit</label>
                <input type="text" name="famille" value="{{ old('famille') }}" class="form-control" id="famille" placeholder="Entrer une famille">
                @error('famille') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Reférence du fournisseur</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reff" class="visually-hidden form-label">Reférence du fournisseur</label>
                <input type="text" name="reff" value="{{ old('reff') }}" class="form-control" id="reff" placeholder="Entrer une Reférence">
                @error('reff') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
          </div>

          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection