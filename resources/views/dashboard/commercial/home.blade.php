@extends('dashboard.commercial.layout.app')
@section('body')


        

<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h1 class="page-header-title">Bienvenue {{ auth()->user()->nom }} {{ auth()->user()->prenom }} </h1>
          </div>
          <!-- End Col -->

          <!-- <div class="col-auto">
            <a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#inviteUserModal">
              <i class="bi-person-plus-fill me-1"></i> Invite users
            </a>
          </div> -->
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <!-- Stats -->
      <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de devis généré</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $clientdevis->count() }}</h2>
                </div>
                <!-- End Col -->

                <div class="col-6">
                  <!-- Chart -->
                  <div class="chartjs-custom" style="height: 3rem;">
                    <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [21,20,24,20,18,17,15,17,18,30,31,30,30,35,25,35,35,40,60,90,90,90,85,70,75,70,30,30,30,50,72],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "y": {
                                     "display": false
                                   },
                                   "x": {
                                     "display": false
                                   }
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "plugins": {
                                  "tooltip": {
                                    "postfix": "k",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }
                            }'>
                    </canvas>
                  </div>
                  <!-- End Chart -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
          </a>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de client total</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $clients->count() }}</h2>
                </div>
                <!-- End Col -->

                <div class="col-6">
                  <!-- Chart -->
                  <div class="chartjs-custom" style="height: 3rem;">
                    <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [25,18,30,31,35,35,60,60,60,75,21,20,24,20,18,17,15,17,30,120,120,120,100,90,75,90,90,90,75,70,60],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "y": {
                                     "display": false
                                   },
                                   "x": {
                                     "display": false
                                   }
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "plugins": {
                                  "tooltip": {
                                    "postfix": "k",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }
                            }'>
                    </canvas>
                  </div>
                  <!-- End Chart -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->

              <!-- <span class="badge bg-soft-danger text-danger">
                <i class="bi-graph-down"></i> {{ $clients->count() }}
              </span>
              <span class="text-body fs-6 ms-1">from 61.2%</span> -->
            </div>
          </a>
          <!-- End Card -->
        </div>

        @if(!auth()->user()->role)
          <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <!-- Card -->
            <a class="card card-hover-shadow h-100" href="#">
              <div class="card-body">
                <h6 class="card-subtitle">Vos clients ajouté</h6>

                <div class="row align-items-center gx-2">
                  <div class="col-6">
                    <h2 class="card-title text-inherit">{{ $AuthClients->count() }}</h2>
                  </div>
                  <!-- End Col -->

                  <div class="col-6">
                    <!-- Chart -->
                    <div class="chartjs-custom" style="height: 3rem;">
                      <canvas class="js-chart" data-hs-chartjs-options='{
                                "type": "line",
                                "data": {
                                  "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                  "datasets": [{
                                    "data": [21,20,24,20,18,17,15,17,30,30,35,25,18,30,31,35,35,90,90,90,85,100,120,120,120,100,90,75,75,75,90],
                                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                    "borderColor": "#377dff",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "pointHoverRadius": 0
                                  }]
                                },
                                "options": {
                                  "scales": {
                                    "y": {
                                      "display": false
                                    },
                                    "x": {
                                      "display": false
                                    }
                                  },
                                  "hover": {
                                    "mode": "nearest",
                                    "intersect": false
                                  },
                                  "plugins": {
                                    "tooltip": {
                                      "postfix": "k",
                                      "hasIndicator": true,
                                      "intersect": false
                                    }
                                  }
                                }
                              }'>
                      </canvas>
                    </div>
                    <!-- End Chart -->
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Row -->
              </div>
            </a>
            <!-- End Card -->
          </div>
        @endif

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Montant total des commandes</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ getprice($MT) }}F</h2>
                </div>
                <!-- End Col -->

                <div class="col-6">
                  <!-- Chart -->
                  <div class="chartjs-custom" style="height: 3rem;">
                    <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [21,20,24,15,17,30,30,35,35,35,40,60,12,90,90,85,70,75,43,75,90,22,120,120,90,85,100,92,92,92,92],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "y": {
                                     "display": false
                                   },
                                   "x": {
                                     "display": false
                                   }
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "plugins": {
                                  "tooltip": {
                                    "postfix": "k",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }
                            }'>
                    </canvas>
                  </div>
                  <!-- End Chart -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
              <!-- 
              <span class="badge bg-soft-secondary text-body">0.0%</span>
              <span class="text-body fs-6 ms-1">from 2,913</span> -->
            </div>
          </a>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Montant payé</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ getprice($CA) }}F</h2>
                </div>
                <!-- End Col -->

                <div class="col-6">
                  <!-- Chart -->
                  <div class="chartjs-custom" style="height: 3rem;">
                    <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [21,20,24,15,17,30,30,35,35,35,40,60,12,90,90,85,70,75,43,75,90,22,120,120,90,85,100,92,92,92,92],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "y": {
                                     "display": false
                                   },
                                   "x": {
                                     "display": false
                                   }
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "plugins": {
                                  "tooltip": {
                                    "postfix": "k",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }
                            }'>
                    </canvas>
                  </div>
                  <!-- End Chart -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
              <!-- 
              <span class="badge bg-soft-secondary text-body">0.0%</span>
              <span class="text-body fs-6 ms-1">from 2,913</span> -->
            </div>
          </a>
          <!-- End Card -->
        </div>
      </div>
      <!-- End Stats -->

      @if(auth()->user()->role)
        <div class="row mb-4">
          <div class="col-lg-12">
            <!-- Card -->
            <div class="card h-100">
              <!-- Header -->
              <div class="card-header card-header-content-between">
                <div>
                  <h3 class="card-header-title">Projets en cours</h3>
                  <p class="mb-0 fs-6 text-body">suivi de l'avancement de vos projets actifs</p>
                </div>
                <!-- Dropdown -->
                <div class="dropdown">
                  <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="reportsOverviewDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi-three-dots-vertical"></i>
                  </button>

                  <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="reportsOverviewDropdown1">
                    <!-- <span class="dropdown-header">Paramètre</span> -->

                    <a class="dropdown-item" href="{{ route('commercial.projet') }}">
                      <i class="bi-eye dropdown-item-icon"></i> Tout les projets
                    </a>
                  </div>
                </div>
                <!-- End Dropdown -->
              </div>
              <!-- End Header -->

              <!-- Body -->
              <div class="card-body">
                @if(projets()->count() > 0)
                  <!-- Table -->
                  <div class="table-responsive">
                    @foreach(projets()->take(8) as $projet)
                      @php 
                          $finaliteT = 0;
                          if($projet->projettaches->count() > 0)
                          {
                            $finalite = $projet->projettaches->where('etat', 1)->count();
                            $finaliteT = round(($finalite / $projet->projettaches->count()) * 100);
                          }
                      @endphp
                      <div>
                        <h5 style="display: inline-block;">
                          <span class="legend-indicator bg-primary"></span>{{ $projet->titre }}
                        </h5> 
                        <a href="{{ route('commercial.projet.tache', $projet) }}"><span class="fs-6 m-3"><i class="bi-people nav-icon"></i> {{ $projet->projettaches->count() }}</span></a>
                        <div class="progress rounded-pill mb-2">
                          <div class="progress-bar" role="progressbar" style="width: {{ $finaliteT }}%" aria-valuenow="{{ $finaliteT }}" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip" data-bs-placement="top" title="Gross value"></div>
                          <!-- <div class="progress-bar opacity-50" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip" data-bs-placement="top" title="Net volume from sales"></div>
                          <div class="progress-bar opacity-25" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip" data-bs-placement="top" title="New volume from sales"></div> -->
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                          <span>@if($finaliteT < 100) Encours @else Finalisé @endif</span>
                          <span class="fw-bold">{{ $finaliteT }}%</span>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <!-- End Table -->
                @else
                  <span class="h1 d-block mb-4">DESOLÉ! AUCUN PROJET EN COURS DE TRAITEMENT SUR LA PLATEFORME</span>
                @endif
              </div>
              <!-- End Body -->
            </div>
            <!-- End Card -->
          </div>

        </div>
      @endif

      <!-- Card -->
      <div class="card card-table mb-3 mb-lg-5">
        @if($clients->count() > 0)
          <!-- Header -->
          <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
              <div class="col-md">
                <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-header-title">Clients</h4>

                  <!-- Datatable Info -->
                  <div id="datatableCounterInfo" style="display: none;">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 me-3">
                        <span id="datatableCounter">0</span>
                        Selected
                      </span>
                      <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                        <i class="tio-delete-outlined"></i> Delete
                      </a>
                    </div>
                  </div>
                  <!-- End Datatable Info -->
                </div>
              </div>
              <!-- End Col -->

              <div class="col-auto">
                <!-- Filter -->
                <div class="row align-items-sm-center">
                  <div class="col-sm-auto">
                    <div class="row align-items-center gx-0">
                      <div class="col">
                        <span class="text-secondary me-2">Status:</span>
                      </div>
                      <!-- End Col -->

                      <div class="col-auto">
                        <!-- Select -->
                        <div class="tom-select-custom tom-select-custom-end">
                          <select class="js-select js-datatable-filter form-select form-select-sm form-select-borderless" data-target-column-index="2" data-target-table="datatable" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "dropdownWidth": "10rem"
                                  }'>
                            <option value="null" selected>All</option>
                            <option value="successful">Successful</option>
                            <option value="overdue">Overdue</option>
                            <option value="pending">Pending</option>
                          </select>
                        </div>
                        <!-- End Select -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
                  </div>
                  <!-- End Col -->

                  <div class="col-sm-auto">
                    <div class="row align-items-center gx-0">
                      <div class="col">
                        <span class="text-secondary me-2">Signed up:</span>
                      </div>
                      <!-- End Col -->

                      <div class="col-auto">
                        <!-- Select -->
                        <div class="tom-select-custom tom-select-custom-end">
                          <select class="js-select js-datatable-filter form-select form-select-sm form-select-borderless" data-target-column-index="5" data-target-table="datatable" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "dropdownWidth": "10rem"
                                  }'>
                            <option value="null" selected>All</option>
                            <option value="1 year ago">1 year ago</option>
                            <option value="6 months ago">6 months ago</option>
                          </select>
                        </div>
                        <!-- End Select -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
                  </div>
                  <!-- End Col -->

                  <div class="col-md">
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
                  <!-- End Col -->
                </div>
                <!-- End Filter -->
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
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
                      <th>Nom</th>
                      <th>email</th>
                      <th>Contact</th>
                      <th>Plafond d'achat (Fcfa)</th>
                      <th>Adresse postale</th>
                      <th>Commercial</th>
                      <th>Infos client</th>
                      @if(auth()->user()->role)
                        <th>Action</th>
                      @endif
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($clients as $client)
                      <tr>
                        <td class="fw-bold">{{ $client->nom }}</td>
                        <td class="fw-bold">@if($client->email) {{ $client->email }} @else Aucun @endif</td>                
                        <td class="fw-bold">{{ $client->contact }}</td>
                        <td class="fw-bold">{{ getprice($client->Pachat) }}</td>
                        <td class="fw-bold">@if($client->adresse_postale) {{ $client->adresse_postale }} @else Aucune @endif</td>                
                        <td class="fw-bold">@if($client->commercial_id) {{ $client->commercial->nom }} {{ $client->commercial->prenom }} @else Comptabilité @endif</td>                
                        <td>
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoClient{{ $client->id }}">
                                <i class="bi-eye me-1"></i>
                            </a>
                          </div>
                        </td>
                        @if(auth()->user()->role)
                          <td>
                            <div class="btn-group" role="group">
                              <a class="btn btn-white btn-sm" href="{{ route('commercial.client.edit', $client) }}">
                                <i class="bi-pencil-fill me-1"></i>
                              </a>
                              <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteClient{{ $client->id }}">
                                <i class="bi-trash dropdown-item-icon"></i>
                              </a>
                              <!-- End Button Group -->
                            </div>
                          </td>
                        @endif
                      </tr>
                      @include('include.client')
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- End Table -->
          <!-- End Table -->

          <!-- Footer -->
          <div class="card-footer">
            <!-- Pagination -->
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
                      <option value="4">4</option>
                      <option value="6">6</option>
                      <option value="8" selected>8</option>
                      <option value="12">12</option>
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
            <!-- End Pagination -->
          </div>
          <!-- End Footer -->
        @else
            <!-- Header -->
            <div class="card-header card-header-content-md-between p-4">
              <h3 class="fw-bold mb-0 text-center">Désolé! Vous n'avez ajouté aucun client sur la plateforme</h3>
            </div>
            <!-- End Header -->
        @endif
      </div>
      <!-- End Card -->

    </div>
    <!-- End Content -->
</main>
            


@endsection