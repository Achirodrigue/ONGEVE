@extends('dashboard.ressource.layout.app')
@section('body')


  @include('include.message.dashboard')
  
  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Tache du projet <span class="text-warning">{{ $projet->titre }}</span></h1>
          </div>
          <!-- End Col -->
           
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('ressource.projet') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addProjetTache">
              <i class="bi-person-plus-fill me-1"></i> Ajouter une tache
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('ressource.projet') }}" tabindex="-1" aria-disabled="true">Tout les projet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Taches projet</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      
      <!-- Step Form -->
      <form method="post" action="{{ route('commun.projet.tache.etat.update', $projet) }}"  class="js-step-form" data-hs-step-form-options='{
              "progressSelector": "#checkoutStepFormProgress",
              "stepsSelector": "#checkoutStepFormContent",
              "endSelector": "#checkoutFinishBtn",
              "isValidate": false
            }'>
        @csrf
        @method('PATCH')
        

        <!-- Content Step Form -->
        <div class="row">

          <div class="col-lg-10 mx-auto">
            <div id="checkoutStepFormContent">

              <div id="checkoutStepPayment">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                  <!-- Header -->
                  <div class="card-header">
                    <h4 class="card-header-title mb-2">{{ $projet->titre }}</h4>

                    @php 
                      $finaliteT = 0;
                      if($projet->projettaches->count() > 0)
                      {
                        $finalite = $projet->projettaches->where('etat', 1)->count();
                        $finaliteT = round(($finalite / $projet->projettaches->count()) * 100);
                      }
                    @endphp
                    <!-- Progress -->
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="progress flex-grow-1">
                        <div class="progress-bar @if($finaliteT == 100) bg-warning @else bg-primary @endif" role="progressbar" style="width: {{ $finaliteT }}%;" aria-valuenow="{{ $finaliteT }}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="ms-4">{{ $finaliteT }}%</span>
                    </div>
                    <!-- End Progress -->
                  </div>
                  <!-- End Header -->

                  <!-- Body -->
                  @if($projet->projettaches->count() > 0)
                    <div class="card-body">
                      @php $n=1; @endphp
                      @foreach($projet->projettaches as $projettache)
                        <div class="d-flex gap-2" style="justify-content: space-between;">
                          <div class="form-check">
                            <input class="form-check-input" name="projettache[]" type="checkbox" value="{{ $projettache->id }}" id="makePrimaryCheckbox{{ $projettache->id }}" @if($projettache->etat) checked @endif>
                            <label class="form-check-label" for="makePrimaryCheckbox{{ $projettache->id }}">
                              {{ $projettache->tache }} 
                            </label>
                          </div>
                          <div class="btn-group" style="align-items: center;" role="group">
                            <a class="btn btn-white btn-sm p-1" href="#" data-bs-toggle="modal" data-bs-target="#editProjetTache{{ $projettache->id }}">
                              <i class="bi-pencil-fill me-1"></i>
                            </a>
                            <a class="btn btn-white btn-sm p-1" href="#" data-bs-toggle="modal" data-bs-target="#deleteProjetTache{{ $projettache->id }}">
                              <i class="bi-trash dropdown-item-icon"></i>
                            </a>
                          </div>
                        </div>

                        @if($n != $projet->projettaches->count()) <hr class="mt-2 mb-2"> @endif
                        
                        @include('include.commun.projet.projet-tache')
                      @endforeach
                    </div>
                  @else
                    <div class="card-header">
                      <h5 class="card-header-title mb-2">Désolé! Aucune tache n'a été ajouté pour ce projet</h5>
                    </div>
                  @endif
                  <!-- Body -->
                </div>
                <!-- End Card -->

                <!-- Footer --> 
                @if($projet->projettaches->count() > 0)
                  <div class="d-flex align-items-center">
                    <div class="ms-auto">
                      <button type="submit" class="btn btn-primary" data-hs-step-form-next-options='{
                                "targetSelector": "#checkoutStepSummary"
                              }'>
                        Appliquer les modifs <i class="bi-share dropdown-item-icon"></i>
                      </button>
                    </div>
                  </div>
                @endif
                <!-- End Footer -->
              </div>

            </div>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Step Form -->
      </form>
      <!-- End Step Form -->

    </div>
    <!-- End Content -->
  </main>

  <div class="modal fade" id="addProjetTache" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une nouvelle tache</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.projet.tache.store', $projet) }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Tache</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="tache" class="visually-hidden form-label">Tache</label>
                <textarea name="tache" id="tache" value="{{ old('tache') }}" class="form-control" placeholder="Entrer une tache" required></textarea>
                @error('tache') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>
  


@endsection