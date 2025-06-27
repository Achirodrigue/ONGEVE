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
                                                  Mes différents Administrateurs de la plateformes <a class="anchor-link" href="#responsive">#</a>
                                             </h5>
                                        </div>
                                        @if(auth()->user()->role)
                                             <div>
                                                  <a href="{{ route('admin.admin.create') }}" class="btn btn-primary">
                                                       <i class="bx bx-plus me-1"></i>Ajouter
                                                  </a>
                                             </div>
                                        @endif
                                   </div> <!-- end row -->

                                   @include('include.message')

                              </div> <!-- end row -->
                              <div class="card-body">
                                   @if($admins->count() > 0)
                                        <div class="table-responsive">
                                             <table class="table table-hover table-centered">
                                                  <thead class="table-light">
                                                       <tr>
                                                            <th scope="col">N°</th>
                                                            <th scope="col">Nom et Prenom</th>
                                                            <th scope="col">Contact</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Compte</th>
                                                            <th scope="col">Role</th>
                                                            <th scope="col">Secteur</th>
                                                            <th scope="col">Photo</th>
                                                            @if(auth()->user()->role)
                                                                 <th scope="col">identifiant</th>
                                                                 <th scope="col">Action</th>
                                                            @endif
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($admins as $admin)
                                                            <tr>
                                                                 <td>
                                                                      <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                 </td>
                                                                 <td>{{ $admin->nom }} {{ $admin->prenom }}</td>
                                                                 <td>{{ $admin->contact }}</td>
                                                                 <td>{{ $admin->email }}</td>
                                                                 <td>
                                                                      @if($admin->role)
                                                                           <a href="#">   
                                                                                <span><button type="button" title="Désactiver" class="btn-sm disabled-btn">
                                                                                     @if($admin->isvalide) Activé @else Bloqué @endif
                                                                                </button></span>
                                                                           </a>
                                                                      @else 
                                                                           <a  href="{{ route('admin.admin.compte.update', $admin) }}" href="#">   
                                                                                <span><button type="button" class="btn btn-sm @if($admin->isvalide) btn-warning @else btn-danger @endif">
                                                                                     @if($admin->isvalide) Activé @else Bloqué @endif
                                                                                </button></span>
                                                                           </a> 
                                                                      @endif
                                                                 </td>
                                                                 <td>
                                                                      <span><button type="button" class="btn btn-sm @if($admin->role) btn-light @else btn-success @endif">
                                                                           @if($admin->role) Superviseur @else @if($admin->adminsecteur->secteur_id) Admin @else Super Admin @endif @endif
                                                                      </button></span>
                                                                 </td>
                                                                 <td>
                                                                      @if($admin->role) 
                                                                           <span class="text-danger">Tout</span>
                                                                      @else
                                                                           @if($admin->adminsecteur?->secteur_id === null)
                                                                                <span class="text-danger">Tout</span>
                                                                           @else
                                                                                <span class="text-warning">{{ $admin->adminsecteur->secteur->nom }}</span>
                                                                           @endif
                                                                      @endif
                                                                 </td>
                                                                 <td>
                                                                      @if($admin->photo)
                                                                           <div class="swiper-slide avatar-sm">
                                                                                <div class="chat-user-status-box">
                                                                                     <span><img src="{{ asset(Storage::url($admin->photo)) }}" alt="avatar-2" class="img-fluid avatar-sm rounded-circle avatar-border" /></span>
                                                                                </div>
                                                                           </div>
                                                                      @else Aucune @endif
                                                                 </td>
                                                                 @if(auth()->user()->role)
                                                                      <td>{{ $admin->identifiant }}</td>
                                                                      <td>
                                                                           @if(!$admin->role)
                                                                                <div class="dropdown">
                                                                                     <a href="javascript:void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                          <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                                                     </a>
                                                                                     <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 22.4px, 0px);">
                                                                                          <a href="{{ route('admin.admin.edit', $admin) }}" class="dropdown-item">
                                                                                               <i class="bx bx-edit fs-16"></i> Modifier
                                                                                          </a>
                                                                                          <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteAdmin{{ $admin->id }}">
                                                                                               <i class="bx bx-trash fs-16"></i> Supprimer
                                                                                          </a>
                                                                                          <a href="{{ route('admin.superadmin.autorise.update', $admin) }}" class="dropdown-item">
                                                                                               <i class="bx bx-check fs-16"></i> @if($admin->autorise)<span class="text-warning">Autorisation</span>  @else <span class="text-danger">Non Autorisé</span> @endif
                                                                                          </a>
                                                                                     </div>
                                                                                </div>
                                                                                <!-- <a href="{{ route('admin.admin.edit', $admin) }}">
                                                                                     <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                                </a>
                                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteAdmin{{ $admin->id }}">
                                                                                     <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                                </a>
                                                                                @if($admin->adminsecteur?->secteur_id === null)
                                                                                     <a href="{{ route('admin.superadmin.autorise.update', $admin) }}">
                                                                                          <button type="button" class="btn btn-sm btn-soft-secondary me-1">
                                                                                               <i class="bx bx-check fs-16"></i>
                                                                                               @if($admin->autorise) <span class="warning">Autorisation</span>  @else <span class="danger">Non Autorisé</span> @endif
                                                                                          </button>
                                                                                     </a>
                                                                                @endif -->
                                                                           @else 
                                                                                <a href="#">
                                                                                     <button type="button" class="btn-sm disabled-btn me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                                </a>
                                                                                <a href="#">
                                                                                     <button type="button" class="btn-sm disabled-btn"><i class="bx bx-trash fs-16"></i></button>
                                                                                </a>
                                                                           @endif
                                                                      </td>
                                                                 @endif
                                                            </tr>

                                                            @include('include.admin')
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                        </div>
                                   @else
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucun admin sur la plateformes
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