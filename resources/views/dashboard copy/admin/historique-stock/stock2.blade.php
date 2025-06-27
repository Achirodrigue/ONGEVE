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
                                             Entrée et sortie des produits sur la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.stock.global.produit.un') }}" class="btn btn-primary">
                                                  <i class='bx bxs-arrow-from-right me-1'></i> Stock 1
                                             </a>
                                             @if(auth()->user()->role)
                                                  <!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteCommandeGenerale">
                                                       <i class="bx bx-trash me-1"></i> Generales
                                                  </a> -->
                                             @endif
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($prodses->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover text-center table-centered table-bordered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th colspan="6" scope="col">Entrées et sortie du stock</th>
                                                       </tr>
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Designation</th>
                                                            <th scope="col">Code article</th>
                                                            <th scope="col">Entrée</th>
                                                            <th scope="col">Sortie</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                  
                                                       @foreach($prodses as $prodse)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $prodse->created_at }}</td>
                                                                 <td>{{ $prodse->produit->nom }}</td>
                                                                 <td>{{ $prodse->produit->reference }}</td>
                                                                 <td>@if($prodse->entree_sortie) {{ $prodse->quantite }} @endif</td>
                                                                 <td>@if(!$prodse->entree_sortie) {{ $prodse->quantite }} @endif</td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Aucune entrée et sortie de produit sur la plateformes
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body -->
                    </div>
               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


          
          

          


@endsection