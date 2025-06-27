    @if(session('success'))
        <div class="alert alert-simple alert-warning alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="font-size:0.8em; z-index: 1050;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif    

    @if(session('errorP'))
        <div class="alert alert-errorP alert-warning alert-dismissible fade show position-fixed top-50 start-50 translate-middle d-flex align-items-center flex-column" role="alert" style="font-size: 0.9em; z-index: 1050;">
            <span>{{ session('errorP') }}</span>
            <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Fermer"></button>
            <a href="{{ route('mon.panier') }}">
                <button type="button" class="btn btn-primary btn-sm me-2 mt-3">Voir panier</button>
            </a>
        </div>
    @endif

    @if(session('Mfacture'))
        @php
            $client = session('client');
            $commande = session('commande');
        @endphp
        <div class="alert alert-Mfacture alert-warning alert-dismissible fade show position-fixed top-50 start-50 translate-middle d-flex align-items-center flex-column" role="alert" style="font-size: 0.9em; z-index: 1050;">
            <span>{{ session('Mfacture') }}</span>
            <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Fermer"></button>
            <a href="{{ route('pdf.commande', ['client' => $client, 'commande' => $commande]) }}" target="_blank">
                <button type="button" class="btn btn-primary btn-sm me-2 mt-3">    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                    </svg>
                    Télécharger la facture
                </button>
            </a>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-simple alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="font-size:0.8em; z-index: 1050;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif


    <!-- 
        @if(session('success'))
            <div class="alert alert-success position-fixed top-0 end-0 m-3" role="alert" style="z-index: 1050;">
                {{ session('success') }}
            </div>
        @endif 
    -->

    <!-- 
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        @if(session('success'))
            <script>
                Toastify({
                    text: "{{ session('success') }}",
                    duration: -1, // Ne disparaît pas automatiquement
                    close: true,  // Ajoute une croix de fermeture
                    gravity: "top",
                    position: "right",
                    backgroundColor: "green",
                }).showToast();
            </script>
        @endif 
    -->
