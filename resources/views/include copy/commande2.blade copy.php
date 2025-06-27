    <!-- Modal modif -->
    <div class="modal fade" id="AffecterLivreurCommande{{ $commandesecteur->commande->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Affecter un livreur à la commande de <span class="text-warning">{{ $commandesecteur->commande->client->nom }} {{ $commandesecteur->commande->client->prenom }}</span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.affectation.commmande.store', $commandesecteur->commande) }}" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="category-title" class="form-label">Livreur</label>
                                        <select name="livreur_id" id="" class="form-control" required>
                                            @foreach($livreurs as $livreur)
                                                <option value="{{ $livreur->id }}">
                                                    {{ $livreur->nom }} {{ $livreur->prenom }} : 
                                                    <span class="text-warning">
                                                        @if($livreur->admin->adminsecteur?->secteur_id === null)
                                                            Tout
                                                        @else
                                                            {{ $$livreur->admin->adminsecteur->secteur->nom }}
                                                        @endif
                                                    </span>
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('livreur_id') <span class="text-danger"> {{ $message }} </span> @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Retour</button>
                            <button type="submit" class="btn btn-secondary">Affecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal delete-->
    <div class="modal fade" id="deleteCommande{{ $commandesecteur->commande->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la commande de <span class="fw-bold">{{ $commandesecteur->commande->client->nom }} {{ $commandesecteur->commande->client->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.commande.destroy', $commandesecteur->commande) }}" method="POST">
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
    <div class="modal fade" id="validerCommande{{ $commandesecteur->commande->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation de commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment valider la commande de <span class="fw-bold">{{ $commandesecteur->commande->client->nom }} {{ $commandesecteur->commande->client->prenom }}</span> ??</p>
                </div>
                <form action="{{ route('admin.validation.commande', $commandesecteur->commande) }}" method="POST">
                @csrf
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal delete-->
    <div class="modal fade" id="deleteCommandeGenerale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la liste de toutes les commandes ??</p>
                </div>
                <form action="{{ route('admin.commande.destroy.general') }}" method="POST">
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