    <!-- Modal delete-->
    <div class="modal fade" id="deleteAdmin{{ $admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer l'admin <span class="fw-bold">{{ $admin->nom }} {{ $admin->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.admin.destroy', $admin) }}" method="POST">
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