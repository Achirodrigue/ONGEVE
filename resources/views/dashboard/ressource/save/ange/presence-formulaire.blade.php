@extends('dashboard.ressource.ange.layout.app')
@section('body')

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">



       <!-- Begin Page Content -->
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">veuillez remplie le formulaire</h1>

  </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('info')) <div class="alert alert-info">{{ session('info') }}</div> @endif
    @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
<div >
    <form action="{{ route('presence.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label>Nom</label>
                <select name="nom" class="form-control" required>
                    <option value="">Sélectionner</option>
                    @foreach($employes as $emp)
                        <option>{{ $emp->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Prénoms</label>
                <select name="prenoms" class="form-control" required>
                    <option value="">Sélectionner</option>
                    @foreach($employes as $emp)
                        <option>{{ $emp->prenoms }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="votre email">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
            </div>
        </div>
    </form>



            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    

@endsection