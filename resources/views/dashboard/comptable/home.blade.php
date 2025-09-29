@extends('dashboard.comptable.layout.app')
@section('body')

  @include('include.message.dashboard')


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
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <!-- Stats -->
      <div class="row">

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Total des clients</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $clients->count() }}</h2>
                </div>

                <div class="col-6">
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
                </div>
              </div>

              <span class="badge bg-soft-danger text-danger">
                <i class="bi-graph-down"></i> {{ $clients->count() }}
              </span>
              <span class="text-body fs-6 ms-1">nombre total</span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Total des fournisseurs</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $fournisseurs->count() }}</h2>
                </div>

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
              </div>

              <span class="badge bg-soft-danger text-danger">
                <i class="bi-graph-down"></i> {{ $fournisseurs->count() }}
              </span>
              <span class="text-body fs-6 ms-1">nombre total</span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Total factures client</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $clientdevis->count() }}</h2>
                </div>

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
              </div>
              
              <span class="badge bg-soft-success text-success">
                <i class="bi-graph-up"></i> {{ getpricefr($clientdevisM) }}
              </span>
              <span class="text-body fs-6 ms-1">comme montant</span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Total factures fournisseurs</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $fournisseurfacturecomptables->count() }}</h2>
                </div>

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
              </div>
              
              <span class="badge bg-soft-success text-success">
                <i class="bi-graph-up"></i> {{ getpricefr($fournisseurfacturecomptablesM) }}
              </span>
              <span class="text-body fs-6 ms-1">comme montant</span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Dépense interne</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $depenses->count() }}</h2>
                </div>

                <div class="col-6">
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
              </div>

              <span class="badge bg-soft-danger text-danger">
                <i class="bi-graph-down"></i> {{ getpricefr($depensesM) }}
              </span>
              <span class="text-body fs-6 ms-1">comme dépense</span>
            </div>
          </a>
        </div>
      </div>
      <!-- End Stats -->

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

                  <a class="dropdown-item" href="{{ route('comptable.projet') }}">
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
                      <a href="{{ route('comptable.projet.tache', $projet) }}"><span class="fs-6 m-3"><i class="bi-people nav-icon"></i> {{ $projet->projettaches->count() }}</span></a>
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
                <span class="h1 d-block mb-4">Desolé! Aucun projet en cours de traitement sur la plateforme</span>
              @endif
            </div>
            <!-- End Body -->
          </div>
          <!-- End Card -->
        </div>

      </div>

    </div>
    <!-- End Content -->
</main>
            


@endsection