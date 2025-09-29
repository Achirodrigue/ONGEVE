@extends('dashboard.magasinier.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Modification de la facture <span class="text-danger">{{ $fournisseurfacture->numero_facture }}</span></h1>
          </div>
          <!-- End Col -->
           
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('magasinier.fournisseur.facture.invalide') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('magasinier.fournisseur.facture.invalide') }}" tabindex="-1" aria-disabled="true">Facture en cours de traitement</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Modification de facture</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('magasinier.fournisseurfacture.update', $fournisseurfacture) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Informations produits</h4>
                </div>

                <div class="card-body">
                  
                  @foreach($fournisseurfacture->fournisseurfactureprods as $fournisseurfactureprod)
                    <div class="row mb-4">
                      <label for="produit{{ $fournisseurfactureprod->id }}" class="col-sm-3 col-form-label form-label">Produit {{ $fournisseurfactureprod->id }} <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                      <div class="col-sm-12">
                        <div class="input-group input-group-sm-vertical">
                          <input type="text" class="form-control" name="nomProduit{{ $fournisseurfactureprod->id }}" id="produit{{ $fournisseurfactureprod->id }}" value="{{ $fournisseurfactureprod->produit }}" aria-label="Nom produit" required>
                          <input type="number" class="form-control" name="quantiteProduit{{ $fournisseurfactureprod->id }}" id="produit{{ $fournisseurfactureprod->id }}" value="{{ $fournisseurfactureprod->quantite }}" aria-label="Quantite produit" required>
                          <input type="number" class="form-control" name="prixProduit{{ $fournisseurfactureprod->id }}" id="produit{{ $fournisseurfactureprod->id }}" value="{{ $fournisseurfactureprod->prix_unitaire }}" aria-label="Prix unitaire produit" required>
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>
              </div>
            </div>

          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('magasinier.fournisseur.facture.invalide') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <!-- <button type="button" class="btn btn-ghost-light">Discard</button> -->
                      <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>
    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->


@endsection