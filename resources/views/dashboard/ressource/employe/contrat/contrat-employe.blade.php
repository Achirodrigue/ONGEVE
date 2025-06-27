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
            <h1 class="page-header-title">Les différents contrats de l'employé <span class="text-danger">{{ $employe->nom }} {{ $employe->prenom }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addemployecontrat">
              <i class="bi-person-plus-fill me-1"></i> Ajouter un contrat
            </a>
            <a class="btn btn-primary" href="{{ route('ressource.employe.show', $employe) }}">
              <i class="bi-eye me-1"></i> Details employé
            </a>
            <a class="btn btn-primary" href="{{ route('ressource.employe.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
        </div>
        <!-- End Row -->

        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('ressource.employe.index') }}" tabindex="-1" aria-disabled="true">Tout les employés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Contrats employé</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($employe->employecontrats->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                  </div>
                  <!-- End Search -->
                </form>
              </div>
              

            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
              <table id="datatable" class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
                <thead class="thead-light">
                  <tr>
                    <th>N°</th>
                    <th>Type</th>
                    <!-- <th>Numéro</th> -->
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Statut</th>
                    <th>Salaire</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n=1; @endphp
                  @foreach($employe->employecontrats as $employecontrat)
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td>{{ $employecontrat->type_contrat }}</td>
                      <!-- <td>{{ $employecontrat->numero_contrat ?? 'N/A' }}</td> -->
                      <td>{{ $employecontrat->date_debut->format('d/m/Y') }}</td>
                      <td>{{ $employecontrat->date_fin ? $contract->date_fin->format('d/m/Y') : 'Indéfini' }}</td><!-- CDI /  -->
                      <td><span class="status-{{ strtolower($employecontrat->status) }}">{{ $employecontrat->status }}</span></td>
                      <td>{{ $employecontrat->salaire ? number_format($employecontrat->salaire, 2, ',', ' ') . ' XAF' : 'N/A' }}</td>
                              
                      <td>{{ $employecontrat->nom_contratument }}</td>
                      <td>{{ $employecontrat->type_contratument }}</td>
                      <td>{{ $employecontrat->date_expiration ? \Carbon\Carbon::parse($employecontrat->expiration_date)->format('d/m/Y') : 'N/A' }}</td>
                      <td>{{ $employecontrat->description ?? 'N/A' }}</td>
                      <!-- <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ asset(Storage::url($employecontrat->fichier)) }}" target="_blank">
                              <i class="bi-eye me-1"></i>
                          </a>
                        </div>
                      </td> -->
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editemployecontrat{{ $employecontrat->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteemployecontrat{{ $employecontrat->id }}">
                            <i class="bi-trash dropdown-item-icon"></i>
                          </a>
                          <!-- End Button Group -->
                        </div>
                      </td>
                    </tr>

                    @include('include.ressource.employe.employecontrat')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
              <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                  <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                    <span class="me-2">Showing:</span>

                    <!-- Select -->
                    <div class="tom-select-custom">
                      <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                                "searchInDropdown": false,
                                "hideSearch": true
                              }'>
                        <option value="12">12</option>
                        <option value="14" selected>14</option>
                        <option value="16">16</option>
                        <option value="18">18</option>
                      </select>
                    </div>
                    <!-- End Select -->

                    <span class="text-secondary me-2">of</span>

                    <!-- Pagination Quantity -->
                    <span id="datatableWithPaginationInfoTotalQty"></span>
                  </div>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                  <div class="d-flex justify-content-center justify-content-sm-end">
                    <!-- Pagination -->
                    <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                  </div>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
            <!-- End Footer -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun contratument pour cet employé n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

  </main>

  <div class="modal fade" id="addemployecontrat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="contratument">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau contrat</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('ressource.employecontrat.store', $employe) }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom du contrat</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom du contratument</label>
                <input type="text" name="nom_contratument" value="{{ old('nom_contratument') }}" class="form-control" id="nom_contratument" required>
                @error('nom_contratument') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Type de contratument</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="type_contratument" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }'>
                    <option value="CNI" {{ old('type_contratument') == 'CNI' ? 'selected' : '' }}>Carte Nationale d'Identité</option>
                    <option value="PASSPORT" {{ old('type_contratument') == 'PASSPORT' ? 'selected' : '' }}>Passeport</option>
                    <option value="DIPLOME" {{ old('type_contratument') == 'DIPLOME' ? 'selected' : '' }}>Diplôme</option>
                    <option value="CV" {{ old('type_contratument') == 'CV' ? 'selected' : '' }}>Curriculum Vitae</option>
                    <option value="CONTRAT" {{ old('type_contratument') == 'CONTRAT' ? 'selected' : '' }}>Contrat de Travail</option>
                    <option value="ATTESTATION" {{ old('type_contratument') == 'ATTESTATION' ? 'selected' : '' }}>Attestation (Médicale, Résidence, etc.)</option>
                    <option value="PERMIS DE TRAVAIL" {{ old('type_contratument') == 'PERMIS DE TRAVAIL' ? 'selected' : '' }}>Permis de Travail</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Fichier du contratument *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="fichier" class="visually-hidden form-label">Fichier du contratument *</label>
                <input type="file" name="fichier" class="form-control" id="fichier" required>
                @error('fichier') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Date d'expiration (optionnel)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="date_expiration" class="visually-hidden form-label">Date d'expiration (optionnel)</label>
                <input type="date" name="date_expiration" value="{{ old('date_expiration') }}" class="form-control" id="date_expiration">
                @error('date_expiration') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Description (optionnel)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="description" class="visually-hidden form-label">Description (optionnel)</label>
                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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