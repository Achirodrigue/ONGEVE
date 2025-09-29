@extends('dashboard.magasinier.layout.app')
@section('body')



  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Modifier le produit <span class="badge bg-soft-dark text-dark ms-2">{{ $produit->nom }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('magasinier.produit.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('magasinier.produit.update', $produit) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="row">
            <div class="col-lg-8 mb-3 mb-lg-0">
              <!-- Card -->
              <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                  <div class="row justify-content-md-between" style="align-items: center;">
                    <div class="col-md-5 text-md-start mb-3">
                      <h2 class="card-header-title">Information du produit</h2>
                    </div>
                    <!-- <div class="col-md-4 mb-3 mb-md-0">
                      <label class="form-check form-check-dashed" for="logoUploader">
                        <img id="logoImg" class="avatar avatar-xl avatar-4x3 avatar-centered h-100 mb-2" src="{{ asset(Storage::url($produit->image)) }}" alt="Image Description" data-hs-theme-appearance="default">
                        <img id="logoImg" class="avatar avatar-xl avatar-4x3 avatar-centered h-100 mb-2" src="{{ asset("dashboard/assets/svg/illustrations-light/oc-browse-file.svg") }}" alt="Image Description" data-hs-theme-appearance="dark">
                      </label>
                    </div> -->
                  </div>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                  <!-- Form -->
                  <div class="mb-4">
                    <label for="productNameLabel" class="form-label">Nom du produit <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Products are the goods or services you sell."></i></label>
                    <input type="text" class="form-control" name="nom" value="{{ $produit->nom }}" id="productNameLabel" placeholder="Entrer un nom" required aria-label="Shirt, t-shirts, etc.">
                    @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                  </div>
                  <!-- End Form -->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="SKULabel" class="form-label">Prix du produit</label>
                        <input type="number" min="1" class="form-control" name="prix" value="{{ $produit->prix }}" id="SKULabel" placeholder="Entrer le prix" required aria-label="eg. 348121032">
                        @error('prix') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="qtyStock" class="form-label">Quantité du produit</label>
                        <input type="number" class="form-control" value="{{ $produit->qtyStock }}" id="qtyStock" placeholder="Entrer la quantité en stock" readonly>
                        @error('qtyStock') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="description" class="form-label">Description du produit</label>
                        <textarea name="description" class="form-control" id="description" required>{{ $produit->description }}</textarea>
                        @error('description') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                </div>
                <!-- Body -->
              </div>
              <!-- End Card -->
            </div>
            <!-- End Col -->

            <div class="col-lg-4">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Entrepôt</h4>
                </div>

                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">Entrepôt du produit</label>
                        <div class="tom-select-custom">
                          <select name="categorie" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="{{ $produit->categorie->id }}">{{ $produit->categorie->nom }}</option>
                            @foreach(categories()->where('id','!=',$produit->categorie->id) as $categorie)
                              <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">Type de produit</label>
                        <div class="tom-select-custom">
                          <select name="categorie" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            @if($produit->TP)
                              <option value="1">Prestation de service</option>
                              <option value="0">Vente</option>
                            @else
                              <option value="0">Vente</option>
                              <option value="1">Prestation de service</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="image" class="form-label">Nouvelle Image (facultative)</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Entrer une image" required>
                      </div>
                    </div> -->
                  </div>
                  <!-- End Form -->

                  <!-- <div class="mb-2">
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
                  </label> -->
                </div>
              </div>

            </div>
          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <!-- Card -->
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('magasinier.produit.index') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>
                  <!-- End Col -->

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Row -->
              </div>
            </div>
            <!-- End Card -->
          </div>
      </form>

    </div>
    <!-- End Content -->
  </main>



@endsection