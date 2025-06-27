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
            <h4 class="page-header-title">Etape 1</h4>
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
                        <textarea name="note_condition" class="form-control" id="note_condition" value="{{ old('note_condition') }}" placeholder="Entrer une note"></textarea>
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
                    <a href="{{ route('commercial.devis.index') }}" class="btn btn-ghost-danger">Retour</a>
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