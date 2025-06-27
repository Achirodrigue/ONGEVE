@extends('dashboard.membre.layout.app')
@section('body')

                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-12 items-end">
                            <a href="{{ route('membre.all.projet', $projet) }}" class="btn btn-color-membre btn-icon-split bouttonR">
                                <span class="icon">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span class="text">Retour</span>
                            </a>
                            <div class="mb-5"></div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        @if (session()->has('message'))
                            <div class="alert alert-warning alert-dismissible card-header py-3 text-center" role="alert" id="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session()->get('message') }}
                            </div>
                        @endif 
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Investir dans le projet {{ $projet->type_investissement }} : {{ $projet->description }} (Pièce : {{ $piece }})</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Détails</th>
                                            <th>Nombre de parts</th>
                                            <th>Nombre de pièces</th>
                                            @if (!($projet->type_investissement === "Obligation" && auth()->user()->minscription->compteur >= 1))
                                                @if ($projet->projetdf->isvalide)
                                                    @if ($projet->projetdf->dt)<th>Droits d'investissement</th>@endif
                                                    @if ($projet->projetdf->fs)
                                                        @if (!auth()->user()->minscription->isvalide)
                                                            <th>Frais d'inscription</th>
                                                        @endif
                                                    @endif
                                                @else
                                                    <th>Droits d'investissement</th>
                                                    @if (!auth()->user()->minscription->isvalide)
                                                        <th>Frais d'inscription</th>
                                                    @endif
                                                @endif
                                            @endif
                                            <th>Total</th>
                                            <th>Valider</th>
                                        </tr>
                                    </thead>
                                    
                                    @php 
                                        $part = (int)( ($piece * 10000) / $projet->cout_part );
                                        $partR = (($piece * 10000) - ($part * $projet->cout_part)) / 10000;

                                        if (!($projet->type_investissement === "Obligation" && auth()->user()->minscription->compteur >= 1))
                                        {
                                            if ($projet->projetdf->isvalide)
                                            {
                                                if($projet->projetdf->dt and $projet->projetdf->droit)
                                                {
                                                    $invest = 1 * ($projet->projetdf->droit / 10) ;
                                                }else
                                                {
                                                    $invest = 0 ;
                                                }

                                                if($projet->projetdf->fs and $projet->projetdf->frais and !auth()->user()->minscription->isvalide)
                                                {
                                                    $PartPayer = $adinvestperiode->frais - auth()->user()->minscription->deja_verser ;
                                                    $restePartPayer = (int)($PartPayer / ($projet->projetdf->frais / 10)) ;
                                                    if ($piece <= $restePartPayer){
                                                        $inscription = 1 * ($projet->projetdf->frais / 10);  
                                                    }
                                                    else{
                                                        $inscription = 1 * ($projet->projetdf->frais / 10);
                                                    }
                                                }
                                                else
                                                {
                                                    $restePartPayer = 0;
                                                    $inscription = 0 * ($projet->projetdf->frais / 10) ;
                                                }
                                            }
                                            else
                                            {
                                                $invest = 1 * ($adinvestperiode->droit / 10) ;

                                                if(!auth()->user()->minscription->isvalide)
                                                {
                                                    $PartPayer = $adinvestperiode->frais - auth()->user()->minscription->deja_verser ;
                                                    $restePartPayer = (int)($PartPayer / ($adinvestperiode->frais / 10)) ;
                                                    if ($piece <= $restePartPayer){
                                                        $inscription = 1 * ($adinvestperiode->frais / 10);  
                                                    }
                                                    else{
                                                        $inscription = 1 * ($adinvestperiode->frais / 10);
                                                    }
                                                }else
                                                {
                                                    $restePartPayer = 0;
                                                    $inscription = 0 * ($adinvestperiode->frais / 10) ;
                                                }
                                            }
                                        }
                                        else
                                        {
                                            $invest = 0 ;
                                            
                                            $restePartPayer = 0;
                                            $inscription = 0;
                                        }

                                    @endphp

                                    <tbody>
                                        <tr>
                                            <td>Valeurs unitaires</td>
                                            <td>{{ strrev(wordwrap(strrev($projet->cout_part), 3, ' ', true)) }} F</td>
                                            <td class="rose">10.000F</td>
                                            @if (!($projet->type_investissement === "Obligation" && auth()->user()->minscription->compteur >= 1))
                                                @if ($projet->projetdf->isvalide)
                                                    @if ($projet->projetdf->dt)
                                                        <td class="rose">{{ strrev(wordwrap(strrev($projet->projetdf->droit / 10), 3, ' ', true)) }}F/PIECE</td>
                                                    @endif
                                                    @if ($projet->projetdf->fs)
                                                        @if (!auth()->user()->minscription->isvalide)
                                                            <td class="rose">
                                                                {{ strrev(wordwrap(strrev($projet->projetdf->frais / 10), 3, ' ', true)) }}F/PIECE (Reste: {{ strrev(wordwrap(strrev($adinvestperiode->frais - auth()->user()->minscription->deja_verser), 3, ' ', true)) }} F)
                                                            </td>
                                                        @endif
                                                    @endif
                                                @else
                                                    <td class="rose">{{ strrev(wordwrap(strrev($adinvestperiode->droit / 10), 3, ' ', true)) }}F/PIECE</td>
                                                    @if (!auth()->user()->minscription->isvalide)
                                                        <td class="rose">
                                                            {{ strrev(wordwrap(strrev($adinvestperiode->frais / 10), 3, ' ', true)) }}F/PIECE (Reste: {{ strrev(wordwrap(strrev($adinvestperiode->frais - auth()->user()->minscription->deja_verser), 3, ' ', true)) }} F)
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                            <td></td>
                                            <td rowspan="3" class="text-center" style="vertical-align: middle;">
                                                <form method="POST" action="{{ route('membre.investir.projet.etape.deux.store', $projet) }}">
                                                @csrf
                                                    <input type="text" name="nombre_part" id="InputEnvoiPart" class="form-control" value="0" required hidden>
                                                    <input type="text" name="nombre_piece" id="InputEnvoiPiece" class="form-control" value="0" required hidden>
                                                    <input type="text" name="droit_investissement" id="InputEnvoiDI" class="form-control" value="0" required hidden>
                                                    <input type="text" name="inscription" id="InputEnvoiInscription" class="form-control" value="0" required hidden>
                                                    <input type="text" name="totalInscrip" id="InputEnvoiFI" class="form-control" value="0" required hidden>
                                                    <input type="text" name="montant_projet" id="InputEnvoiMontantProjet" class="form-control" value="0" required hidden>
                                                    <input type="text" name="total_payer" id="InputEnvoiTotalPayer" class="form-control" value="0" required hidden>
                                                    <input type="text" name="total_cout" id="InputEnvoiTotalCout" class="form-control" value="0" required hidden>

                                                
                                                    <button type="submit" class="btn btn-color-membre btn-icon-split">
                                                        <span class="icon  font-weight-bold">
                                                            F
                                                        </span>
                                                        <span class="text">Payer</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nombre à acheter</td>
                                            <td class="text-center font-weight-bold">
                                                <span id="nombrePart">0</span>
                                            </td>
                                            <td class="text-center">
                                                    <label for="piece">Pièce</label>
                                                    <input type="number" min="1" max="{{ $projet->nombre_piece }}" name="piece" id="piece" 
                                                            oninput="calculerPieceInvestir({{$projet->cout_part}} , {{$invest}} , {{$restePartPayer}} , {{$inscription}})" 
                                                            class="form-control" placeholder="nombre de piece">
                                            </td>
                                            @if (!($projet->type_investissement === "Obligation" && auth()->user()->minscription->compteur >= 1))
                                                @if ($projet->projetdf->isvalide)
                                                    @if ($projet->projetdf->dt)
                                                        <td class="text-center">
                                                            <button class="btn btn-primary btn-circle investir-btn">
                                                                <span id="nombreInvest">0</span>
                                                            </button>
                                                        </td>
                                                    @endif
                                                    @if ($projet->projetdf->fs)
                                                        @if (!auth()->user()->minscription->isvalide)
                                                            <td class="text-center font-weight-bold">
                                                                <button class="btn btn-primary btn-circle investir-btn">
                                                                    <span id="nombreInscrip">0</span> 
                                                                </button>
                                                            </td>
                                                        @endif
                                                    @endif
                                                @else
                                                    <td class="text-center">
                                                        <button class="btn btn-primary btn-circle investir-btn">
                                                            <span id="nombreInvest">0</span>
                                                        </button>
                                                    </td>
                                                    @if (!auth()->user()->minscription->isvalide)
                                                        <td class="text-center font-weight-bold">
                                                            <button class="btn btn-primary btn-circle investir-btn">
                                                                <span id="nombreInscrip">0</span> 
                                                            </button>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                            <td class="text-center font-weight-bold"><span id="NombreTotalAchat">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Coût d’investissement</td>
                                            <td class="text-center font-weight-bold">
                                                <span id="montantPart">0</span>
                                            </td>
                                            <td class="text-center font-weight-bold">
                                                <span id="montantPiece">0</span>
                                            </td>
                                            @if ($projet->projetdf->isvalide)
                                                @if ($projet->projetdf->dt)
                                                    <td class="text-center font-weight-bold">
                                                        <span id="montantInvest">0</span> F
                                                    </td>
                                                @endif
                                                @if ($projet->projetdf->fs)
                                                    @if (!auth()->user()->minscription->isvalide)
                                                        <td class="text-center font-weight-bold">
                                                            <span id="montantInscrip">0</span> F
                                                        </td>
                                                    @endif
                                                @endif
                                            @else
                                                <td class="text-center font-weight-bold">
                                                    <span id="montantInvest">0</span> F
                                                </td>
                                                @if (!auth()->user()->minscription->isvalide)
                                                    <td class="text-center font-weight-bold">
                                                        <span id="montantInscrip">0</span> F
                                                    </td>
                                                @endif
                                            @endif
                                            <td class="text-center font-weight-bold">
                                                <span id="TotalCout">0</span> F
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            
@endsection