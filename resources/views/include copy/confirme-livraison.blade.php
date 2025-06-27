
    <!-- Modal confirme commande-->
    <div class="modal fade" id="confirmeLivraison{{ $commandelivreur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment confirmer la livraison de la commande de <span class="fw-bold">{{ $commandelivreur->commande->client->nom }} {{ $commandelivreur->commande->client->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('livreur.valider.livraison.commande.store', $commandelivreur) }}" method="POST">
                @csrf
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
