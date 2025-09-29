@extends('dashboard.ressource.ange.layout.app')
@section('body')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


       <!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Demande de congé</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('conge.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom"  >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="numero">Numéro</label>
                        <input type="text" class="form-control" name="numero" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date_debut">Date de début</label>
                        <input type="date" class="form-control" name="date_debut" value="{{ old('date_debut') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_fin">Date de fin</label>
                        <input type="date" class="form-control" name="date_fin" value="{{ old('date_fin') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="motif">Motif</label>
                    <input type="text" class="form-control" name="motif" value="{{ old('motif') }}" required>
                </div>

                <div class="form-group">
                    <label for="explication">Explication</label>
                    <textarea class="form-control" name="explication" rows="4">{{ old('explication') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="fichier">Document justificatif (optionnel)</label>
                    <input type="file" class="form-control-file" name="fichier" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Envoyer la demande
                </button>
            </form>
        </div>
    </div>
</div>

                 

           
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    

@endsection