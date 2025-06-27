@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row justify-content-center">
                         <div class="col-lg-12">
                              <div class="card overflow-hidden" style="background: url('/admin/assets/images/small/img-2.jpg'); ">
                                   <div class="position-absolute top-0 end-0 bottom-0 start-0 bg-dark opacity-75"></div>
                                   <div class="card-body">
                                        <div class="row justify-content-center">
                                             <div class="col-lg-7 text-center">
                                                  <h3 class="text-white">Astuces et Conseils</h3>
                                                  <p class="text-white-50">Bienvenue dans notre espace dédié aux astuces et conseils !</p>
                                                  <!-- <p>
                                                  Bienvenue dans notre espace dédié aux astuces et conseils ! 🚀 Ici, vous trouverez des recommandations pratiques, des idées innovantes et des solutions efficaces pour optimiser votre expérience. Que ce soit pour améliorer votre productivité, gérer vos projets ou découvrir de nouvelles méthodes, nous partageons avec vous les meilleures pratiques pour vous aider à avancer en toute sérénité.

                                                  Restez informé et boostez vos compétences avec nos conseils avisés ! 💡
                                                  </p> -->
                                                  <!-- <div class="search-bar">
                                                       <span><i class="bx bx-search-alt"></i></span>
                                                       <input type="search" class="form-control rounded-pill bg- border-0" id="search" placeholder="Search ...">
                                                  </div> -->
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="card-header">
                         <div class="d-flex flex-wrap align-items-center justify-content-between gap-3" style="justify-content: flex-end !important;"> 
                              <div>
                                   <a href="{{ route('admin.conseilastuce.create') }}"
                                        class="btn btn-success me-1"><i class="bx bx-plus"></i>
                                        Nouveau Conseil/Astuce
                                   </a>
                              </div>
                         </div> <!-- end row -->

                         @include('include.message')
                    </div>

                    <div class="row mt-4">
                         <div class="col">
                              <div class="card">
                                   <div class="card-body p-4">
                                        <div class="row g-xl-4">
                                             <div class="col-xl-6">                                             
                                                  <h4 class="mb-3 fw-semibold fs-16">Astuces</h4>
                                                  <!-- FAQs -->
                                                  @if($conseilastuces->where("type", 0)->count() > 0)
                                                       <div class="accordion">
                                                            @foreach($conseilastuces->where("type", 0) as $conseilastuce)
                                                                 <div class="accordion-item">
                                                                      <h2 class="accordion-header">
                                                                           <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#conseilAstuce{{ $conseilastuce->id }}" aria-expanded="false" aria-controls="conseilAstuce{{ $conseilastuce->id }}">
                                                                                {{ $conseilastuce->titre }}
                                                                           </button>
                                                                      </h2>
                                                                      <div id="conseilAstuce{{ $conseilastuce->id }}" class="accordion-collapse collapse" aria-labelledby="conseilAstuce{{ $conseilastuce->id }}">
                                                                           <div class="chat-conversation-actions dropdown dropend mt-2">
                                                                                <a href="javascript: void(0);" class="ps-1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded fs-18"></i></a>
                                                                                <div class="dropdown-menu">
                                                                                     <!-- 
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-share me-2"></i>Reply
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-share-alt me-2"></i>Forward
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-copy me-2"></i>Copy
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-bookmark me-2"></i>Bookmark
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-star me-2"></i>Starred
                                                                                          </a> 
                                                                                     -->
                                                                                     <a class="dropdown-item" href="{{ route('admin.conseilastuce.edit', $conseilastuce) }}">
                                                                                          <i class="bx bx-info-square me-2"></i>Modifier
                                                                                     </a>
                                                                                     <form action="{{ route('admin.conseilastuce.destroy', $conseilastuce) }}">
                                                                                          <button type="submit" class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-trash me-2"></i>Supprimer
                                                                                          </button>
                                                                                     </form>
                                                                                </div>
                                                                           </div>
                                                                           <div class="accordion-body">
                                                                                {{ $conseilastuce->contenu }}
                                                                           </div>
                                                                           @if($conseilastuce->fichier)
                                                                                @if(pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "png" ||
                                                                                     pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "jpg" ||
                                                                                     pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "jpeg")

                                                                                     <div class="chat-conversation-text ms-0">
                                                                                          <div class="chat-ctext-wrap text-center">
                                                                                               <a href="javascript:void(0);">
                                                                                                    <img src="{{ asset(Storage::url($conseilastuce->fichier)) }}" alt="attachment" style="height: 100px;" class="img-thumbnail me-1">
                                                                                               </a>
                                                                                          </div>
                                                                                     </div>
                                                                                     <!-- <div class="chat-conversation-text ms-0">
                                                                                          <div class="chat-ctext-wrap text-center">
                                                                                               <a href="javascript:void(0);">
                                                                                                    <img src="{{ asset("admin/assets/images/small/img-1.jpg") }}" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                                                               </a>
                                                                                          </div>
                                                                                     </div> -->
                                                                                @else
                                                                                     <div class="chat-conversation-text ms-0">
                                                                                          <div class="chat-ctext-wrap text-center">
                                                                                               <video controls style="height: auto; width: 80%;" class="img-thumbnail me-1">
                                                                                                    <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/mp4">
                                                                                                    <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/mp3">
                                                                                                    <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/avi">
                                                                                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                                                                               </video>

                                                                                               <!-- <iframe src="{{ asset("admin/video/eveil.mp4") }}" autoplay="false" frameborder="0" style="height: auto;" class="img-thumbnail me-1"></iframe> -->
                                                                                          </div>
                                                                                     </div>
                                                                                @endif
                                                                           @endif
                                                                           <!--     
                                                                                <ul>           
                                                                                     <li class="clearfix">
                                                                                          <div class="chat-conversation-text ms-0">
                                                                                               <div class="d-flex">
                                                                                                    <div class="chat-ctext-wrap">
                                                                                                         <a href="javascript:void(0);">
                                                                                                              <img src="{{ asset("admin/assets/images/small/img-1.jpg") }}" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                                                                         </a>
                                                                                                         <iframe src="{{ asset("admin/video/eveil.mp4") }}" frameborder="0" style="height: auto;" class="img-thumbnail me-1"></iframe>
                                                                                                    </div>
                                                                                                    <div class="chat-conversation-actions dropdown dropend">
                                                                                                         <a href="javascript: void(0);" class="ps-1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded fs-18"></i></a>
                                                                                                         <div class="dropdown-menu">
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-share me-2"></i>Reply
                                                                                                              </a>
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-share-alt me-2"></i>Forward
                                                                                                              </a>
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-copy me-2"></i>Copy
                                                                                                              </a>
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-bookmark me-2"></i>Bookmark
                                                                                                              </a>
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-star me-2"></i>Starred
                                                                                                              </a>
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-info-square me-2"></i>Mark as Unread
                                                                                                              </a>
                                                                                                              <a class="dropdown-item" href="javascript: void(0);">
                                                                                                                   <i class="bx bx-trash me-2"></i>Delete
                                                                                                              </a>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </div>
                                                                                               <p class="text-muted fs-12 mb-0 mt-1 ms-2">8:26 am</p>
                                                                                          </div>
                                                                                     </li>
                                                                                </ul>
                                                                           -->
                                                                      </div>
                                                                 </div>
                                                            @endforeach
                                                       </div>
                                                  @else
                                                       <h4 class="mb-3 mt-4 fw-semibold fs-16 text-danger">Désolé! Aucune astuce publié sur la plateforme</h4>
                                                  @endif
                                             </div>

                                             <div class="col-xl-6">
                                                  <h4 class="mb-3 fw-semibold fs-16">Conseils</h4>
                                                  @if($conseilastuces->where("type", 1)->count() > 0)
                                                       <div class="accordion">
                                                            @foreach($conseilastuces->where("type", 1) as $conseilastuce)
                                                                 <div class="accordion-item">
                                                                      <h2 class="accordion-header">
                                                                           <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#conseilAstuce{{ $conseilastuce->id }}" aria-expanded="true" aria-controls="conseilAstuce{{ $conseilastuce->id }}">
                                                                                {{ $conseilastuce->titre }}
                                                                           </button>
                                                                      </h2>
                                                                      <div id="conseilAstuce{{ $conseilastuce->id }}" class="accordion-collapse collapse" aria-labelledby="conseilAstuce{{ $conseilastuce->id }}">
                                                                           <div class="chat-conversation-actions dropdown dropend mt-2">
                                                                                <a href="javascript: void(0);" class="ps-1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded fs-18"></i></a>
                                                                                <div class="dropdown-menu">
                                                                                     <!-- 
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-share me-2"></i>Reply
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-share-alt me-2"></i>Forward
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-copy me-2"></i>Copy
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-bookmark me-2"></i>Bookmark
                                                                                          </a>
                                                                                          <a class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-star me-2"></i>Starred
                                                                                          </a> 
                                                                                     -->
                                                                                     <a class="dropdown-item" href="{{ route('admin.conseilastuce.edit', $conseilastuce) }}">
                                                                                          <i class="bx bx-info-square me-2"></i>Mark as Unread
                                                                                     </a>
                                                                                     <form action="{{ route('admin.conseilastuce.destroy', $conseilastuce) }}">
                                                                                          <button type="submit" class="dropdown-item" href="javascript: void(0);">
                                                                                               <i class="bx bx-trash me-2"></i>Delete
                                                                                          </button>
                                                                                     </form>
                                                                                </div>
                                                                           </div>
                                                                           <div class="accordion-body">
                                                                                {{ $conseilastuce->contenu }}
                                                                           </div>
                                                                           @if($conseilastuce->fichier)
                                                                                @if(pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "png" ||
                                                                                     pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "jpg" ||
                                                                                     pathinfo($conseilastuce->fichier, PATHINFO_EXTENSION) == "jpeg")

                                                                                     <div class="chat-conversation-text ms-0">
                                                                                          <div class="chat-ctext-wrap text-center">
                                                                                               <a href="javascript:void(0);">
                                                                                                    <img src="{{ asset(Storage::url($conseilastuce->fichier)) }}" alt="attachment" style="height: 100px;" class="img-thumbnail me-1">
                                                                                               </a>
                                                                                          </div>
                                                                                     </div>
                                                                                     <!-- <div class="chat-conversation-text ms-0">
                                                                                          <div class="chat-ctext-wrap text-center">
                                                                                               <a href="javascript:void(0);">
                                                                                                    <img src="{{ asset("admin/assets/images/small/img-1.jpg") }}" alt="attachment" style="height: 84px;" class="img-thumbnail me-1">
                                                                                               </a>
                                                                                          </div>
                                                                                     </div> -->
                                                                                @else
                                                                                     <div class="chat-conversation-text ms-0">
                                                                                          <div class="chat-ctext-wrap text-center">
                                                                                               <video controls style="height: auto; width: 80%;" class="img-thumbnail me-1">
                                                                                                    <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/mp4">
                                                                                                    <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/mp3">
                                                                                                    <source src="{{ asset(Storage::url($conseilastuce->fichier)) }}" type="video/avi">
                                                                                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                                                                               </video>

                                                                                               <!-- <iframe src="{{ asset("admin/video/eveil.mp4") }}" autoplay="false" frameborder="0" style="height: auto;" class="img-thumbnail me-1"></iframe> -->
                                                                                          </div>
                                                                                     </div>
                                                                                @endif
                                                                           @endif
                                                                      </div>
                                                                 </div>
                                                            @endforeach
                                                       </div>
                                                  @else
                                                       <h4 class="mb-3 mt-4 fw-semibold fs-16 text-danger">Désolé! Aucun conseil publié sur la plateforme</h4>
                                                  @endif
                                             </div>
                                        </div> <!-- end row-->

                                        <!-- <div class="row my-5">
                                             <div class="col-12 text-center">
                                                  <h4>Can't find a questions?</h4>
                                                  <button type="button" class="btn btn-success mt-2"><i class="bx bx-envelope me-1"></i> Email us your question</button>
                                                  <button type="button" class="btn btn-info mt-2 ms-1"><i class="bx bxl-twitter me-1"></i> Send us a tweet</button>
                                             </div>
                                        </div> -->

                                   </div> <!-- end card-body-->
                              </div> <!-- end card-->
                         </div> <!-- end col-->
                    </div>

               </div>
               <!-- End Container xxl -->


@endsection