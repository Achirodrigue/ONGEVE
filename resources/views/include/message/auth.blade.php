
    @if(session('error'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert" style="font-size:1em; z-index: 1050;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif    
