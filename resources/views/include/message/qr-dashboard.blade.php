    @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show m-3" role="alert" style="font-size:1em;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif    

    @if(session('error'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert" style="font-size:1em;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif  
    
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert" style="font-size:1em;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif


