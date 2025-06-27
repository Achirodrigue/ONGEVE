@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="row">

                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="card-header border-0">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                             <div>
                                                  <ol class="breadcrumb mb-0">
                                                       <li class="breadcrumb-item fw-medium">
                                                            <a href="javascript: void(0);"
                                                       class="text-dark">Liste des membres de l'équipe</a></li>
                                                  </ol>
                                             </div>

                                             <div>
                                                  <div class="d-flex flex-wrap gap-2">
                                                       <!--<button type="button" class="btn btn-outline-secondary me-1">
                                                            <i class="bx bx-cog me-1"></i>
                                                            More Setting
                                                       </button>-->
                                                       <a href="{{ route('admin.equipe.create') }}"
                                                            class="btn btn-success me-1"><i class="bx bx-plus"></i>
                                                            Nouveau membre
                                                       </a>
                                                  </div>
                                             </div>
                                        </div>
                                        
                                        @include('include.message')
                                   </div>
                              </div>
                         </div>
                    </div>


                    @if($equipes->count() > 0)
                         <div class="row">
                              @foreach($equipes as $equipe)
                                   <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                                        <div class="card equipe">
                                             <!-- <h4
                                                  class="badge bg-success text-light fs-14 z-3 m-2 py-1 px-2 position-absolute top-0 start-0">
                                                  New Arrival</h4> -->

                                             <img src="{{ asset(Storage::url($equipe->photo)) }}" alt="" class="img-fluid ">

                                             <div class="p-1"></div>

                                             <div class="card-body" style="box-shadow: 0px 0px 5px 0px white;">
                                                  <h5 class="text-dark fw-medium fs-16">
                                                       <span class="text-warning">Nom et prénom :</span> {{ $equipe->nom }} {{ $equipe->prenom }}
                                                  </h5>
                                                  <h5 class="text-dark fw-medium fs-16">
                                                       <span class="text-warning">Contact :</span> {{ $equipe->contact }}
                                                  </h5>
                                                  <h5 class="text-dark fw-medium fs-16">
                                                       <span class="text-warning">Email :</span> {{ $equipe->email }}
                                                  </h5>
                                                  <h5 class="text-dark fw-medium fs-16">
                                                       <span class="text-warning">Lieu d'habitation :</span> {{ $equipe->adresse }}
                                                  </h5>

                                                  <hr class="mx-n3">  

                                                  <div class="d-flex align-items-center justify-content-center mt-3 ">
                                                       <div class="d-flex flex-wrap gap-2">
                                                            <!-- archive, spam & delete -->
                                                            <div class="btn-group text-center">
                                                                 <a href="{{ route('admin.equipe.edit', $equipe) }}">
                                                                      <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark as spam" data-bs-original-title="Mark as spam">
                                                                           <i class="bx bx-edit fs-18"></i>
                                                                      </button>
                                                                 </a>
                                                                 <a href="#" data-bs-toggle="modal" data-bs-target="#deleteEquipe{{ $equipe->id }}">
                                                                      <button type="button" class="btn btn-light"><i class="bx bx-trash fs-18"></i></button>
                                                                 </a>
                                                            </div>

                                                            <!-- move to -->
                                                            <!-- <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Folder">
                                                                 <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                      <i class="bx bx-folder fs-18"></i> Action
                                                                 </button>
                                                                 <div class="dropdown-menu">
                                                                      <a class="dropdown-item" href="{{ route('admin.equipe.edit', $equipe) }}">Etat : 
                                                                           @if($equipe->isvalide)
                                                                                <span class="text-warning">Activé</span>
                                                                           @else
                                                                                <span class="text-danger">Désactivé</span>
                                                                           @endif
                                                                      </a>
                                                                 </div>
                                                            </div> -->
                                                       </div>
                                                  </div>
                                                  <!--
                                                  <hr class="mx-n3">

                                                  <div class="d-flex justify-content-center align-items-center mt-3 text-truncate">
                                                       <h4 class="d-flex align-items-center gap-1 mb-0">
                                                       </h4>
                                                       
                                                       <h2 class="fw-medium my-3">
                                                            $80.00 
                                                            <span class="fs-16 text-decoration-line-through">$100.00</span>
                                                            <small class="text-danger ms-2">(30%Off)</small>
                                                       </h2>
                                                  </div>
                                                       -->
                                             </div>

                                        </div>

                                        @include('include.equipe')
                                   </div>                    
                              @endforeach
                         </div>
                         
                    @else
                         <div class="row">
                              <div class="col-12">
                                   <div class="card p-2">
                                        <div class="card-header border-0">
                                             <h4 class="fw-bold text-center">
                                                  Désolé! Aucun membre disponible sur la plateforme.
                                             </h4>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endif
               </div>
               <!-- End Container Fluid -->

@endsection