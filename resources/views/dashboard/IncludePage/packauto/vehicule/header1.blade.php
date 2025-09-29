<div class="col-auto col-sm-12 col-md-6 text-end">
    @if(categorieVehicule()->count() > 0)
        <a class="btn btn-light m-1" href="#" data-bs-toggle="modal" data-bs-target="#addVehicule">
            <i class="bi-plus me-1"></i> Véhicule
        </a>
    @endif
    <a class="btn btn-light m-1" href="{{ route('packauto.qrcode.emprunt.vehicule.generale') }}">
        <i class="bi-printer me-1"></i> QR Code d'emprunt
    </a>
    <a class="btn btn-light m-1" href="{{ route('packauto.qrcode.panne.vehicule.generale') }}">
        <i class="bi-printer me-1"></i> QR Code de panne
    </a>
</div>