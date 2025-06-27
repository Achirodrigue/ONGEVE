@extends('dashboard.commercial.layout.app')
@section('body')


  @include('include.message')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Products <span class="badge bg-soft-dark text-dark ms-2">72,031</span></h1>

            <div class="mt-2">
              <a class="text-body me-3" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exportProductsModal">
                <i class="bi-download me-1"></i> Export
              </a>
              <a class="text-body" href="javascript:;" data-bs-toggle="modal" data-bs-target="#importProductsModal">
                <i class="bi-upload me-1"></i> Import
              </a>
            </div>
          </div>
          <!-- End Col -->

          <div class="col-sm-auto">
            <button type="button" class="btn btn-primary" hr>
              <i class="bi-plus me-1"></i> Ajouter
            </button>
          </div>
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('magasinier.produit.create') }}">
              <i class="bi-person-plus-fill me-1"></i> Ajouter
            </a>
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
              <a class="nav-link active" href="#">All products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Archived</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Publish</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Unpublish</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <div class="row justify-content-end mb-3">
        <div class="col-lg">
          <!-- Datatable Info -->
          <div id="datatableCounterInfo" style="display: none;">
            <div class="d-sm-flex justify-content-lg-end align-items-sm-center">
              <span class="d-block d-sm-inline-block fs-5 me-3 mb-2 mb-sm-0">
                <span id="datatableCounter">0</span>
                Selected
              </span>
              <a class="btn btn-outline-danger btn-sm mb-2 mb-sm-0 me-2" href="javascript:;">
                <i class="bi-trash"></i> Delete
              </a>
              <a class="btn btn-white btn-sm mb-2 mb-sm-0 me-2" href="javascript:;">
                <i class="bi-archive"></i> Archive
              </a>
              <a class="btn btn-white btn-sm mb-2 mb-sm-0 me-2" href="javascript:;">
                <i class="bi-upload"></i> Publish
              </a>
              <a class="btn btn-white btn-sm mb-2 mb-sm-0" href="javascript:;">
                <i class="bi-x-lg"></i> Unpublish
              </a>
            </div>
          </div>
          <!-- End Datatable Info -->
        </div>
      </div>
      <!-- End Row -->

      <!-- Card -->
      <div class="card">
          @if($produits->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0">
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
              

              <div class="d-grid d-sm-flex gap-2">
                <button class="btn btn-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEcommerceProductFilter" aria-controls="offcanvasEcommerceProductFilter">
                  <i class="bi-filter me-1"></i> Filters
                </button>

                <!-- Dropdown -->
                <div class="dropdown">
                  <button type="button" class="btn btn-white w-100" id="showHideDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <i class="bi-table me-1"></i> Columns <span class="badge bg-soft-dark text-dark rounded-circle ms-1">6</span>
                  </button>

                  <div class="dropdown-menu dropdown-menu-end dropdown-card" aria-labelledby="showHideDropdown" style="width: 15rem;">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="d-grid gap-3">
                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_product">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Product</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_product" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_type">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Type</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_type" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_vendor">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Vendor</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_vendor">
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_stocks">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Stocks</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_stocks" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_sku">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">SKU</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_sku" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_price">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Price</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_price" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_quantity">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Quantity</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_quantity">
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_variants">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Variants</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_variants" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Dropdown -->
              </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
              <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
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
                    <th scope="col" class="table-column-pe-0">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                        <label class="form-check-label">
                        </label>
                      </div>
                    </th>
                    <th class="table-column-ps-0">Produit</th>
                    <th>Description</th>
                    <th>Prix unitaire</th>
                    <th>Quantités en stock</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($produits as $produit)
                    <tr>
                      <td class="table-column-pe-0">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                          <label class="form-check-label" for="datatableCheckAll1"></label>
                        </div>
                      </td>
                      <td class="table-column-ps-0">
                        <a class="d-flex align-items-center" href="ecommerce-product-details.html">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-lg" src="{{ asset(Storage::url($produit->image)) }}" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                          </div>
                        </a>
                      </td>
                      <td class="fw-bold">@if($produit->description) {{ $produit->description }} @else Aucune description @endif</td>
                      <td class="fw-bold">{{ getprice($produit->prix) }}</td>
                      <td class="text-warning">{{ $produit->qtyStock }} (en stock)</td>
                      <td class="text-warning">{{ $produit->reference }}</td>
                      <td class="fw-bold">{{ $produit->categorie->nom }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('magasinier.produit.edit', $produit) }}">
                            <i class="bi-pencil-fill me-1"></i> Edit
                          </a>

                          <!-- Button Group -->
                          <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                            <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="productsEditDropdown1">
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteProduit{{ $produit->id }}">
                                <i class="bi-trash dropdown-item-icon"></i> Delete
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="bi-archive dropdown-item-icon"></i> Archive
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="bi-upload dropdown-item-icon"></i> Publish
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="bi-x-lg dropdown-item-icon"></i> Unpublish
                              </a>
                            </div>
                          </div>
                          <!-- End Button Group -->
                        </div>
                      </td>
                    </tr>
                    @include('include.produit')
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
                    <span class="me-2">Showing:</span>

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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
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
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- Create New Category Modal -->
  <div class="modal fade" id="addproduit" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une catégorie</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
          <form method="post" action="{{ route('magasinier.produit.store') }}" enctype="multipart/form-data">
          @csrf
            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Nom de la catégorie" required>
            @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
          </form>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer">
          <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
            <!-- <div class="col-sm mb-2 mb-sm-0">
              <p class="modal-footer-text">What is an API? <i class="bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="API stands for application programming interface. It can be helpful to think of the API as a way for different apps to talk to one another."></i></p>
            </div> -->
            <!-- End Col -->

            <div class="col-sm-auto">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
              </div>
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->
        </div>
        <!-- End Footer -->
      </div>
    </div>
  </div>
  <!-- End Create New API Key Modal -->
  
  <!-- New Project Modal -->
  <div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newProjectModalLabel">New project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Body -->
        <div class="modal-body">
          <!-- Step Form -->
          <form class="js-step-form" data-hs-step-form-options='{
                  "progressSelector": "#createProjectStepFormProgress",
                  "stepsSelector": "#createProjectStepFormContent",
                  "endSelector": "#createProjectFinishBtn",
                  "isValidate": false
                }'>
            <!-- Step -->
            <ul id="createProjectStepFormProgress" class="js-step-progress step step-sm step-icon-sm step-inline step-item-between mb-3 mb-sm-7">
              <li class="step-item">
                <a class="step-content-wrapper" href="javascript:;" data-hs-step-form-next-options='{
                    "targetSelector": "#createProjectStepDetails"
                  }'>
                  <span class="step-icon step-icon-soft-dark">1</span>
                  <div class="step-content">
                    <span class="step-title">Details</span>
                  </div>
                </a>
              </li>

              <li class="step-item">
                <a class="step-content-wrapper" href="javascript:;" data-hs-step-form-next-options='{
                     "targetSelector": "#createProjectStepTerms"
                   }'>
                  <span class="step-icon step-icon-soft-dark">2</span>
                  <div class="step-content">
                    <span class="step-title">Terms</span>
                  </div>
                </a>
              </li>

              <li class="step-item">
                <a class="step-content-wrapper" href="javascript:;" data-hs-step-form-next-options='{
                     "targetSelector": "#createProjectStepMembers"
                   }'>
                  <span class="step-icon step-icon-soft-dark">3</span>
                  <div class="step-content">
                    <span class="step-title">Members</span>
                  </div>
                </a>
              </li>
            </ul>
            <!-- End Step -->

            <!-- Content Step Form -->
            <div id="createProjectStepFormContent">
              <div id="createProjectStepDetails" class="active">
                <!-- Form -->
                <div class="mb-4">
                  <label class="form-label">Project logo</label>

                  <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <label class="avatar avatar-xl avatar-circle avatar-uploader me-5" for="avatarNewProjectUploader">
                      <img id="avatarNewProjectImg" class="avatar-img" src="assets/img/160x160/img2.jpg" alt="Image Description">

                      <input type="file" class="js-file-attach avatar-uploader-input" id="avatarNewProjectUploader" data-hs-file-attach-options='{
                                "textTarget": "#avatarNewProjectImg",
                                "mode": "image",
                                "targetAttr": "src",
                                "resetTarget": ".js-file-attach-reset-img",
                                "resetImg": "./assets/img/160x160/img1.jpg",
                                "allowTypes": [".png", ".jpeg", ".jpg"]
                             }'>

                      <span class="avatar-uploader-trigger">
                        <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
                      </span>
                    </label>
                    <!-- End Avatar -->

                    <button type="button" class="js-file-attach-reset-img btn btn-white">Delete</button>
                  </div>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                  <label for="clientNewProjectLabel" class="form-label">Client</label>

                  <div class="row align-items-center">
                    <div class="col-12 col-md-7 mb-3">
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-person-square"></i>
                        </div>
                        <input class="form-control" id="clientNewProjectLabel" placeholder="Add creater name" aria-label="Add creater name">
                      </div>
                    </div>
                    <!-- End Col -->

                    <span class="col-auto mb-3">or</span>

                    <div class="col-md mb-md-3">
                      <a class="btn btn-white" href="javascript:;">
                        <i class="tio-add me-1"></i>New client
                      </a>
                    </div>
                    <!-- End Col -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                  <label for="projectNameNewProjectLabel" class="form-label">Project name <i class="bi-question-circle text-body ms-1" data-toggle="tooltip" data-placement="top" title="Displayed on public forums, such as Front."></i></label>

                  <div class="input-group input-group-merge">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-briefcase"></i>
                    </div>
                    <input type="text" class="form-control" name="projectName" id="projectNameNewProjectLabel" placeholder="Enter project name here" aria-label="Enter project name here">
                  </div>
                </div>
                <!-- End Form -->

                <!-- Quill -->
                <div class="mb-4">
                  <label class="form-label">Project description <span class="form-label-secondary">(Optional)</span></label>

                  <!-- Quill -->
                  <div class="quill-custom">
                    <div class="js-quill" style="height: 15rem;" data-hs-quill-options='{
                         "placeholder": "Type your message...",
                          "modules": {
                            "toolbar": [
                              ["bold", "italic", "underline", "strike", "link", "image", "blockquote", "code", {"list": "bullet"}]
                            ]
                          }
                         }'>
                    </div>
                  </div>
                  <!-- End Quill -->
                </div>
                <!-- End Quill -->

                <div class="row">
                  <div class="col-sm-6">
                    <!-- Form -->
                    <div class="mb-4">
                      <label for="projectDeadlineNewProjectLabel" class="form-label">Due date</label>

                      <div id="projectDeadlineNewProject" class="input-group input-group-merge">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-calendar-week"></i>
                        </div>

                        <input type="text" class="form-control" id="projectDeadlineNewProjectLabel" placeholder="Select dates">
                      </div>
                    </div>
                    <!-- End Form -->
                  </div>
                  <!-- End Col -->

                  <div class="col-sm-6">
                    <!-- Form -->
                    <div class="mb-4">
                      <label for="ownerNewProjectLabel" class="form-label">Owner</label>

                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select form-select" id="ownerNewProjectLabel" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                          <option value="owner1" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle" src="assets/img/160x160/img6.jpg" alt="Avatar" /><span class="flex-grow-1 ms-2">Mark Williams</span></span>'>Mark Williams</option>
                          <option value="owner2" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle" src="assets/img/160x160/img10.jpg" alt="Avatar" /><span class="flex-grow-1 ms-2">Amanda Harvey</span></span>'>Amanda Harvey</option>
                          <option value="owner3" selected data-option-template='<span class="d-flex align-items-center"><i class="bi-person text-body"></i><span class="flex-grow-1 ms-2">Assign to owner</span></span>'>Assign to owner</option>
                        </select>
                      </div>
                      <!-- End Select -->
                    </div>
                    <!-- End Form -->
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Row -->

                <!-- Form -->
                <div class="mb-4">
                  <label class="form-label">Attach files</label>

                  <!-- Dropzone -->
                  <div id="attachFilesNewProjectLabel" class="js-dropzone dz-dropzone dz-dropzone-card">
                    <div class="dz-message">
                      <img class="avatar avatar-xl avatar-4x3 mb-3" src="assets/svg/illustrations/oc-browse.svg" alt="Image Description" data-hs-theme-appearance="default">
                      <img class="avatar avatar-xl avatar-4x3 mb-3" src="assets/svg/illustrations-light/oc-browse.svg" alt="Image Description" data-hs-theme-appearance="dark">

                      <h5>Drag and drop your file here</h5>

                      <p class="mb-2">or</p>

                      <span class="btn btn-white btn-sm">Browse files</span>
                    </div>
                  </div>
                  <!-- End Dropzone -->
                </div>
                <!-- End Form -->

                <label class="form-label">Default view</label>

                <div class="input-group input-group-md-vertical">
                  <!-- Radio Check -->
                  <label class="form-control" for="projectViewNewProjectTypeRadio1">
                    <span class="form-check form-check-reverse">
                      <input type="radio" class="form-check-input" name="projectViewNewProjectTypeRadio" id="projectViewNewProjectTypeRadio1">
                      <span class="form-check-label"><i class="bi-view-list text-muted me-2"></i> List</span>
                    </span>
                  </label>
                  <!-- End Radio Check -->

                  <!-- Radio Check -->
                  <label class="form-control" for="projectViewNewProjectTypeRadio2">
                    <span class="form-check form-check-reverse">
                      <input type="radio" class="form-check-input" name="projectViewNewProjectTypeRadio" id="projectViewNewProjectTypeRadio2" checked>
                      <span class="form-check-label"><i class="bi-table text-muted me-2"></i> Table</span>
                    </span>
                  </label>
                  <!-- End Radio Check -->

                  <!-- Radio Check -->
                  <label class="form-control" for="projectViewNewProjectTypeRadio3">
                    <span class="form-check form-check-reverse">
                      <input type="radio" class="form-check-input" name="projectViewNewProjectTypeRadio" id="projectViewNewProjectTypeRadio3" disabled>
                      <span class="form-check-label">Timeline</span>
                      <span class="badge bg-soft-primary text-primary rounded-pill">Coming soon...</span>
                    </span>
                  </label>
                  <!-- End Radio Check -->
                </div>

                <!-- Footer -->
                <div class="d-flex align-items-center mt-5">
                  <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-hs-step-form-next-options='{
                              "targetSelector": "#createProjectStepTerms"
                            }'>
                      Next <i class="bi-chevron-right"></i>
                    </button>
                  </div>
                </div>
                <!-- End Footer -->
              </div>

              <div id="createProjectStepTerms" style="display: none;">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- Form -->
                    <div class="mb-4">
                      <label for="paymentTermsNewProjectLabel" class="form-label">Terms</label>

                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select form-select" id="paymentTermsNewProjectLabel" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                          <option value="fixed" selected>Fixed</option>
                          <option value="Per hour">Per hour</option>
                          <option value="Per day">Per day</option>
                          <option value="Per week">Per week</option>
                          <option value="Per month">Per month</option>
                          <option value="Per quarter">Per quarter</option>
                          <option value="Per year">Per year</option>
                        </select>
                      </div>
                      <!-- End Select -->
                    </div>
                    <!-- End Form -->
                  </div>
                  <!-- End Col -->

                  <div class="col-sm-6">
                    <label for="expectedValueNewProjectLabel" class="form-label">Expected value</label>

                    <!-- Form -->
                    <div class="mb-4">
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-currency-dollar"></i>
                        </div>
                        <input type="text" class="form-control" name="expectedValue" id="expectedValueNewProjectLabel" placeholder="Enter value here" aria-label="Enter value here">
                      </div>
                    </div>
                    <!-- End Form -->
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Form Row -->

                <div class="row">
                  <div class="col-lg-6">
                    <!-- Form -->
                    <div class="mb-4">
                      <label for="milestoneNewProjectLabel" class="form-label">Milestone <a class="small ms-1" href="javascript:;">Change probability</a></label>

                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select form-select" id="milestoneNewProjectLabel" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                          <option value="New">New</option>
                          <option value="Qualified">Qualified</option>
                          <option value="Meeting">Meeting</option>
                          <option value="Proposal">Proposal</option>
                          <option value="Negotiation">Negotiation</option>
                          <option value="Contact">Contact</option>
                        </select>
                      </div>
                      <!-- End Select -->
                    </div>
                    <!-- End Form -->
                  </div>
                  <!-- End Col -->

                  <div class="col-lg-6">
                    <!-- Form -->
                    <div class="mb-4">
                      <label for="privacyNewProjectLabel" class="form-label me-2">Privacy</label>

                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select form-select" id="privacyNewProjectLabel" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                          <option value="privacy1" data-option-template='<span class="d-flex"><i class="bi-people fs2 text-body"></i><span class="flex-grow-1 ms-2"><span class="d-block">Everyone</span><small class="tom-select-custom-hide">Public to Front Dashboard</small></span></span>'>Everyone</option>
                          <option value="privacy2" disabled data-option-template='<span class="d-flex"><i class="bi-lock fs2 text-body"></i><span class="flex-grow-1 ms-2"><span class="d-block">Private to project members <span class="badge bg-soft-primary text-primary">Upgrade to Premium</span></span><small class="tom-select-custom-hide">Only visible to project members</small></span></span>'>Private to project members</option>
                          <option value="privacy3" data-option-template='<span class="d-flex"><i class="bi-person fs2 text-body"></i><span class="flex-grow-1 ms-2"><span class="d-block">Private to me</span><small class="tom-select-custom-hide">Only visible to you</small></span></span>'>Private to me</option>
                        </select>
                      </div>
                      <!-- End Select -->
                    </div>
                    <!-- End Form -->
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Form Row -->

                <div class="d-grid gap-2">
                  <!-- Check -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="budgetNewProjectCheckbox">
                    <label class="form-check-label" for="budgetNewProjectCheckbox">
                      Budget resets every month
                    </label>
                  </div>
                  <!-- End Check -->

                  <!-- Check -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="emailAlertNewProjectCheckbox" checked>
                    <label class="form-check-label" for="emailAlertNewProjectCheckbox">
                      Send email alerts if project exceeds <span class="font-weight-bold">50.00%</span> of budget
                    </label>
                  </div>
                  <!-- End Check -->
                </div>

                <!-- Footer -->
                <div class="d-flex align-items-center mt-5">
                  <button type="button" class="btn btn-ghost-secondary me-2" data-hs-step-form-prev-options='{
                       "targetSelector": "#createProjectStepDetails"
                     }'>
                    <i class="bi-chevron-left"></i> Previous step
                  </button>

                  <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-hs-step-form-next-options='{
                              "targetSelector": "#createProjectStepMembers"
                            }'>
                      Next <i class="bi-chevron-right"></i>
                    </button>
                  </div>
                </div>
                <!-- End Footer -->
              </div>

              <div id="createProjectStepMembers" style="display: none;">
                <!-- Form -->
                <div class="mb-4">
                  <div class="input-group mb-2 mb-sm-0">
                    <input type="text" class="form-control" name="fullName" placeholder="Search name or emails" aria-label="Search name or emails">

                    <div class="input-group-append input-group-append-last-sm-down-none">
                      <!-- Select -->
                      <div class="tom-select-custom tom-select-custom-end">
                        <select class="js-select form-select tom-select-custom-form-select-invite-user" autocomplete="off" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                          <option value="guest" selected>Guest</option>
                          <option value="can edit">Can edit</option>
                          <option value="can comment">Can comment</option>
                          <option value="full access">Full access</option>
                        </select>
                      </div>
                      <!-- End Select -->

                      <a class="btn btn-primary d-none d-sm-inline-block" href="javascript:;">Invite</a>
                    </div>
                  </div>

                  <a class="btn btn-primary w-100 d-sm-none" href="javascript:;">Invite</a>
                </div>
                <!-- End Form -->

                <ul class="list-unstyled list-py-3 mb-5">
                  <!-- List Group Item -->
                  <li>
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <span class="icon icon-soft-dark icon-sm icon-circle">
                          <i class="bi-people-fill"></i>
                        </span>
                      </div>

                      <div class="flex-grow-1 ms-3">
                        <div class="row align-items-center">
                          <div class="col-sm">
                            <h5 class="text-body mb-0">#digitalmarketing</h5>
                            <span class="d-block fs-6">8 members</span>
                          </div>
                          <!-- End Col -->

                          <div class="col-sm-auto">
                            <!-- Select -->
                            <div class="tom-select-custom tom-select-custom-sm-end">
                              <select class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0" autocomplete="off" data-hs-tom-select-options='{
                                        "searchInDropdown": false,
                                        "hideSearch": true,
                                        "dropdownWidth": "11rem"
                                      }'>
                                <option value="guest" selected>Guest</option>
                                <option value="can edit">Can edit</option>
                                <option value="can comment">Can comment</option>
                                <option value="full access">Full access</option>
                                <option value="remove" data-option-template='<div class="text-danger">Remove</div>'>Remove</option>
                              </select>
                            </div>
                            <!-- End Select -->
                          </div>
                          <!-- End Col -->
                        </div>
                        <!-- End Row -->
                      </div>
                    </div>
                  </li>
                  <!-- End List Group Item -->

                  <!-- List Group Item -->
                  <li>
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm avatar-circle">
                          <img class="avatar-img" src="assets/img/160x160/img3.jpg" alt="Image Description">
                        </div>
                      </div>

                      <div class="flex-grow-1 ms-3">
                        <div class="row align-items-center">
                          <div class="col-sm">
                            <h5 class="text-body mb-0">David Harrison</h5>
                            <span class="d-block fs-6">david@site.com</span>
                          </div>
                          <!-- End Col -->

                          <div class="col-sm-auto">
                            <!-- Select -->
                            <div class="tom-select-custom tom-select-custom-sm-end">
                              <select class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0" autocomplete="off" data-hs-tom-select-options='{
                                        "searchInDropdown": false,
                                        "hideSearch": true,
                                        "dropdownWidth": "11rem"
                                      }'>
                                <option value="guest" selected>Guest</option>
                                <option value="can edit">Can edit</option>
                                <option value="can comment">Can comment</option>
                                <option value="full access">Full access</option>
                                <option value="remove" data-option-template='<div class="text-danger">Remove</div>'>Remove</option>
                              </select>
                            </div>
                            <!-- End Select -->
                          </div>
                          <!-- End Col -->
                        </div>
                        <!-- End Row -->
                      </div>
                    </div>
                  </li>
                  <!-- End List Group Item -->

                  <!-- List Group Item -->
                  <li>
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm avatar-circle">
                          <img class="avatar-img" src="assets/img/160x160/img9.jpg" alt="Image Description">
                        </div>
                      </div>

                      <div class="flex-grow-1 ms-3">
                        <div class="row align-items-center">
                          <div class="col-sm">
                            <h5 class="text-body mb-0">Ella Lauda <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="Top endorsed"></i></h5>
                            <span class="d-block fs-6">Markvt@site.com</span>
                          </div>
                          <!-- End Col -->

                          <div class="col-sm-auto">
                            <!-- Select -->
                            <div class="tom-select-custom tom-select-custom-sm-end">
                              <select class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0" autocomplete="off" data-hs-tom-select-options='{
                                        "searchInDropdown": false,
                                        "hideSearch": true,
                                        "dropdownWidth": "11rem"
                                      }'>
                                <option value="guest" selected>Guest</option>
                                <option value="can edit">Can edit</option>
                                <option value="can comment">Can comment</option>
                                <option value="full access">Full access</option>
                                <option value="remove" data-option-template='<div class="text-danger">Remove</div>'>Remove</option>
                              </select>
                            </div>
                            <!-- End Select -->
                          </div>
                          <!-- End Col -->
                        </div>
                        <!-- End Row -->
                      </div>
                    </div>
                  </li>
                  <!-- End List Group Item -->

                  <!-- List Group Item -->
                  <li>
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <span class="icon icon-soft-dark icon-sm icon-circle">
                          <i class="bi-people-fill"></i>
                        </span>
                      </div>

                      <div class="flex-grow-1 ms-3">
                        <div class="row align-items-center">
                          <div class="col-sm">
                            <h5 class="text-body mb-0">#conference</h5>
                            <span class="d-block fs-6">3 members</span>
                          </div>
                          <!-- End Col -->

                          <div class="col-sm-auto">
                            <!-- Select -->
                            <div class="tom-select-custom tom-select-custom-sm-end">
                              <select class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0" autocomplete="off" data-hs-tom-select-options='{
                                        "searchInDropdown": false,
                                        "hideSearch": true,
                                        "dropdownWidth": "11rem"
                                      }'>
                                <option value="guest" selected>Guest</option>
                                <option value="can edit">Can edit</option>
                                <option value="can comment">Can comment</option>
                                <option value="full access">Full access</option>
                                <option value="remove" data-option-template='<div class="text-danger">Remove</div>'>Remove</option>
                              </select>
                            </div>
                            <!-- End Select -->
                          </div>
                          <!-- End Col -->
                        </div>
                        <!-- End Row -->
                      </div>
                    </div>
                  </li>
                  <!-- End List Group Item -->
                </ul>

                <div class="d-grid gap-3">
                  <!-- Form Switch -->
                  <label class="row form-check form-switch" for="addTeamPreferencesNewProjectSwitch1">
                    <span class="col-8 col-sm-9 ms-0">
                      <i class="bi-bell text-primary me-3"></i>
                      <span class="text-dark">Inform all project members</span>
                    </span>
                    <span class="col-4 col-sm-3 text-end">
                      <input type="checkbox" class="form-check-input" id="addTeamPreferencesNewProjectSwitch1" checked>
                    </span>
                  </label>
                  <!-- End Form Switch -->

                  <!-- Form Switch -->
                  <label class="row form-check form-switch" for="addTeamPreferencesNewProjectSwitch2">
                    <span class="col-8 col-sm-9 ms-0">
                      <i class="bi-chat-left-dots text-primary me-3"></i>
                      <span class="text-dark">Show team activity</span>
                    </span>
                    <span class="col-4 col-sm-3 text-end">
                      <input type="checkbox" class="form-check-input" id="addTeamPreferencesNewProjectSwitch2">
                    </span>
                  </label>
                  <!-- End Form Switch -->
                </div>

                <!-- Footer -->
                <div class="d-sm-flex align-items-center mt-5">
                  <button type="button" class="btn btn-ghost-secondary mb-3 mb-sm-0 me-2" data-hs-step-form-prev-options='{
                       "targetSelector": "#createProjectStepTerms"
                     }'>
                    <i class="bi-chevron-left"></i> Previous step
                  </button>

                  <div class="d-flex justify-content-end gap-3 ms-auto">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button id="createProjectFinishBtn" type="button" class="btn btn-primary">Create project</button>
                  </div>
                </div>
                <!-- End Footer -->
              </div>
            </div>
            <!-- End Content Step Form -->

            <!-- Message Body -->
            <div id="createProjectStepSuccessMessage" style="display:none;">
              <div class="text-center">
                <img class="img-fluid mb-3" src="assets/svg/illustrations/oc-hi-five.svg" alt="Image Description" data-hs-theme-appearance="default" style="max-width: 15rem;">
                <img class="img-fluid mb-3" src="assets/svg/illustrations-light/oc-hi-five.svg" alt="Image Description" data-hs-theme-appearance="dark" style="max-width: 15rem;">

                <div class="mb-4">
                  <h2>Successful!</h2>
                  <p>New project has been successfully created.</p>
                </div>

                <div class="d-flex justify-content-center gap-3">
                  <a class="btn btn-white" href="projects.html">
                    <i class="bi-chevron-left"></i> Back to projects
                  </a>

                  <a class="btn btn-primary" href="javascript:;" data-toggle="modal" data-target="#newProjectModal">
                    <i class="bi-building"></i> Add new project
                  </a>
                </div>
              </div>
            </div>
            <!-- End Message Body -->
          </form>
          <!-- End Step Form -->
        </div>
        <!-- End Body -->
      </div>
    </div>
  </div>


@endsection