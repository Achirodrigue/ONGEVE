@extends('dashboard.ressource.ange.layout.app')
@section('body')

    <!-- Page Wrapper -->
    <div id="wrapper">


                <!-- Begin Page Content -->
                <div class="container-fluid">


       <!-- Begin Page Content -->
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Liste des vehicule </h1>
  </div>



@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @foreach ($vehicules as $v)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                @if ($v->photo)
                    <img src="{{ asset('storage/' . $v->photo) }}" class="card-img-top" alt="Photo du véhicule">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $v->marque }} {{ $v->modele }}</h5>
                    <p>Immatriculation : <strong>{{ $v->immatriculation }}</strong></p>
                    <p>Type : {{ $v->type }}</p>
                    <p>Disponibilité : 
                        <span class="badge bg-{{ $v->disponible ? 'success' : 'danger' }}">
                            {{ $v->disponible ? 'Disponible' : 'Réservé' }}
                        </span>
                    </p>

                    @if ($v->disponible)
                        <a href="{{ route('vehicules.emprunterForm', $v->id) }}" class="btn btn-success">Emprunter</a>
                    @else
                        <a href="{{ route('vehicules.retourForm', $v->id) }}" class="btn btn-warning">Retourner</a>

                    @endif

                </div>
            </div>
        </div>
    @endforeach
</div>


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   
 
          </div>



 

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    

@endsection