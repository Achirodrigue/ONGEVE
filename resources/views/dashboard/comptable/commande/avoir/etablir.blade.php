@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Etablir un avoir sur la facture <span class="text-danger">{{ $clientdevis->numero_devis }}</span></h1>
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
              <a class="nav-link" href="{{ route('comptable.commande.client.impaye') }}" tabindex="-1" aria-disabled="true">
                Factures Impayées
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CFIG() }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.commande.client.partielle') }}" tabindex="-1" aria-disabled="true">
                Factures Partielle
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CAPTG() }} / {{ CFPTG() }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.commande.client.paye') }}" tabindex="-1" aria-disabled="true">
                Factures Finalisées
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CAPYG() }} / {{ CFPYG() }}</span>
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('comptable.commande.client.avoir.store', $clientdevis) }}" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Informations produits</h4>
                </div>

                <div class="card-body">
                  @if($clientdevis->TDF != 2)
                      @foreach($clientdevis->clientdevisprods as $clientdevisprod)
                        <div class="row mb-4">
                          <label for="produit{{ $clientdevisprod->id }}" class="col-sm-3 col-form-label form-label w-100">{{ $clientdevisprod->produit->nom }} <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                          <div class="col-sm-12">
                            <div class="input-group input-group-sm-vertical">
                              <input type="text" class="form-control" name="nomProduit{{ $clientdevisprod->id }}" id="produit{{ $clientdevisprod->id }}" value="{{ $clientdevisprod->produit->nom }}" aria-label="Nom produit" required readonly>
                              <input type="number" class="form-control" name="quantiteProduit{{ $clientdevisprod->id }}" id="produit{{ $clientdevisprod->id }}" value="{{ $clientdevisprod->quantite }}" aria-label="Quantite produit" required readonly>
                              <input type="number" class="form-control" name="prixProduit{{ $clientdevisprod->id }}" id="produit{{ $clientdevisprod->id }}" value="{{ $clientdevisprod->prix_unitaire }}" aria-label="Prix unitaire produit" required readonly>
                              <input type="number" class="form-control" name="qty{{ $clientdevisprod->id }}" min="1" max="{{ $clientdevisprod->quantite }}" id="produit{{ $clientdevisprod->id }}" placeholder="Qty à retirer (facultatif)" aria-label="Prix unitaire produit">
                            </div>
                          </div>
                        </div>
                      @endforeach
                  @else
                      @foreach($clientdevis->clientdevisprestations as $clientdevisprestation)
                        <div class="row mb-4">
                          <label for="produit{{ $clientdevisprestation->id }}" class="col-sm-3 col-form-label form-label w-100">{{ $clientdevisprestation->designation }} <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                          <div class="col-sm-12">
                            <div class="input-group input-group-sm-vertical">
                              <input type="text" class="form-control" name="nomProduit{{ $clientdevisprestation->id }}" id="produit{{ $clientdevisprestation->id }}" value="{{ $clientdevisprestation->designation }}" aria-label="Nom produit" required readonly>
                              <input type="number" class="form-control" name="quantiteProduit{{ $clientdevisprestation->id }}" id="produit{{ $clientdevisprestation->id }}" value="{{ $clientdevisprestation->nbre_passage }}" aria-label="Quantite produit" required readonly>
                              <input type="number" class="form-control" name="prixProduit{{ $clientdevisprestation->id }}" id="produit{{ $clientdevisprestation->id }}" value="{{ $clientdevisprestation->prix_unitaire }}" aria-label="Prix unitaire produit" required readonly>
                              <input type="number" class="form-control" name="qty{{ $clientdevisprestation->id }}" min="1" max="{{ $clientdevisprestation->nbre_passage }}" id="produit{{ $clientdevisprestation->id }}" placeholder="nbre de passage à retirer (facultatif)" aria-label="Prix unitaire produit">
                            </div>
                          </div>
                        </div>
                      @endforeach
                  @endif
                </div>
              </div>
            </div>

          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('comptable.commande.client.impaye') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <!-- <button type="button" class="btn btn-ghost-light">Discard</button> -->
                      <button type="submit" class="btn btn-primary">Valider</button>
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



@endsection