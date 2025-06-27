@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container xxl -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card overflow-hidden">
                                   <div class="card-body">
                                        <div class="bg-primary profile-bg rounded-top position-relative mx-n3 mt-n3">
                                             @if(auth()->user()->photo)
                                                  <img src="{{ asset(Storage::url(auth()->user()->photo)) }}" alt="" class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5">
                                             @else
                                                  <img src="{{ asset("admin/assets/images/users/avatar-1.jpg") }}" alt="" class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5">
                                             @endif
                                        </div>
                                        <div class="mt-5 d-flex flex-wrap align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="mb-1">{{ auth()->user()->nom }} {{ auth()->user()->prenom }} <i class='bx bxs-badge-check text-success align-middle'></i></h4>
                                                  <p class="mb-0">Administrateur</p>
                                             </div>
                                             <div class="d-flex align-items-center gap-2 my-2 my-lg-0">
                                                  <!-- <a href="#!" class="btn btn-info"><i class='bx bx-message-dots'></i> Message</a> -->
                                                  <a href="#!" class="btn btn-outline-primary"><i class="bx bx-plus"></i> Follow</a>
                                             </div>
                                        </div>
                                        @include('include.message')
                                        <div class="row mt-3 gy-2">
                                             <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                             @csrf
                                                  <div class="row mb-3">
                                                       <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label for="nom" class="form-label">Nom *</label>
                                                                 <input type="text" name="nom" id="nom" value="{{ auth()->user()->nom }}" class="form-control" required>
                                                                 @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>

                                                       <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label for="prenom" class="form-label">Prenom *</label>
                                                                 <input type="text" name="prenom" id="prenom" value="{{ auth()->user()->prenom }}" class="form-control" required>
                                                                 @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>
                                                       
                                                       <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label for="contact" class="form-label">Contact *</label>
                                                                 <input type="number" name="contact" id="contact" value="{{ auth()->user()->contact }}" class="form-control" required>
                                                                 @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>
                                                       
                                                       <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label for="email" class="form-label">Email *</label>
                                                                 <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="form-control" required>
                                                                 @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>
                                                       
                                                       <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                 <label for="photo" class="form-label">Nouvelle photo (facultatif)</label>
                                                                 <input type="file" name="photo" id="photo" class="form-control">
                                                                 @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>

                                                       <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label for="identifiant" class="form-label">Identifiant *</label>
                                                                 <input type="text" name="identifiant" id="identifiant" value="{{ auth()->user()->identifiant }}" class="form-control" required>
                                                                 @error('identifiant') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>

                                                       <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label for="password" class="form-label">nouveau password (facultatif)</label>
                                                                 <input type="password" name="password" id="identifiant" value="{{ old('password') }}" class="form-control">
                                                                 @error('password') <span class="text-danger"> {{ $message }} </span> @enderror
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="p-3 bg-light mb-3 rounded">
                                                       <div class="row justify-content-end g-2">
                                                            <div class="col-lg-2">
                                                                 <button type="submit" class="btn btn-outline-secondary w-100">Modifier</button>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>

                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          <!-- End Container Fluid -->

                      
@endsection