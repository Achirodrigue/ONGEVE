    <!-- Modal delete-->
    <div class="modal fade" id="AnnulerLivraisonCommande{{ $commandelivreur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment annuler la commande de <span class="fw-bold text-warning">{{ $commandelivreur->livreur->nom }} {{ $commandelivreur->livreur->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.annuler.livraison.commmande.encours', $commandelivreur) }}" method="POST">
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
    

    <!-- Modal valider-->
    <div class="modal fade" id="validerCommande{{ $commandelivreur->commande->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation de commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment valider la commande de <span class="fw-bold">{{ $commandelivreur->commande->client->nom }} {{ $commandelivreur->commande->client->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.validation.commande', $commandelivreur->commande) }}" method="POST">
                @csrf
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
