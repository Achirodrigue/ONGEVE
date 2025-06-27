    <!-- Modal delete-->
    <div class="modal fade" id="deleteEquipe{{ $equipe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer le membre <span class="fw-bold">{{ $equipe->nom }} {{ $equipe->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.equipe.destroy', $equipe) }}" method="POST">
                @csrf
                @method('DELETE')
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>