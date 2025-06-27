    <!-- Modal delete-->
    <div class="modal fade" id="confirmerFinaliteFormation{{ $formationformateur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment confirmer la finalité de la formation en <span class="fw-bold">{{ $formationformateur->formation->nom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.confirmation.formation.terminer.store', $formationformateur->formation) }}" method="POST">
                @csrf
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
