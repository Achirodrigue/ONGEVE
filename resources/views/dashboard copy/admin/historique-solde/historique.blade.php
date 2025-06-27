@extends('dashboard.admin.layout.app')
@section('body')



            <!-- Start Container Fluid -->
            <div class="container-fluid">
                
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <h5 class="card-title mb-1 anchor" id="responsive">
                                    Historiques des soldes par jour <a class="anchor-link" href="#responsive">#</a>
                                </h5>
                            </div>
                            <div>
                                <a href="{{ route('admin.home') }}" class="btn btn-primary">
                                        <i class='bx bxs-arrow-from-right me-1'></i> Retour
                                </a>
                            </div>
                        </div> <!-- end row -->

                        @include('include.message')
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Solde géneral ({{ $soldedays->count() }})</h4>
                                        <a href="#!" class="btn btn-sm btn-primary rounded-pill">{{ strrev(wordwrap(strrev($Gsolde->solde), 3, ' ', true)) }}F</a>
                                    </div> 
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-12 mx-auto">
                                <div class="card">

                                    <div class="card-body p-0">
                                        <div data-simplebar style="max-height: 406px;">
                                            <table class="table text-nowrap table-hover mb-0 table-centered">
                                                <tbody>
                                                    @foreach($soldedays as $soldeday)
                                                    <tr>
                                                        <td>{{ $soldeday->date }}</td>
                                                        <td class="text-end"><span class="badge bg-success">{{ strrev(wordwrap(strrev($soldeday->solde), 3, ' ', true)) }}F</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                        </div>
                    </div>
                </div>

            </div>
            <!-- End Container Fluid -->

            


@endsection