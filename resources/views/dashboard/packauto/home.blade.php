@extends('dashboard.packauto.layout.app')
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
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <!-- Stats -->
      <div class="row">

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="{{ route('packauto.pchauffeur.index') }}">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de chauffeur</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  
                  <h2 class="card-title text-inherit">{{ $pchauffeurs->count() }}</h2>
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
                <i class="bi-graph-down"></i> {{ $pchauffeurs->count() }}
              </span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="{{ route('packauto.pcategorievehicule.index') }}">
            <div class="card-body">
              <h6 class="card-subtitle">Type de véhicule</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $pcategorievehicules->count() }}</h2>
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
                <i class="bi-graph-down"></i> {{ $pcategorievehicules->count() }}
              </span>
              <!-- <span class="text-body fs-6 ms-1">nombre total</span> -->
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="{{ route('packauto.pvehicule.index') }}">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre total de vehicule</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $pvehicules->count() }}</h2>
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
                <i class="bi-graph-up"></i> {{ $pvehicules->count() }}
              </span>
            </div>
          </a>
        </div>
        
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="{{ route('packauto.vehicule.disponible') }}">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de vehicule disponible</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $pvehicules->where('statut','actif')->where('ES', 1)->count() }}</h2>
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
                <i class="bi-graph-down"></i> {{ $pvehicules->where('statut','actif')->where('ES', 1)->count() }}
              </span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="{{ route('packauto.vehicule.emprunte') }}">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de vehicule en cours d'emprunt</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $pvehicules->where('statut','actif')->where('ES', 0)->count() }}</h2>
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
                <i class="bi-graph-up"></i> {{ $pvehicules->where('statut','actif')->where('ES', 0)->count() }}
              </span>
            </div>
          </a>
        </div>
        
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="{{ route('packauto.vehicule.maintenance') }}">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de vehicule en maintenance</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $pvehicules->where('statut','maintenance')->count() }}</h2>
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
                <i class="bi-graph-down"></i> {{ $pvehicules->where('statut','maintenance')->count() }}
              </span>
            </div>
          </a>
        </div>
        
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre de panne signalées</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $ppannes->where('statut', 0)->count() }}</h2>
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
                <i class="bi-graph-down"></i> {{ $ppannes->where('statut', 0)->count() }}
              </span>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Nombre total d'entretien effectués</h6>

              <div class="row align-items-center gx-2">
                <div class="col-6">
                  <h2 class="card-title text-inherit">{{ $pentretiens->count() }}</h2>
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
                <i class="bi-graph-up"></i> {{ $pentretiens->count() }}
              </span>
            </div>
          </a>
        </div>
      </div>
      <!-- End Stats -->

    </div>
    <!-- End Content -->
</main>
            


@endsection