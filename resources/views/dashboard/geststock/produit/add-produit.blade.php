@extends('dashboard.geststock.layout.app')
@section('body')



  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Ajouter un nouveau produit </h1>
          </div>

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('geststock.produit.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

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
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="SKULabel" class="form-label">Prix du produit</label>
                        <input type="number" min="1" class="form-control" name="prix" value="{{ old('prix') }}" id="SKULabel" placeholder="Entrer le prix" required aria-label="eg. 348121032">
                        @error('prix') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <!-- <div class="col-md-6">
                      <div class="mb-4">
                        <label for="qtyStock" class="form-label">Quantité du produit</label>
                        <input type="number" min="1" class="form-control" name="qtyStock" value="{{ old('qtyStock') }}" id="qtyStock" placeholder="Entrer la quantité en stock" aria-label="eg. 348121032">
                        @error('qtyStock') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div> -->
                  </div>

                  <!--
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
                  -->

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="unite" class="form-label">Unité de vente ou de prestation</label>
                        <div class="tom-select-custom">
                          <select name="unite" class="js-select form-select" autocomplete="off" id="unite" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="">Aucune</option>
                            <option value="L">L</option>
                            <option value="KG">KG</option>
                            <option value="Pièce">Pièce</option>
                            <option value="Carton">Carton</option>
                            <option value="Boîte">Boîte</option>
                            <option value="Sac">Sac</option>
                            <option value="Paquet">Paquet</option>
                          </select>
                          @error('unite') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
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
                <!-- Body -->
              </div>
              <!-- End Card -->
            </div>
            <!-- End Col -->

            <div class="col-lg-4">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Entrepôt et famille</h4>
                </div>

                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">famille du produit</label>
                        <div class="tom-select-custom">
                          <select name="entrepotcateg" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            @foreach(entrepotcategs() as $entrepotcateg)
                              <option value="{{ $entrepotcateg->id }}">{{ $entrepotcateg->categorie->nom }} : {{ $entrepotcateg->categorieprod->nom }}</option>
                            @endforeach
                          </select>
                          @error('entrepotcateg') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>

                    <!-- <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="famille" class="form-label">Famille du produit</label>
                        <input type="text" class="form-control" name="famille" value="{{ old('famille') }}" id="famille" placeholder="Entrer la famille du produit" required aria-label="eg. 348121032">
                        @error('famille') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div> -->

                    <!-- <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="reff" class="form-label">Reférence du fournisseur</label>
                        <input type="text" class="form-control" name="reff" value="{{ old('reff') }}" id="reff" placeholder="Entrer la reférence du fournisseur" aria-label="eg. 348121032">
                        @error('reff') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div> -->

                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">Type de produit</label>
                        <div class="tom-select-custom">
                          <select name="TP" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="0">Vente</option>
                            <option value="1">Location</option>
                          </select>
                          @error('TP') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="image" class="form-label">Image du produit</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="image" placeholder="Entrer une image du produit" >
                        @error('image') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <!-- <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="image" class="form-label">Image du produit</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="image" placeholder="Entrer une image" required>
                        @error('image') <span class="text-danger"> {{ $message }} </span> @enderror
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
                  <!-- End Form Switch -->
                </div>
              </div>

              <!-- <div class="card">
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
              </div> -->
            </div>
          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <!-- Card -->
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('geststock.produit.index') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>
                  <!-- End Col -->

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <button type="submit" class="btn btn-primary">Ajouter</button>
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