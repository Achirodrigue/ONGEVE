    <!-- Modal delete-->
    <div class="modal fade" id="deleteVendeur{{ $vendeur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer le vendeur <span class="fw-bold">{{ $vendeur->nom }} {{ $vendeur->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.vendeur.destroy', $vendeur) }}" method="POST">
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

    <div class="modal fade" id="imageModal{{ $vendeur->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 500px;">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <img src="{{ asset(Storage::url($vendeur->logo)) }}" class="modal-img" style="width: 100%;" alt="Image agrandie">
                </div>
            </div>
        </div>
    </div>