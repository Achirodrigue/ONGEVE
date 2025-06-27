@extends('dashboard.admin.layout.app')
@section('body')


          <!-- Start Container Fluid -->
          <div class="container-xxl">

               <!-- Start here.... -->
               <div class="row">
                    <div class="col">
                         <div class="card">
                              <div class="card-header">
                                   <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                             <h5 class="card-title mb-1 anchor" id="responsive">
                                                  Mes différents messages reçus 
                                             </h5>
                                        </div>
                                        @if($messages->count() > 0)
                                             <div>
                                                  <a href="{{ route('admin.message.destroy.all') }}" class="btn btn-primary">
                                                       <i class="bx bx-trash me-1"></i>Tout supprimmer
                                                  </a>
                                             </div>
                                        @endif
                                   </div> <!-- end row -->

                                   @include('include.message')
                              </div>
                              @if($messages->count() > 0)
                                   <div>
                                        <div class="table-responsive table-centered">
                                             <table class="table text-nowrap mb-0">
                                                  <thead class="bg-light bg-opacity-50">
                                                       <tr>
                                                            <th class="border-0 py-2">N°</th>
                                                            <th class="border-0 py-2">Nom et Prenom</th>
                                                            <th class="border-0 py-2">Email</th>
                                                            <th class="border-0 py-2">Contact</th>
                                                            <th class="border-0 py-2">Objet</th>
                                                            <th class="border-0 py-2">Message</th>
                                                            <th class="border-0 py-2">Action</th>
                                                       </tr>
                                                  </thead> <!-- end thead-->
                                                  <tbody>
                                                       @php
                                                            $n = 1;
                                                       @endphp
                                                       @foreach($messages as $message)
                                                            <tr>
                                                                 <!-- <td>
                                                                      <div class="d-flex align-items-center gap-2">
                                                                           <div class="form-check form-todo ps-4">
                                                                                <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-18" id="customCheck1">
                                                                                <label class="form-check-label" for="customCheck1">Review system logs for any reported errors</label>
                                                                           </div>
                                                                      </div>
                                                                 </td> -->
                                                                 <td>{{ $n++ }}</td>
                                                                 <td>{{ $message->nom_prenom }}</td>
                                                                 <td>{{ $message->email }}</td>
                                                                 <td>{{ $message->contact }}</td>
                                                                 <td>{{ $message->objet }}</td>
                                                                 <td>{{ $message->message }}</td>
                                                                 <td>
                                                                      <a href="{{ route('admin.message.destroy', $message) }}">
                                                                           <button type="button" class="btn btn-sm btn-soft-danger"><i class="bx bx-trash fs-16"></i></button>
                                                                      </a>
                                                                 </td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody> <!-- end tbody -->
                                             </table> <!-- end table -->
                                        </div> <!-- table responsive -->
                                        
                                        <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                                             <div class="col-sm-auto mt-3 mt-sm-0">
                                                  <ul class="pagination pagination-rounded m-0">
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">{{ $messages->links() }}</a>
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              @else
                                   <div class="card-body">
                                        <h5 class="card-title mb-1 anchor" id="responsive">
                                             Désolé! Vous n'avez ajouté aucune catégorie sur la plateformes
                                        </h5>
                                   </div> <!-- end card body -->
                              @endif
                         </div> <!-- end card -->
                    </div> <!-- end col -->
               </div> <!-- end row -->

          </div>
          <!-- End Container Fluid -->


                      
@endsection