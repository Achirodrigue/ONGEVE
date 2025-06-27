@extends('dashboard.admin.layout.app')
@section('body')


        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Accueil</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.nouvelle.commande') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Commandes de produits</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.categorie.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Catégorie des produits</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.produit.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Produits</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.nouveau.message') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Messages reçus</span>
          </a>
        </li>
        @include('dashboard.admin.include.navbar')
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.profil.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.historique.solde.day') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Historique des soldes <span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('admin.commentaire') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Commentaire sur produit <span>
          </a>
        </li>
      </ul>
    </div>
  </aside>


  <main class="main-content position-relative border-radius-lg ">
    @include('dashboard.admin.include.un')
    
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <!--<div class="card-header pb-0">
              <h6>Projects table</h6>
            </div>-->
            @if (session()->has('message'))
                <div class="alert alert-warning alert-dismissible" role="alert" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('message') }}
                </div>
            @endif 
            @if ($produits->count() > 0)
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Commentaire sur les produits</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">N°</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">IMAGE-PRODUIT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOM-PRODUIT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOMBRE-COMMENTAIRE</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits as $produit)
                                @if($produit->avisproduits->count() > 0)
                                    <tr>  
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $n++ }}</span>
                                        </td>
                                        <td>
                                            <img src="{{ asset(Storage::url($produit->image)) }}" class="font-weight-bold mb-0" style="width: 80px;" alt="">
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $produit->nom }}</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-secondary">{{ $produit->avisproduits->count() }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="{{ route('admin.commentaire.produit', $produit) }}">
                                                <span class="badge badge-sm bg-gradient-primary p-2"><i class="icofont icofont-plus-circle" style="margin-right: 3px;"></i>Details</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Aucun commentaire disponible</h6>
                    </div>
                </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>



@endsection