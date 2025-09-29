@extends('dashboard.geststock.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Les différents gestionnaires <span class="badge bg-soft-dark text-dark ms-2">{{ $geststocks->count() }}</span></h1>

            <!-- <div class="mt-2">
              <a class="text-body me-3" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exportProductsModal">
                <i class="bi-download me-1"></i> Export
              </a>
              <a class="text-body" href="javascript:;" data-bs-toggle="modal" data-bs-target="#importProductsModal">
                <i class="bi-upload me-1"></i> Import
              </a>
            </div> -->
          </div>
          <!-- End Col -->
           
          <div class="col-auto">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGeststock">
              <i class="bi-person-plus-fill me-1"></i> Ajouter un gestionnaire
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page Header -->


      <!-- Card -->
      <div class="card card-table">
          @if($geststocks->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un gestionnaire" aria-label="Rechercher un gestionnaire">
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
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th class="text-center">email</th>
                    <th class="text-center">Contact</th>
                    <th>Identifiant</th>
                    <th>Compte</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n=1; @endphp
                  @foreach($geststocks as $rgeststock)
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td class="fw-bold">{{ $rgeststock->nom }}</td>
                      <td class="fw-bold">{{ $rgeststock->prenom }}</td>
                      <td class="fw-bold">{{ $rgeststock->email }}</td>
                      <td class="fw-bold">{{ $rgeststock->contact }}</td>
                      <td class="fw-bold">{{ $rgeststock->identifiant }}</td>             
                      <td class="fw-bold text-center">
                        @if($rgeststock->role)
                          Impossible
                        @else
                          <div class="btn-group" role="group">
                            <a class="btn @if($rgeststock->isvalide) btn-warning @else btn-danger @endif btn-sm" href="{{ route('geststock.geststock.compte.update', $rgeststock) }}">
                              @if($rgeststock->isvalide) Activé @else Bloqué @endif
                            </a>
                          </div>
                        @endif
                      </td>
                      <td class="fw-bold text-center">
                        @if($rgeststock->role)
                          Impossible
                        @else
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editGeststock{{ $rgeststock->id }}">
                              <i class="bi-pencil-fill me-1"></i>
                            </a>
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteGeststock{{ $rgeststock->id }}">
                              <i class="bi-trash dropdown-item-icon"></i>
                            </a>
                          </div>
                        @endif
                      </td>
                    </tr>
                    @include('include.geststock.geststock')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
              @include('dashboard.IncludePage.commun.pagination.pagination')
            <!-- End Footer -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun gestionnaire n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- Modal -->
  <div class="modal fade" id="addGeststock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau gestionnaire</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('geststock.rgeststock.store') }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Prénom</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prenom" class="visually-hidden form-label">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-control" id="nom" placeholder="Entrer un prenom" aria-label="Entrer un prenom" required>
                @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Contact</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="contact" class="visually-hidden form-label">Contact</label>
                <input type="number" name="contact" required minlength="8" value="{{ old('contact') }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact">
                @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Email</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="email" class="visually-hidden form-label">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Role</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="role" class="visually-hidden form-label">Role</label>
                <select name="role" class="form-control w-100" id="role" required>
                  <option value="0">Magasinier</option>
                  <option value="1">Responsable logistique</option>
                </select>
                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Identifiant</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="identifiant" class="visually-hidden form-label">Identifiant</label>
                <input type="text" name="identifiant" value="{{ old('identifiant') }}" class="form-control" id="identifiant" placeholder="Entrer un identifiant" aria-label="Entrer un identifiant" required>
                @error('identifiant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Mot de passe</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="password" class="visually-hidden form-label">Mot de passe</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Entrer un mot de passe" aria-label="Entrer un mot de passe" required>
                <img src="{{ asset("auth/oeil/oeilc.png") }}" style="width: 18px; float: right; margin-top: -30px; margin-right: 3px;" id="eye" onClick="changer()">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
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