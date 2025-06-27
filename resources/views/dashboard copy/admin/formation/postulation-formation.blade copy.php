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
                                                  Mes différentes postulations à la formation <span class="text-warning"></span>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.formation.index') }}" class="btn btn-outline-secondary me-1">
                                                  <i class="bx bxs-arrow-from-right me-1"></i>Retour
                                             </a>
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($formation->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Prenom</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Adresse</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($formation as $pformation)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $pformation->nom }}</td>
                                                                 <td>{{ $pformation->prenom }}</td>
                                                                 <td>{{ $pformation->contact }}</td>
                                                                 <td>{{ $pformation->email }}</td>
                                                                 <td>{{ $pformation->adresse }}</td>
                                                                 <td>
                                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#deletePformation{{ $pformation->id }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                      </a>
                                                                 </td>
                                                            </tr>

                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                        
                                        <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                                             <div class="col-sm">
                                                  <div class="text-muted">
                                                       Pagination
                                                  </div>
                                             </div>
                                             <div class="col-sm-auto mt-3 mt-sm-0">
                                                  <ul class="pagination pagination-rounded m-0">
                                                       <li class="page-item">
                                                            {{ $formation->links() }}
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Aucune postulations à la formation <span class="text-warning">{{ $formation->nom }}</span> sur la plateformes
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body -->
                    </div> <!-- end col -->

               </div> <!-- end row -->
          </div>
          <!-- End Container Fluid -->


@endsection