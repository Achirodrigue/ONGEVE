@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-md-6">
            <div class="row">
                <div class="col-sm mb-2 mb-sm-0">
                  <h1 class="page-header-title">Ajout de produit dans @if($clientdevis->clientdevisinfo->isvalide) la facture @else le devis @endif de 
                    <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->client->nom }}</span>
                  </h1>
                </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row justify-content-end">
                @if($clientdevis->clientdevisprods()->count() > 0)
                  <div class="col-auto">
                    <a class="btn btn-primary" target="_blank" href="{{ route('pdf.devis.commande.client', $clientdevis) }}">
                      <i class="bi-file-earmark-arrow-down me-1"></i> PDF
                    </a>
                  </div>
                  <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('comptable.commande.client.detail', $clientdevis) }}">
                      <i class="bi-printer me-1"></i> Finalité
                    </a>
                  </div>
                @endif
                <div class="col-auto">
                  <a class="btn btn-primary" href="{{ route('comptable.commande.client.impaye') }}">
                    <i class="bi-arrow-return-left me-1"></i> Retour
                  </a>
                </div>
                <div class="col-auto">
                  <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduit">
                    <i class="bi-arrow-return-left me-1"></i> Ajouter un produit
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
            <li class="nav-item">
              <a class="nav-link" href="{{ route('commun.client.devis.survole.plafond.achat', $clientdevis) }}">
                Plafond @if($clientdevis->survolepf) Désactivé @else Activé @endif
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table mb-3">
          @if($clientdevis->clientdevisprods()->count() > 0)
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
                    <th scope="col" class="fw-bold text-black">{{ getprice($clientdevis->total_ttc) }}</th>
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
                  @foreach($clientdevis->clientdevisprods as $clientdevisprod)
                    <tr>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $clientdevisprod->produit->nom }}</h5>
                      </td>
                      <td class="text-danger">{{ $clientdevisprod->quantite }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisprod->prix_unitaire) }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisprod->prix_total) }}</td>
                      <td class="text-danger">{{ $clientdevisprod->produit->reference }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisProduitQtyUpdate{{ $clientdevisprod->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="{{ route('commun.produit.facture.destroy', $clientdevisprod) }}">
                            <i class="bi-trash dropdown-item-icon"></i>
                          </a>
                          @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR)
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisProduitRemise{{ $clientdevisprod->id }}">
                              <i class="bi-eye me-1"></i> Remise
                            </a>
                          @endif
                        </div>
                      </td>
                    </tr>

                    @include('include.produit.client-comptable.produit-devis2')
                    @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR) @include('include.produit.client.produit-devis3') @endif
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
          @php 
            $TP=0; 
            if($clientdevis->TDF == 1) {$TP=1;}
          @endphp
          @if(produits()->where('TP', $TP)->count() > 0)
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
                    <th>Produit</th>
                    <th>Prix unitaire (Fcfa)</th>
                    <th>Quantités en stock</th>
                    <th>Référence</th>
                    <th>Unité</th>
                    <th>Entrepôt</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1 ; @endphp
                  @foreach(produits()->where('TP', $TP) as $produit)
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
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
                      <td class="fw-bold">@if($produit->unité) {{ $produit->unite }} @else Aucune @endif</td>
                      <td class="fw-bold">{{ $produit->entrepotcateg->categorie->nom }} : {{ $produit->entrepotcateg->categorieprod->nom }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addProdDevis{{ $produit->id }}">
                            <i class="bi-plus me-1"></i> Ajouter
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editProdPrix{{ $produit->id }}">
                            <i class="bi-pencil-fill me-1"></i> Produit
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.produit.client-comptable.produit-devis1')
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
                    <span class="me-2">Page:</span>

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

    <!-- Modal -->
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
                  <div class="flex-grow-1">Nom</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Prix</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prix" class="visually-hidden form-label">Prix</label>
                <input type="text" name="prix" value="{{ old('prix') }}" class="form-control" id="prix" placeholder="Entrer un prix" aria-label="Entrer un prix" required>
                @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Contact</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="contact" class="visually-hidden form-label">Contact</label>
                <input type="number" name="contact" required minlength="8" value="{{ old('contact') }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact">
                @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Quantité du produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="email" class="visually-hidden form-label">Quantité du produit</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Role</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Role</label>
                <select name="role" class="form-control w-100" id="role" required>
                  <option value="0">Comptable</option>
                  <option value="1">Chef Comptable</option>
                </select>
                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Identifiant</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="identifiant" class="visually-hidden form-label">Identifiant</label>
                <input type="text" name="identifiant" value="{{ old('identifiant') }}" class="form-control" id="identifiant" placeholder="Entrer un identifiant" aria-label="Entrer un identifiant" required>
                @error('identifiant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Mot de passe</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="password" class="visually-hidden form-label">Mot de passe</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Entrer un mot de passe" aria-label="Entrer un mot de passe" required>
                <img src="{{ asset("auth/oeil/oeilc.png") }}" style="width: 18px; float: right; margin-top: -30px; margin-right: 3px;" id="eye" onClick="changer()">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
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

        <form method="POST" action="{{ route('geststock.produit.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-lg-8 mb-3 mb-lg-0">
              <!-- Card -->
              <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                  <h4 class="card-header-title">Information du produit </h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                  <!-- Form -->
                  <div class="mb-4">
                    <label for="productNameLabel" class="form-label">Nom du produit <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Products are the goods or services you sell."></i></label>
                    <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" id="productNameLabel" placeholder="Entrer un nom" required aria-label="Shirt, t-shirts, etc.">
                    @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                  </div>
                  <!-- End Form -->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="SKULabel" class="form-label">Prix du produit</label>
                        <input type="number" min="1" class="form-control" name="prix" value="{{ old('prix') }}" id="SKULabel" placeholder="Entrer le prix" required aria-label="eg. 348121032">
                        @error('prix') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="qtyStock" class="form-label">Quantité du produit</label>
                        <input type="number" min="1" class="form-control" name="qtyStock" value="{{ old('qtyStock') }}" id="qtyStock" placeholder="Entrer la quantité en stock" required aria-label="eg. 348121032">
                        @error('qtyStock') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'qtyStock' => $request->qtyStock,
            'TP' => $request->TP,
            'famille' => $request->famille,
            'reff' => $request->reff,
            'unite' => $request->unite,
            'entrepotcateg_id' => $request->entrepotcateg,
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-4">
                        <label for="image" class="form-label">Image du produit</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="image" placeholder="Entrer une image">
                        @error('image') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">Categorie produit</label>
                        <div class="tom-select-custom">
                          <select name="categorie" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            @foreach(categories() as $categorie)
                              <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>         

                  <div class="row">
                    <div class="col-sm-12">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="description" class="form-label">Description du produit</label>
                        <textarea name="description" class="form-control" id="description" value="{{ old('description') }}" placeholder="Entrer une description"></textarea>
                        @error('description') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Entrepôt et catégorie</h4>
                </div>

                <div class="card-body">
                  
                  <div class="row">
                    

                    

                  </div>

                  <div class="mb-2">
                    <a class="d-inline-block" href="javascript:;" data-bs-toggle="modal" data-bs-target="#productsAdvancedFeaturesModal">
                      <i class="bi-star-fill fs-4 text-warning me-1"></i> Set "Compare to" price
                    </a>
                  </div>

                  <a class="d-inline-block" href="javascript:;" data-bs-toggle="modal" data-bs-target="#productsAdvancedFeaturesModal">
                    <i class="bi-star-fill fs-4 text-warning me-1"></i> Bulk discount pricing
                  </a>

                  <hr class="my-4">

                  <label class="row form-check form-switch" for="availabilitySwitch1">
                    <span class="col-8 col-sm-9 ms-0">
                      <span class="text-dark">Availability <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Product availability switch toggler."></i></span>
                    </span>
                    <span class="col-4 col-sm-3 text-end">
                      <input type="checkbox" class="form-check-input" id="availabilitySwitch1">
                    </span>
                  </label>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h4 class="card-header-title">Organization</h4>
                </div>

                <div class="card-body">
                  <div class="mb-4">
                    <label for="vendorLabel" class="form-label">Vendor</label>

                    <input type="text" class="form-control" name="vendor" id="vendorLabel" placeholder="eg. Nike" aria-label="eg. Nike">
                  </div>

                  <div class="mb-4">
                    <label for="categoryLabel" class="form-label">Category</label>

                    <div class="tom-select-custom">
                      <select class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                "searchInDropdown": false,
                                "hideSearch": true,
                                "placeholder": "Select category"
                              }'>
                        <option value="Clothing">Clothing</option>
                        <option value="Shoes">Shoes</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>
                  </div>

                    <label for="collectionsLabel" class="form-label">Collections</label>

                    <div class="tom-select-custom">
                      <select class="js-select form-select" autocomplete="off" id="collectionsLabel" data-hs-tom-select-options='{
                                "searchInDropdown": false,
                                "hideSearch": true,
                                "placeholder": "Select collections"
                              }'>
                        <option value="Winter">Winter</option>
                        <option value="Spring">Spring</option>
                        <option value="Summer">Summer</option>
                        <option value="Autumn">Autumn</option>
                      </select>
                    </div>

                    <span class="form-text">Add this product to a collection so it’s easy to find in your store.</span>
                  </div>

                  <label for="tagsLabel" class="form-label">Tags</label>

                  <input type="text" class="form-control" id="tagsLabel" placeholder="Enter tags here" aria-label="Enter tags here">
                </div>
              </div>
            </div>
          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('geststock.produit.index') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>

@endsection