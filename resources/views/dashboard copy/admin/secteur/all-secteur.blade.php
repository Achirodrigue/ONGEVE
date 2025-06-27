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
                                                  Mes différents secteurs d'activités <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="#!" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSecteur">
                                                  <i class="bx bx-plus me-1"></i>Ajouter
                                             </a>
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($secteurs->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Frais livraison</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($secteurs as $secteur)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $secteur->nom }}</td>
                                                                 <td>
                                                                      {{ strrev(wordwrap(strrev($secteur->frais_livraison), 3, ' ', true)) }}F
                                                                 </td>
                                                                 <!-- <td>         
                                                                      <a class="btn btn-sm btn-soft-warning px-3 fw-bold" @if($secteurs->count() > 0) href="{{ route('admin.secteur.edit', $secteur) }}" @else href="#" @endif>
                                                                           {{ $secteurs->count() }}
                                                                      </a>
                                                                 </td> -->
                                                                 <td>
                                                                      @if(modifAccessibleAdmin())
                                                                           <a href="#" data-bs-toggle="modal" data-bs-target="#editSecteur{{ $secteur->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                           </a>
                                                                           <a href="#" data-bs-toggle="modal" data-bs-target="#deleteSecteur{{ $secteur->id }}">
                                                                                <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                      @else
                                                                      @if($admin->role) Superviseur @else @if($admin->adminsecteur->secteur_id) Admin @else Super Admin @endif @endif

                                                                           <a href="#">
                                                                                <button type="button" class="btn btn-sm disabled-btn me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                           </a>
                                                                           <a href="#">
                                                                                <button type="button" class="btn btn-sm disabled-btn me-1"><i class="bx bx-trash fs-16"></i></button>
                                                                           </a>
                                                                      @endif
                                                                 </td>
                                                            </tr>
                                                            
                                                            @include('include.secteur')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucun secteur d'activité sur la plateformes
                                        </h5>
                                   @endif
                              </div>
                         </div> <!-- end card body -->
                    </div> <!-- end col -->

               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


          <!-- Modal -->
          <div class="modal fade" id="addSecteur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Ajout d'un secteur d'activité catégorie</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form method="post" action="{{ route('admin.secteur.store') }}" enctype="multipart/form-data">
                              @csrf
                              <div class="modal-body">
                                   <div class="row">
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="category-title" class="form-label">Nom de la secteur</label>
                                                  <input type="text" name="nom" value="{{ old('nom') }}" id="category-title" class="form-control" placeholder="Entrer un nom" required>
                                                  @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
                                        </div>
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="category-title" class="form-label">Frais de livraison</label>
                                                  <input type="number" name="frais_livraison" value="{{ old('frais_livraison') }}" id="category-title" class="form-control" placeholder="Entrer les Frais de livraison" required>
                                                  @error('frais_livraison') <span class="text-danger"> {{ $message }} </span> @enderror
                                             </div>
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