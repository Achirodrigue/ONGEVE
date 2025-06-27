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
                                                  Les différents avis pour le produit {{ $produit->nom }}<a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.sous.categorie.produit', $produit->souscategorie) }}" class="btn btn-primary">
                                                  <i class="bx bxs-arrow-from-right me-1"></i>Retour
                                             </a>
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($produit->avisprods->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Prenom</th>
                                                            <th scope="col">Nombre d'étoile</th>
                                                            <th scope="col">commentaire</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($produit->avisprods as $avisprod)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $avisprod->nom }}</td>
                                                                 <td>{{ $avisprod->prenom }}</td>
                                                                 <td>{{ $avisprod->etoile }}</td>
                                                                 <td>{{ $avisprod->commentaire }}</td>
                                                                 <td>
                                                                      <form action="{{ route('admin.avis.produit.destroy', $avisprod) }}" method="POST">
                                                                      @csrf
                                                                      @method('delete')
                                                                           <button type="submit" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                      </form>
                                                                 </td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                                             <div class="col-sm">
                                                  <div class="text-muted">
                                                       Showing <span class="fw-semibold">10</span> of <span class="fw-semibold">52</span> tasks
                                                  </div>
                                             </div>
                                             <div class="col-sm-auto mt-3 mt-sm-0">
                                                  <ul class="pagination pagination-rounded m-0">
                                                       <li class="page-item">
                                                            <a href="#" class="page-link"><i class='bx bx-left-arrow-alt'></i></a>
                                                       </li>
                                                       <li class="page-item active">
                                                            <a href="#" class="page-link">1</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">2</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link"><i class='bx bx-right-arrow-alt'></i></a>
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div> -->
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez aucun avis pour le produit {{ $produit->nom }} sur la plateformes
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body -->
                    </div> <!-- end col -->

                    <!--<div class="col-xl-3">
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
                    </div>-->
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


          
          

          


@endsection