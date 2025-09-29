@extends('dashboard.ressource.ange.layout.app')
@section('body')

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Documents</h1>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demandeModal">
    Mes demandes de documents
</button>

                </div>
<!-- Modal -->
<div class="modal fade" id="demandeModal" tabindex="-1" role="dialog" aria-labelledby="demandeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ route('demandes-documents.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Demande de document</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nom du demandeur</label>
                    <input type="text" class="form-control" name="nom_demandeur" required>
                </div>

                <div class="form-group">
                    <label>Prénoms du demandeur</label>
                    <input type="text" class="form-control" name="prenoms_demandeur" required>
                </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Type de document</label>
                    <input type="text" class="form-control" name="type_document" required>
                </div>

                <div class="form-group">
                    <label>Titre du document</label>
                    <input type="text" class="form-control" name="titre_document">
                </div>

                <div class="form-group">
                    <label>Destinataire</label>
                    <select class="form-control" name="destinataire_id" required>
@foreach(\App\Models\User::where('role', 'rh')->get() as $user)
    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenoms }} ({{ $user->email }})</option>
@endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
            </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
    function openModal() {
        $('#demandeModal').modal('show');
    }
</script>


    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Titre</th>
                    <th>Destinataire</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $index => $demande)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($demande->type_document) }}</td>
                        <td>{{ $demande->titre_document ?? '-' }}</td>
                        <td>{{ $demande->destinataire->nom }} {{ $demande->destinataire->prenoms }}</td>
                        <td>
                            @if($demande->statut === 'en attente')
                                <span style="color: orange;">🕒 En attente</span>
                            @elseif($demande->statut === 'validée')
                                <span style="color: green;">✅ Validée</span>
                            @else
                                <span style="color: red;">❌ Rejetée</span>
                            @endif
                        </td>
                        <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">Aucune demande trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <footer>
        Total : {{ count($demandes) }} demande(s)

    </footer>
                </div>
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    

@endsection