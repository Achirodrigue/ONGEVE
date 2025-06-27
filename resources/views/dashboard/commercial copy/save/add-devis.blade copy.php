@extends('dashboard.commercial.layout.app')
@section('body')



  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Ajouter un devis</h1>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('commercial.devis.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Information du client</h4>
                </div>

                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">Categorie produit</label>
                        <div class="tom-select-custom">
                          <select id="client" onchange="toggleInput()"  name="client" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="Nouveau">Nouveau client</option>
                            @foreach(clients() as $client)
                              <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }} : {{ $client->contact }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row" id="addClient" style="display:block;">
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="nom" class="form-label">Nom du client</label>
                          <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" id="nom" placeholder="Entrer un nom" required>
                          @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="prenom" class="form-label">Prénom du client</label>
                          <input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" id="prenom" placeholder="Entrer un prénom" required>
                          @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="email" class="form-label">Email du client</label>
                          <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Entrer un email" required>
                          @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="contact" class="form-label">Contact du client</label>
                          <input type="number" minlength="8" maxlength="10" class="form-control" name="contact" value="{{ old('contact') }}" id="contact" placeholder="Entrer un contact" required>
                          @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-lg-8 mb-3 mb-lg-0">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Information du devis </h4>
                </div>

                <div class="card-body">
                  <div class="mb-4">
                    <label for="productNameLabel" class="form-label">Date d'expiration <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Products are the goods or services you sell."></i></label>
                    <input type="text" class="form-control" name="date_expiration" value="{{ old('date_expiration') }}" id="productNameLabel" placeholder="Entrer une date d'expiration" required aria-label="Shirt, t-shirts, etc.">
                    @error('date_expiration') <span class="text-danger"> {{ $message }} </span> @enderror
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="mode_paiement" class="form-label">Mode de paiement</label>
                        <input type="text" class="form-control" name="mode_paiement" value="{{ old('mode_paiement') }}" id="SKULabel" placeholder="Entrer un Mode de paiement" required aria-label="eg. 348121032">
                        @error('mode_paiement') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="frais" class="form-label">Frais de livraison</label>
                        <input type="text" class="form-control" name="frais" value="{{ old('frais') }}" id="frais" placeholder="Entrer les frais de livraison" required aria-label="eg. 348121032">
                        @error('frais') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="condition_validite" class="form-label">Condition de validité</label>
                        <input type="text" class="form-control" name="condition_validite" value="{{ old('condition_validite') }}" id="SKULabel" placeholder="Entrer une condition de validité" required aria-label="eg. 348121032">
                        @error('condition_validite') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="delai_livraison" class="form-label">Délai de livraison</label>
                        <input type="text" class="form-control" name="delai_livraison" value="{{ old('delai_livraison') }}" id="delai_livraison" placeholder="Entrer un Délai de livraison" required aria-label="eg. 348121032">
                        @error('delai_livraison') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="note_condition" class="form-label">Note / Condition</label>
                        <textarea name="note_condition" class="form-control" id="note_condition" value="{{ old('note_condition') }}" placeholder="Entrer une note" required></textarea>
                        @error('note_condition') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('magasinier.produit.index') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <button type="button" class="btn btn-ghost-light">Discard</button>
                      <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>

    </div>
    <div class="content container-fluid">
      <div class="row">
        <div class="col-lg-9 mb-5 mb-lg-0">
          <form method="POST" action="{{ route('magasinier.produit.store') }}" enctype="multipart/form-data">
          @csrf
          <!-- Card -->
          <div class="card card-lg">
            <!-- Body -->
            <div class="card-body">
              <div class="row justify-content-md-between">
                <div class="col-md-4 mb-3 mb-md-0">
                  <!-- Logo -->
                  <label class="form-check form-check-dashed" for="logoUploader">
                    <img id="logoImg" class="avatar avatar-xl avatar-4x3 avatar-centered h-100 mb-2" src="{{ asset("dashboard/assets/svg/illustrations/oc-browse-file.svg") }}" alt="Image Description" data-hs-theme-appearance="default">
                    <img id="logoImg" class="avatar avatar-xl avatar-4x3 avatar-centered h-100 mb-2" src="{{ asset("dashboard/assets/svg/illustrations-light/oc-browse-file.svg") }}" alt="Image Description" data-hs-theme-appearance="dark">

                    <span class="d-block">Browse your file here</span>

                    <input type="file" class="js-file-attach form-check-input" id="logoUploader" data-hs-file-attach-options='{
                              "textTarget": "#logoImg",
                              "mode": "image",
                              "targetAttr": "src",
                              "allowTypes": [".png", ".jpeg", ".jpg"]
                           }'>
                  </label>
                  <!-- End Logo -->
                </div>
                <!-- End Col -->

                <div class="col-md-5 text-md-end">
                  <h2>Invoice #</h2>

                  <!-- Form -->
                  <div class="d-grid d-md-flex justify-content-md-end mb-2 mb-md-4">
                    <input type="text" class="form-control w-auto" placeholder="" aria-label="" value="0982131">
                  </div>
                  <!-- End Form -->

                  <textarea class="form-control" placeholder="Who is this invoice from?" id="invoiceAddressFromLabel" aria-label="Who is this invoice from?" rows="3"></textarea>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <hr class="my-5">

              <div class="row mb-3">
                <div class="col-md-5">
                  <!-- Form -->
                  <div class="mb-4">
                    <label for="invoiceAddressToLabel" class="form-label">Bill to:</label>
                    <textarea class="form-control" placeholder="Who is this invoice from?" id="invoiceAddressToLabel" aria-label="Who is this invoice from?" rows="3"></textarea>
                  </div>
                  <!-- End Form -->
                </div>
                <!-- End Col -->

                <div class="col-md-7 align-self-md-end">
                  <!-- Form -->
                  <div class="mb-4">
                    <dl class="row align-items-sm-center mb-3">
                      <dt class="col-md text-sm-end mb-2 mb-sm-0">Invoice date:</dt>
                      <dd class="col-md-auto mb-0">
                        <!-- Flatpickr -->
                        <div id="invoiceDateFlatpickr" class="js-flatpickr flatpickr-custom" data-hs-flatpickr-options='{
                              "appendTo": "#invoiceDateFlatpickr",
                              "dateFormat": "d/m/Y",
                              "wrap": true
                            }'>
                          <input type="text" class="flatpickr-custom-form-control form-control" placeholder="Select dates" data-input value="29/06/2020">
                        </div>
                        <!-- End Flatpickr -->
                      </dd>
                    </dl>

                    <dl class="row align-items-sm-center">
                      <dt class="col-md text-sm-end mb-2 mb-sm-0">Due date:</dt>
                      <dd class="col-md-auto mb-0">
                        <!-- Flatpickr -->
                        <div id="invoiceDueDateFlatpickr" class="js-flatpickr flatpickr-custom" data-hs-flatpickr-options='{
                              "appendTo": "#invoiceDueDateFlatpickr",
                              "dateFormat": "d/m/Y",
                              "wrap": true
                            }'>
                          <input type="text" class="flatpickr-custom-form-control form-control" placeholder="Select dates" data-input value="29/06/2020">
                        </div>
                        <!-- End Flatpickr -->
                      </dd>
                    </dl>
                  </div>
                  <!-- End Form -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <div class="js-add-field" data-hs-add-field-options='{
                      "template": "#addInvoiceItemTemplate",
                      "container": "#addInvoiceItemContainer",
                      "defaultCreated": 0
                    }'>
                <!-- Title -->
                <div class="bg-light border-bottom p-2 mb-3">
                  <div class="row">
                    <div class="col-sm-5">
                      <h6 class="card-title text-cap">Item</h6>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-3 d-none d-sm-inline-block">
                      <h6 class="card-title text-cap">Quantity</h6>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-2 d-none d-sm-inline-block">
                      <h6 class="card-title text-cap">Rate</h6>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-2 d-none d-sm-inline-block">
                      <h6 class="card-title text-cap">Amount</h6>
                    </div>
                    <!-- End Col -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- End Title -->

                <!-- Content -->
                <div class="row">
                  <div class="col-md-5">
                    <input type="text" class="form-control mb-3" placeholder="Item name" aria-label="Item name">
                    <input type="text" class="form-control mb-3" placeholder="Description" aria-label="Description">
                  </div>
                  <!-- End Col -->

                  <div class="col-12 col-sm-auto col-md-3">
                    <!-- Quantity -->
                    <div class="quantity-counter mb-3">
                      <div class="js-quantity-counter row align-items-center">
                        <div class="col">
                          <input class="js-result form-control form-control-quantity-counter" type="text" value="1">
                        </div>
                        <!-- End Col -->

                        <div class="col-auto">
                          <a class="js-minus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
                            <svg width="8" height="2" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0 1C0 0.723858 0.223858 0.5 0.5 0.5H7.5C7.77614 0.5 8 0.723858 8 1C8 1.27614 7.77614 1.5 7.5 1.5H0.5C0.223858 1.5 0 1.27614 0 1Z" fill="currentColor" />
                            </svg>
                          </a>
                          <a class="js-plus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M4 0C4.27614 0 4.5 0.223858 4.5 0.5V3.5H7.5C7.77614 3.5 8 3.72386 8 4C8 4.27614 7.77614 4.5 7.5 4.5H4.5V7.5C4.5 7.77614 4.27614 8 4 8C3.72386 8 3.5 7.77614 3.5 7.5V4.5H0.5C0.223858 4.5 0 4.27614 0 4C0 3.72386 0.223858 3.5 0.5 3.5H3.5V0.5C3.5 0.223858 3.72386 0 4 0Z" fill="currentColor" />
                            </svg>
                          </a>
                        </div>
                        <!-- End Col -->
                      </div>
                      <!-- End Row -->
                    </div>
                    <!-- End Quantity -->
                  </div>
                  <!-- End Col -->

                  <div class="col-12 col-sm col-md-2">
                    <!-- Input Group -->
                    <div class="mb-3">
                      <input type="number" class="form-control" placeholder="00" aria-label="00">
                    </div>
                    <!-- End Input Group -->
                  </div>
                  <!-- End Col -->

                  <div class="col col-md-2">
                    <input type="number" class="form-control-plaintext mb-3" placeholder="$0.00" aria-label="$0.00">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Content -->

                <!-- Container For Input Field -->
                <div id="addInvoiceItemContainer"></div>

                <a href="javascript:;" class="js-create-field form-link">
                  <i class="bi-plus"></i> Add item
                </a>

                <!-- Add Phone Input Field -->
                <div id="addInvoiceItemTemplate" style="display: none;">
                  <!-- Content -->
                  <div class="input-group-add-field">
                    <div class="row">
                      <div class="col-md-5">
                        <input type="text" class="form-control mb-3" placeholder="Item name" aria-label="Item name">
                        <input type="text" class="form-control mb-3" placeholder="Description" aria-label="Description">
                      </div>
                      <!-- End Col -->

                      <div class="col-12 col-sm-auto col-md-3">
                        <!-- Quantity -->
                        <div class="quantity-counter mb-3">
                          <div class="js-quantity-counter row align-items-center">
                            <div class="col">
                              <input class="js-result form-control form-control-quantity-counter" type="text" value="1">
                            </div>
                            <!-- End Col -->

                            <div class="col-auto">
                              <a class="js-minus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
                                <svg width="8" height="2" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M0 1C0 0.723858 0.223858 0.5 0.5 0.5H7.5C7.77614 0.5 8 0.723858 8 1C8 1.27614 7.77614 1.5 7.5 1.5H0.5C0.223858 1.5 0 1.27614 0 1Z" fill="currentColor" />
                                </svg>
                              </a>
                              <a class="js-plus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
                                <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M4 0C4.27614 0 4.5 0.223858 4.5 0.5V3.5H7.5C7.77614 3.5 8 3.72386 8 4C8 4.27614 7.77614 4.5 7.5 4.5H4.5V7.5C4.5 7.77614 4.27614 8 4 8C3.72386 8 3.5 7.77614 3.5 7.5V4.5H0.5C0.223858 4.5 0 4.27614 0 4C0 3.72386 0.223858 3.5 0.5 3.5H3.5V0.5C3.5 0.223858 3.72386 0 4 0Z" fill="currentColor" />
                                </svg>
                              </a>
                            </div>
                            <!-- End Col -->
                          </div>
                          <!-- End Row -->
                        </div>
                        <!-- End Quantity -->
                      </div>
                      <!-- End Col -->

                      <div class="col-12 col-sm col-md-2">
                        <!-- Input Group -->
                        <div class="mb-3">
                          <input type="number" class="form-control" placeholder="00" aria-label="00">
                        </div>
                        <!-- End Input Group -->
                      </div>
                      <!-- End Col -->

                      <div class="col col-md-2">
                        <input type="number" class="form-control-plaintext mb-3" placeholder="$0.00" aria-label="$0.00">
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->

                    <a class="js-delete-field input-group-add-field-delete" href="javascript:;" data-toggle="tooltip" data-placement="top" title="Remove item">
                      <i class="bi-x-lg"></i>
                    </a>
                  </div>
                  <!-- End Content -->
                </div>
                <!-- End Add Phone Input Field -->
              </div>

              <hr class="my-5">

              <div class="row justify-content-md-end mb-3">
                <div class="col-md-auto">
                  <dl class="row text-md-end">
                    <dt class="col-md-6">Subtotal:</dt>
                    <dd class="col-md-6">$0.00</dd>
                    <dt class="col-md-6">Total:</dt>
                    <dd class="col-md-6">$0.00</dd>
                    <dt class="col-md-6 mb-1 mb-md-0">Tax:</dt>
                    <dd class="col-md-6">
                      <!-- Input Group -->
                      <div class="tom-select-custom tom-select-custom-end">
                        <div id="taxSelect" class="input-group">
                          <input type="number" class="form-control" placeholder="0.00" aria-label="0.00" style="min-width: 5rem;">
                          <!-- Select -->
                          <select class="js-select form-select" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "dropdownWidth": "9rem"
                                  }'>
                            <option value="discount2Filter1">Flat ($)</option>
                            <option value="discount2Filter2" selected>Percent (%)</option>
                          </select>
                          <!-- End Select -->
                        </div>
                      </div>
                      <!-- End Input Group -->
                    </dd>
                    <dt class="col-md-6 mb-1 mb-md-0">Amount paid:</dt>
                    <dd class="col-md-6">
                      <!-- Input Group -->
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-currency-dollar"></i>
                        </div>
                        <input type="number" class="form-control" placeholder="0.00" aria-label="0.00">
                      </div>
                      <!-- End Input Group -->
                    </dd>
                    <dt class="col-md-6">Due balance:</dt>
                    <dd class="col-md-6">$0.00</dd>
                  </dl>
                  <!-- End Row -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <!-- Form -->
              <div class="mb-4">
                <label for="invoiceNotesLabel" class="form-label">Notes &amp; terms</label>
                <textarea class="form-control" placeholder="Who is this invoice to?" id="invoiceNotesLabel" aria-label="Who is this invoice to?" rows="3"></textarea>
              </div>
              <!-- End Form -->

              <p class="fs-6 mb-0">&copy; Front. 2020 Htmlstream.</p>
            </div>
            <!-- End Body -->
          </div>
          <!-- End Card -->
           <div class="d-grid gap-2 gap-sm-3 mb-2 mb-sm-3">
                <button class="btn btn-primary" type="submit">
                  <i class="bi-cursor-fill me-1"></i> Send invoice
                </button>

                <a class="btn btn-white" href="javascript:;">
                  <i class="bi-download me-1"></i> Download
                </a>
              </div>
          </form>

          <!-- Sticky Block End Point -->
          <div id="stickyBlockEndPoint"></div>
        </div>

        <div class="col-lg-3">
          <div id="stickyBlockStartPoint">
            <div class="js-sticky-block" data-hs-sticky-block-options='{
                   "parentSelector": "#stickyBlockStartPoint",
                   "breakpoint": "lg",
                   "startPoint": "#stickyBlockStartPoint",
                   "endPoint": "#stickyBlockEndPoint",
                   "stickyOffsetTop": 20
                 }'>
              <div class="d-grid gap-2 gap-sm-3 mb-2 mb-sm-3">
                <a class="btn btn-primary" href="javascript:;">
                  <i class="bi-cursor-fill me-1"></i> Send invoice
                </a>

                <a class="btn btn-white" href="javascript:;">
                  <i class="bi-download me-1"></i> Download
                </a>
              </div>

              <div class="row gx-3">
                <div class="col-sm mb-2 mb-sm-0">
                  <div class="d-grid">
                    <a class="btn btn-white" href="javascript:;">Preview</a>
                  </div>
                </div>
                <!-- End Col -->

                <div class="col-sm">
                  <div class="d-grid">
                    <a class="btn btn-white" href="javascript:;">Save</a>
                  </div>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <hr class="my-4">

              <!-- Form -->
              <div class="mb-4">
                <label for="currencyLabel" class="form-label">Currency</label>

                <!-- Select -->
                <div class="tom-select-custom">
                  <select class="js-select form-select" id="currencyLabel" autocomplete="off" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                    <option label="empty"></option>
                    <option value="currency1" selected data-option-template='<span class="d-flex align-items-center text-truncate"><img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Image description" width="16"/><span>USD (United States Dollar)</span></span>'>USD (United States Dollar)</option>
                    <option value="currency2" data-option-template='<span class="d-flex align-items-center text-truncate"><img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Image description" width="16"/><span>GBP (United Kingdom Pound)</span></span>'>GBP (United Kingdom Pound)</option>
                    <option value="currency3" data-option-template='<span class="d-flex align-items-center text-truncate"><img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/eu.svg" alt="Image description" width="16"/><span>Euro (Euro Member Countries)</span></span>'>Euro (Euro Member Countries)</option>
                  </select>
                </div>
                <!-- End Select -->
              </div>
              <!-- End Form -->

              <div class="d-grid gap-3">
                <!-- Form Switch -->
                <label class="row form-check form-switch" for="invoicePaymentTermsSwitch">
                  <span class="col-8 col-sm-9 ms-0">Payment terms</span>
                  <span class="col-4 col-sm-3 text-end">
                    <input type="checkbox" class="form-check-input" id="invoicePaymentTermsSwitch" checked>
                  </span>
                </label>
                <!-- End Form Switch -->

                <!-- Form Switch -->
                <label class="row form-check form-switch" for="invoiceClientNotesSwitch">
                  <span class="col-8 col-sm-9 ms-0">Client notes</span>
                  <span class="col-4 col-sm-3 text-end">
                    <input type="checkbox" class="form-check-input" id="invoiceClientNotesSwitch" checked>
                  </span>
                </label>
                <!-- End Form Switch -->

                <!-- Form Switch -->
                <label class="row form-check form-switch" for="invoiceAttachPDFSwitch">
                  <span class="col-8 col-sm-9 ms-0">Attach PDF in mail</span>
                  <span class="col-4 col-sm-3 text-end">
                    <input type="checkbox" class="form-check-input" id="invoiceAttachPDFSwitch">
                  </span>
                </label>
                <!-- End Form Switch -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Row -->
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



@endsection