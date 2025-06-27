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
                                                  Mes différents formateurs de la plateforme <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.formateur.create') }}" class="btn btn-primary">
                                                  <i class="bx bx-plus me-1"></i>Ajouter
                                             </a>
                                        </div>
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($formateurs->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Prenom</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Lieu d'habitation</th>
                                                            <th scope="col">Domaine</th>
                                                            <th scope="col">Formation en cours</th>
                                                            <th scope="col">Photo</th>
                                                            <th scope="col">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($formateurs as $formateur)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $formateur->nom }}</td>
                                                                 <td>{{ $formateur->prenom }}</td>
                                                                 <td>{{ $formateur->contact }}</td>
                                                                 <td>{{ $formateur->email }}</td>
                                                                 <td>{{ $formateur->adresse }}</td>
                                                                 <td>{{ $formateur->domaine }}</td>
                                                                 <td class="text-center">
                                                                      <span>
                                                                           <a   @if($formateur->formationformateurs->where('isvalide', 0)->count() > 0)
                                                                                     href="{{ route('admin.formateur.formation.encours', $formateur) }}" class="btn btn-sm  btn-light"
                                                                                @else
                                                                                     href="#" class="btn btn-sm btn-danger"
                                                                                @endif
                                                                           >
                                                                           @if($formateur->formationformateurs->where('isvalide', 0)->count() > 0) 
                                                                                {{ $formateur->formationformateurs->where('isvalide', 0)->count() }} 
                                                                           @else Aucune @endif
                                                                           </a>
                                                                      </span>
                                                                 </td>
                                                                 <td>
                                                                      @if($formateur->photo)
                                                                           <div class="swiper-slide avatar-sm">
                                                                                <div class="chat-user-status-box">
                                                                                     <span><img src="{{ asset(Storage::url($formateur->photo)) }}" alt="avatar-2" class="img-fluid avatar-sm rounded-circle avatar-border" /></span>
                                                                                </div>
                                                                           </div>
                                                                      @else Aucune @endif
                                                                 </td>
                                                                 <td class="text-center">
                                                                      <div class="dropdown">
                                                                           <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                                           </a>
                                                                           <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 22.4px, 0px);">
                                                                                <a href="{{ route('admin.formateur.edit', $formateur) }}" class="dropdown-item">
                                                                                     <i class="bx bx-edit fs-16"></i> Modifier
                                                                                </a>
                                                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteFormateur{{ $formateur->id }}">
                                                                                     <i class="bx bx-trash fs-16"></i> Supprimer
                                                                                </a>
                                                                           </div>
                                                                      </div>
                                                                 </td>
                                                                 <!-- <td>
                                                                      <a href="{{ route('admin.formateur.edit', $formateur) }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                      </a>
                                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#deleteFormateur{{ $formateur->id }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                      </a>
                                                                 </td> -->
                                                            </tr>

                                                            @include('include.formateur')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucun formateur sur la plateforme
                                        </h5>
                                   @endif
                                   
                              </div>
                         </div> <!-- end card body pren Vendeur 1-->
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