@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container Fluid -->
          <div class="container">
               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header">
                                   <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                             <h5 class="card-title mb-1 anchor" id="responsive">
                                                  Mes différentes sous catégories de "{{ $categorie->nom }}"<a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.categorie.index') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                             </a>
                                        </div>
                                   </div> <!-- end row -->
                                   
                                   @include('include.message')
                              </div> <!-- end row -->

                              <div class="card-body">
                                   @if($categorie->souscategories->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Nombre de produit</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($categorie->souscategories as $scategorie)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $scategorie->nom }}</td>
                                                                 <td>    
                                                                      <a class="btn btn-sm btn-soft-warning px-3 fw-bold" @if($scategorie->produits->count() > 0) href="{{ route('admin.sous.categorie.produit', $scategorie) }}" @else href="#" @endif>
                                                                           {{ $scategorie->produits->count() }}
                                                                      </a>
                                                                 </td>
                                                                 <td>
                                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#editSousCategorie{{ $scategorie->id }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                      </a>
                                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#deleteSousCategorie{{ $scategorie->id }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                      </a>
                                                                 </td>
                                                            </tr>
                                                            
                                                            @include('include.sous-categorie.sous-categorie')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucune sous catégorie dans {{ $categorie->nom }}
                                        </h5>
                                   @endif
                              </div>

                              <div class="card-header">
                                   <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                        </div>
                                        <div>
                                             <a href="#!" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSousCategorie">
                                                  <i class="bx bx-plus me-1"></i>Ajouter
                                             </a>
                                        </div>
                                   </div> <!-- end row -->
                              </div> <!-- end row -->

                         </div> <!-- end card body -->
                    </div> <!-- end col -->

                    <!-- <div class="col-xl-3">
                         <div class="card docs-nav">
                              <ul class="nav bg-transparent flex-column">
                                   <li class="nav-item">
                                        <a href="#basic" class="nav-link">Basic Example </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#inverse" class="nav-link">Inverse Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#striped" class="nav-link">Striped Rows Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#hoverable-row" class="nav-link">Hoverable rows </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#active" class="nav-link">Active Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#bordered" class="nav-link">Bordered Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#border-color" class="nav-link">Bordered color Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#borderless" class="nav-link">Basic Borderless Example </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#small" class="nav-link">Small Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#alignment " class="nav-link">Alignment Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#nesting" class="nav-link">Nesting Table </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#head-option" class="nav-link">Table head options </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#tablefoot" class="nav-link">Tablefoot</a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#captions" class="nav-link">Captions</a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#responsive" class="nav-link">Always Responsive Table </a>
                                   </li>

                              </ul>
                         </div>
                    </div> -->
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->

          
          <!-- Modal -->
          <div class="modal fade" id="addSousCategorie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Ajout de sous catégorie</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <form method="post" action="{{ route('admin.scategorie.store') }}" enctype="multipart/form-data">
                         @csrf
                              <div class="modal-body">
                                   <div class="row">
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="category-title" class="form-label">Nom de la sous Categorie</label>
                                                  <input type="text" name="nom" value="{{ old('nom') }}" id="category-title" class="form-control" placeholder="Entrer un nom" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                   
                                        <div class="col-lg-12">
                                             <label for="crater" class="form-label">Catégorie *</label>
                                             <select name="categorie" class="form-control" id="crater" data-choices data-choices-groups
                                                  data-placeholder="Select Crater" required>
                                                  @foreach($categories as $categorie)
                                                  <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Retour</button>
                                   <button type="submit" class="btn btn-secondary">Valider</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
          

@endsection