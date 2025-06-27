@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container Fluid -->
          <div class="container-xxl">

                    <div class="row g-1 mb-3">
                         <div class="col-xxl-3">
                              <div class="offcanvas-xxl offcanvas-start h-100" tabindex="-1" id="EmailSidebaroffcanvas" aria-labelledby="EmailSidebaroffcanvasLabel">
                                   <div class="card h-100 mb-0" data-simplebar="">
                                        <div class="card-body">
                                             <div class="d-grid">
                                                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#compose-modal">Catégories</button>
                                             </div>

                                             <div class="nav flex-column mt-3" id="email-tab" role="tablist" aria-orientation="vertical">
                                                  <a class="nav-link px-0 py-1 mb-2 active show" id="email-inbox-tab" data-bs-toggle="pill" href="#allCategorie" role="tab" aria-controls="email-inbox" aria-selected="true">
                                                       <span class="text-danger fw-bold">
                                                            <i class="bx bxs-inbox fs-16 me-2 align-middle"></i> Tout
                                                            <span class="badge badge-soft-danger float-end ms-2">{{ $souscategories->count() }}</span>
                                                       </span>
                                                  </a>

                                                  @foreach($categories as $categorie)
                                                       <a class="nav-link px-0 py-1 mb-2" id="email-starred-tab" data-bs-toggle="pill" href="#categorie{{ $categorie->id }}" role="tab" aria-controls="email-starred" aria-selected="false">
                                                            <i class="bx bx-folder fs-18 align-middle me-2"></i>{{ $categorie->nom }}
                                                       </a>
                                                  @endforeach
                                             </div>


                                             <!-- <div class="mt-5">
                                                  <h4><span class="badge rounded-pill p-1 px-2 badge-soft-secondary">FREE</span></h4>
                                                  <h6 class="text-uppercase mt-3">Storage</h6>
                                                  <div class="progress my-2 progress-sm">
                                                       <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: 46%" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100"></div>
                                                  </div>
                                                  <p class="text-muted font-13 mb-0">7.02 GB (46%) of 15 GB used</p>
                                             </div> -->
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-xxl-9">
                              <div class="card position-relative overflow-hidden h-100">
                                   <div class="p-3">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-2">
                                             <div>
                                                  <h5 class="card-title mb-1 anchor" id="responsive">
                                                       Mes différentes sous catégories 
                                                  </h5>
                                             </div>
                                             <div>
                                                  <a href="#!" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSousCategorie">
                                                       <i class="bx bx-plus me-1"></i>Ajouter
                                                  </a>
                                             </div>
                                        </div> <!-- end row -->
                                        <!-- <div class="d-flex flex-wrap gap-2">
                                             <button class="btn btn-light d-xxl-none d-flex align-items-center px-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#EmailSidebaroffcanvas" aria-controls="EmailSidebaroffcanvas">
                                                  <i class="bx bx-menu fs-18"></i>
                                             </button>

                                             <div class="btn-group">
                                                  <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Archive" data-bs-original-title="Archive">
                                                       <i class="bx bx-archive fs-18"></i>
                                                  </button>
                                                  <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark as spam" data-bs-original-title="Mark as spam">
                                                       <i class="bx bx-info-square fs-18"></i>
                                                  </button>
                                                  <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                                       <i class="bx bx-trash fs-18"></i>
                                                  </button>
                                             </div>

                                             <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Folder">
                                                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="bx bx-folder fs-18"></i>
                                                  </button>
                                                  <div class="dropdown-menu" style="">
                                                       <span class="dropdown-header">Move to</span>
                                                       <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                                  </div>
                                             </div>

                                             <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Labels">
                                                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="bx bx-bookmarks fs-18"></i>
                                                  </button>
                                                  <div class="dropdown-menu" style="">
                                                       <span class="dropdown-header">Label as :</span>
                                                       <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                                  </div>
                                             </div>

                                             <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="More Actions">
                                                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                                                  <div class="dropdown-menu" style="">
                                                       <span class="dropdown-header">More Option :</span>
                                                       <a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Add Star</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                                                  </div>
                                             </div>
                                        </div> -->
                                        

                                        @include('include.message')

                                        <!--
                                        <div class="d-flex flex-wrap gap-2">
                                             <button class="btn btn-light d-xxl-none d-flex align-items-center px-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#EmailSidebaroffcanvas" aria-controls="EmailSidebaroffcanvas">
                                                  <i class="bx bx-menu fs-18"></i>
                                             </button>

                                             
                                             <div class="btn-group">
                                                  <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive">
                                                       <i class="bx bx-archive fs-18"></i>
                                                  </button>
                                                  <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as spam">
                                                       <i class="bx bx-info-square fs-18"></i>
                                                  </button>
                                                  <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                       <i class="bx bx-trash fs-18"></i>
                                                  </button>
                                             </div>

                                             <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Folder">
                                                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="bx bx-folder fs-18"></i>
                                                  </button>
                                                  <div class="dropdown-menu">
                                                       <span class="dropdown-header">Move to</span>
                                                       <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                                  </div>
                                             </div>

                                             <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Labels">
                                                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="bx bx-bookmarks fs-18"></i>
                                                  </button>
                                                  <div class="dropdown-menu">
                                                       <span class="dropdown-header">Label as :</span>
                                                       <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                                  </div>
                                             </div>

                                             <div class="btn-group" data-bs-toggle="tooltip" data-bs-placement="top" title="More Actions">
                                                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                                                  <div class="dropdown-menu">
                                                       <span class="dropdown-header">More Option :</span>
                                                       <a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Add Star</a>
                                                       <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                                                  </div>
                                             </div>
                                        </div>
                                        -->
                                   </div>

                                   <div class="tab-content pt-0" id="email-tabContent">
                                        @if($souscategories->count() > 0)
                                             <div class="tab-pane fade active show" id="allCategorie" role="tabpanel" aria-labelledby="email-inbox-tab">
                                                  <div>
                                                       @if($souscategories->count() > 0)
                                                            <div class="table-responsive">
                                                                 <table class="table table-hover table-centered">
                                                                      <thead class="table-light">
                                                                           <tr>
                                                                                <th scope="col">N°</th>
                                                                                <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Nom</th>
                                                                                <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Categorie</th>
                                                                                <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Nombre Produit</th>
                                                                                <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Action</th>
                                                                           </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                           @php
                                                                                $n = 1;
                                                                           @endphp
                                                                           @foreach($souscategories as $scategorie)
                                                                                <tr>
                                                                                     <td>
                                                                                          <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                                                                                     </td>
                                                                                     <td>{{ $scategorie->nom }}</td>
                                                                                     <td>{{ $scategorie->categorie->nom }}</td>
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
                                                                 Désolé! Vous n'avez ajouté aucune sous catégorie sur la plateformes
                                                            </h5>
                                                       @endif
                                                  </div>
                                             </div>

                                             @foreach($categories as $categorie)
                                                  <div class="tab-pane fade" id="categorie{{ $categorie->id }}" role="tabpanel" aria-labelledby="email-inbox-tab">
                                                       <div>
                                                            @if($categorie->souscategories->count() > 0)
                                                                 <div class="table-responsive">
                                                                      <table class="table table-hover table-centered">
                                                                           <thead class="table-light">
                                                                                <tr>
                                                                                     <th scope="col">N°</th>
                                                                                     <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Nom</th>
                                                                                     <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Categorie</th>
                                                                                     <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Nombre Produit</th>
                                                                                     <th scope="col"><span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>Action</th>
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
                                                                                          <td>{{ $scategorie->categorie->nom }}</td>
                                                                                          <td>                        
                                                                                               <a class="btn btn-sm btn-soft-warning px-3 fw-bold" @if($scategorie->produits->count() > 0) href="{{ route('admin.sous.categorie.produit', $scategorie) }}" @else href="#" @endif>
                                                                                                    {{ $scategorie->produits->count() }}
                                                                                               </a>                                         
                                                                                          </td>
                                                                                          <td>
                                                                                               <a href="#" data-bs-toggle="modal" data-bs-target="#editSousCategorie22{{ $scategorie->id }}">
                                                                                                    <button type="button" class="btn btn-sm btn-soft-secondary me-1"><i class="bx bx-edit fs-16"></i></button>
                                                                                               </a>
                                                                                               <a href="#" data-bs-toggle="modal" data-bs-target="#deleteSousCategorie22{{ $scategorie->id }}">
                                                                                                    <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                                               </a>
                                                                                          </td>
                                                                                     </tr>
                                                                                     @include('include.sous-categorie.sous-categorie2')
                                                                                @endforeach
                                                                           </tbody>
                                                                      </table>
                                                                 </div>
                                                            @else
                                                                 <hr>
                                                                 <div class="px-3">
                                                                      <h5>Désolé! Vous n'avez ajouté aucune sous catégorie dans {{ $categorie->nom }}</h5>
                                                                 </div>
                                                            @endif
                                                       </div>
                                                  </div>
                                             @endforeach
                                             
                                        @else
                                             <hr>
                                             <div class="px-3">
                                                  <h5>Désolé! Vous n'avez ajouté aucune sous catégorie sur la plateforme</h5>
                                             </div>
                                        @endif

                                   </div> <!-- end tab-content-->

                                   <!-- <div class="px-3 py-2 mt-auto">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div class=""> Showing 1 - 20 of 289 </div>
                                             <div class="btn-group">
                                                  <button type="button" class="btn btn-light btn-sm">
                                                       <i class="bx bx-chevron-left"></i>
                                                  </button>
                                                  <button type="button" class="btn btn-primary btn-sm">
                                                       <i class="bx bx-chevron-right"></i>
                                                  </button>
                                             </div>
                                        </div>
                                   </div> -->

                                   <!-- <div class="offcanvas offcanvas-end mail-read position-absolute shadow" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="email-read" aria-labelledby="email-readLabel">
                                        <div class="offcanvas-header">
                                             <div class="d-flex gap-2 align-items-center w-50">
                                                  <a href="#" role="button" data-bs-dismiss="offcanvas" aria-label="Close">
                                                       <i class="bx bx-arrow-back fs-18 align-middle"></i>
                                                  </a>
                                                  <h5 class="offcanvas-title text-truncate w-50" id="email-readLabel">Medium</h5>
                                             </div>

                                             <div class="ms-auto">
                                                  <div class="btn-group">
                                                       <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Archive">
                                                            <i class="bx bx-archive fs-18"></i>
                                                       </button>
                                                       <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark as spam">
                                                            <i class="bx bx-info-square fs-18"></i>
                                                       </button>
                                                       <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete">
                                                            <i class="bx bx-trash fs-18"></i>
                                                       </button>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="offcanvas-body p-0 h-100" data-simplebar>
                                             <div class="px-3">
                                                  <div class="mt-2">
                                                       <h5>Hi Jorge, How are you?</h5>

                                                       <hr />

                                                       <div class="d-flex mb-4 mt-1">
                                                            <img class="me-2 rounded-circle avatar-sm" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image">
                                                            <div class="flex-grow-1">
                                                                 <span class="float-end">07:23 AM</span>
                                                                 <h6 class="m-0">Jonathan Smith</h6>
                                                                 <small class="text-muted">From: jonathan@domain.com</small>
                                                            </div>
                                                       </div>

                                                       <p><b>Hi Jorge...</b></p>
                                                       <div class="text-muted">
                                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                                                 commodo ligula eget dolor. Aenean massa. Cum sociis natoque
                                                                 penatibus et magnis dis parturient montes, nascetur ridiculus
                                                                 mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                                                 quis, sem.</p>
                                                            <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel,
                                                                 aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut,
                                                                 imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede
                                                                 mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                                                                 elementum semper nisi.</p>
                                                            <p>Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor
                                                                 eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                                                                 dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra
                                                                 nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.
                                                                 Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies
                                                                 nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                                                                 condimentum rhoncus, sem quam semper libero, sit amet adipiscing
                                                                 sem neque sed ipsum. Nam quam nunc, blandit vel, luctus
                                                                 pulvinar,</p>
                                                       </div>

                                                       <hr />

                                                       <h6> <i class="fa fa-paperclip mb-2"></i> Attachments <span>(3)</span>
                                                       </h6>

                                                       <div>
                                                            <a href="javascript:void(0);">
                                                                 <img src="assets/images/small/img-1.jpg" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                 <img src="assets/images/small/img-2.jpg" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                 <img src="assets/images/small/img-3.jpg" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                            </a>
                                                       </div>

                                                  </div>
                                             </div>
                                        </div>
                                        <div class="p-3">
                                             <div class="d-flex">
                                                  <img class="me-2 rounded-circle avatar-sm" src="assets/images/users/avatar-7.jpg" alt="Generic placeholder image">
                                                  <div class="flex-grow-1">
                                                       <div class="mb-2">
                                                            <div id="snow-editor" style="height: 200px;">
                                                                 <h3>This is an Air-mode editable area.</h3>
                                                                 <p><br></p>
                                                                 <ul>
                                                                      <li>Select a text to reveal the toolbar.</li>
                                                                      <li>Edit rich document on-the-fly, so elastic!</li>
                                                                 </ul>
                                                                 <p><br></p>
                                                                 <p>End of air-mode area</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="text-end">
                                                  <button type="button" class="btn btn-primary width-sm" data-bs-dismiss="offcanvas" aria-label="Close">Send</button>
                                             </div>
                                        </div>
                                   </div> -->

                              </div> <!-- end card -->
                         </div> <!-- end col -->
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