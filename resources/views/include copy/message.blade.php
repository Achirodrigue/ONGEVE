    @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="font-size:0.8em; z-index: 1050;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif    

    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show position-fixed top-50 start-50 translate-middle d-flex align-items-center flex-column" role="alert" style="font-size: 0.9em; z-index: 1050; height: 20%; width: 50%;">
            <span>{{ session('errorP') }}</span>
            <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Fermer"></button>
            <a href="{{ route('mon.panier') }}">
                <button type="button" class="btn btn-primary btn-sm me-2 mt-3">Voir panier</button>
            </a>
        </div>
    @endif




<!-- @if(session()->has('error'))
    <div class="alert alert-primary alert-icon mt-2" role="alert">
        <div class="d-flex align-items-center">
            <div class="avatar-sm rounded bg-primary d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
                <i class="bx bx-info-circle text-white"></i>
            </div>
            <div class="flex-grow-1">
                {{ session()->get('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success alert-icon mt-2" role="alert">
        <div class="d-flex align-items-center">
            <div class="avatar-sm rounded bg-success d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
                <i class="bx bx-check-shield text-white"></i>
            </div>
            <div class="flex-grow-1">
                {{ session()->get('success') }}
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif -->





<!--
<div class="alert alert-primary alert-icon" role="alert">
    <div class="d-flex align-items-center">
        <div class="avatar-sm rounded bg-primary d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
            <i class="bx bx-info-circle text-white"></i>
        </div>
        <div class="flex-grow-1">
            A simple primary alert—check it out!
        </div>
    </div>
</div>
<div class="alert alert-secondary alert-icon" role="alert">
    <div class="d-flex align-items-center">
        <div class="avatar-sm rounded bg-secondary d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
            <i class="bx bx-x-circle text-white"></i>
        </div>
        <div class="flex-grow-1">
            A simple secondary alert—check it out!
        </div>
    </div>
</div>
<div class="alert alert-danger alert-icon mb-0" role="alert">
    <div class="d-flex align-items-center">
        <div class="avatar-sm rounded bg-danger d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
            <i class="bx bx-info-circle text-white"></i>
        </div>
        <div class="flex-grow-1">
            A simple danger alert—check it out!
        </div>
    </div>
</div>




<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple primary alert—check it out!
</div>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple secondary alert—check it out!
</div>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple success alert—check it out!
</div>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple danger alert—check it out!
</div>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple warning alert—check it out!
</div>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple info alert—check it out!
</div>
<div class="alert alert-light alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple light alert—check it out!
</div>
<div class="alert alert-dark alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    A simple dark alert—check it out!
</div>
-->