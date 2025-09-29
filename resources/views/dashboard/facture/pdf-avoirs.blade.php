<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Groupe clis</title>
    <link rel="shortcut icon" href="{{ asset("dashboard/img/logo2.jpg") }}">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .invoice-container {
            width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .invoice-details-header {
            margin-top: 5px;
            padding-bottom: 10px;
        }
        .invoice-details-body {
            margin-top: 10px;
            padding-bottom: 10px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            /* border-bottom: 2px solid #007BFF; */
        }
        .invoice-details h1 {
            margin: 0;
            color: #007BFF;
        }
        .invoice-details-header p {
            margin: 5px 0;
        }
        .invoice-details div {
            width: 48%;
        }
        .invoice-details h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .items-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .items-table th {
            background-color: #f0f0f0;
            /* color: #fff; */
        }
        /* .items-table img {
            width: 60px;
            height: auto;
        } */
        .totals {
            margin-top: 20px;
            text-align: right;
        }
        .totals h3 {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .page-number {
            text-align: right;
            font-size: 12px;
            color: #777;
        }

        .ft {
            border-top: 1px solid #007BFF;
        }






        .header1{
            border: 1px solid black; 
            border-radius: 5px;
            color: black !important; 
            padding: 10px;
            margin-bottom: 5px;
        }
        .h2-top{
            margin-bottom: 4px !important;
            margin-top: 0 !important;
            font-weight: 900;
            /* line-height: 5px; */
        }
        .td-border-none{
            border: none !important;
        }
        .position-droit{
            text-align: right !important;
        }
        .gras{
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div>
        <div class="header1">
            <h3 class="h2-top">GROUPE CHALLENGE LOG. INT. SCE</h3>
            <h3 class="h2-top">NCC : 1600597G</h3>
            <h3 class="h2-top">Régime d'imposition : RNI</h3>
            <h3 class="h2-top">Centre des impôts : 8016 CME Port Bouet</h3>
        </div>

        <div class="header1">
            <div class="invoice-details invoice-details-body">
                <div style="float: left;">
                    <h3 class="h2-top">RCCM :</h3>
                    <h3 class="h2-top">Références bancaires :</h3>
                    <h3 class="h2-top">Établissement : GROUPE CLIS</h3>
                    <h3 class="h2-top">Adresse : 18 BP 268 ABIDJAN 18</h3>
                    <h3 class="h2-top">Nº Tel : 0505569854</h3>
                    <h3 class="h2-top">Mail : blondain.gao@groupeclis.com</h3>
                    <h3 class="h2-top">Nom du vendeur :</h3>
                    <h3 class="h2-top">Nom de PDV : GROUPE CLIS</h3>
                    <h3 class="h2-top">Date et heure : {{ $clientdevisavoir->created_at->format('d/m/Y H:i:s') }}</h3>
                    <h3 class="h2-top">Mode de paiement : </h3>
                </div>
                <div style="float: right;">
                    <h3 class="h2-top">Facture d'avoir Nº {{ $clientdevisavoir->numero_devis }}</h3>
                    <h3 class="h2-top">Facture de vente Nº {{ $clientdevisavoir->clientdevis->numero_devis }}</h3>
                    <img src="{{ public_path('dashboard/img/logo1.jpg') }}" style="width: 150px;" alt="Logo de l'entreprise">
                    <h3>Client</h3>
                    <h3 class="h2-top">Nom : {{ $clientdevisavoir->clientdevis->client->nom }}</h3>
                    <h3 class="h2-top">Adresse : {{ $clientdevisavoir->clientdevis->client->clientinfo->siege_social }}</h3>
                    <h3 class="h2-top">NCC : {{ $clientdevisavoir->clientdevis->client->NCC }}</h3>
                </div>
            </div>
        </div>

        <div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Réf</th>
                        <th>Désignation</th>
                        <th style="text-align: right">P.U HT</th>
                        <th style="text-align: center">Qté</th>
                        <th style="text-align: center">Unité</th>
                        <th>Taxes (%)</th>
                        <th style="text-align: center">Rem. (%)</th>
                        <th style="text-align: right">Montant HT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientdevisavoir->clientdevisavoirprods as $clientdevisavoirprod)
                        <tr>
                            <td>{{ $clientdevisavoirprod->clientdevisprod->produit->reference }}</td>
                            <td>{{ $clientdevisavoirprod->clientdevisprod->produit->nom }}</td>
                            <td style="text-align: right;">{{ getprice($clientdevisavoirprod->clientdevisprod->prix_unitaire) }}</td>
                            <td style="text-align: center;">{{ $clientdevisavoirprod->quantite }}</td>
                            <td style="text-align: center;"></td>
                            <td>TVA (18)</td>
                            <td style="text-align: center">
                                @if($clientdevisavoirprod->clientdevisprod->clientdevisremise && 
                                $clientdevisavoirprod->clientdevisprod->clientdevisremise->TR)
                                    {{ $clientdevisavoirprod->clientdevisprod->clientdevisremise->remise }}
                                @else 0 @endif
                            </td>
                            <td style="text-align: right">{{ getprice($clientdevisavoirprod->prix_total) }}</td>
                        </tr>
                      <tr>
                    @endforeach

                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="position-droit gras" colspan="5">TOTAL HT</td>
                            <td class="position-droit gras">{{ getprice($clientdevisavoir->total_ttc) }}</td>
                        </tr>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="position-droit gras" colspan="5">TVA</td>
                            <td class="position-droit">{{ getprice($clientdevisavoir->tva) }}</td>
                        </tr>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="position-droit gras" colspan="5">TOTAL TTC</td>
                            <td class="position-droit gras">{{ getprice($clientdevisavoir->total_ttc + $clientdevisavoir->tva) }}</td>
                        </tr>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="position-droit gras" colspan="5">AUTRES TAXES</td>
                            <td class="position-droit">{{ getprice($clientdevisavoir->airsi_montant) }}</td>
                            <!-- <td class="position-droit">{{ getprice($clientdevisavoir->airsi_montant + $clientdevisavoir->clientdevis->timbre + $clientdevisavoir->clientdevis->frais) }}</td> -->
                        </tr>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="position-droit gras" colspan="5">TOTAL A PAYER</td>
                            <td class="position-droit gras">{{ getprice($clientdevisavoir->total_payer) }}</td>
                            <!-- <td class="position-droit gras">{{ getprice($clientdevisavoir->total_payer + $clientdevisavoir->clientdevis->timbre + $clientdevisavoir->clientdevis->frais) }}</td> -->
                        </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 5px;">
            <h4 style="margin-bottom: 2px;">RESUME DE LA FACTURE</h4>
            <table class="items-table" style="margin-top: 0;">
                <thead>
                    <tr>
                        <th>CATEGORIE</th>
                        <th class="position-droit">SOUS-TOTAL</th>
                        <th style="text-align: center">TAUX (%)</th>
                        <th class="position-droit">TOTAL TAXES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TVA normal - TVA sur HT 18,00% - A</td>
                        <td class="position-droit">{{ getprice($clientdevisavoir->total_ttc) }}</td>
                        <td style="text-align: center;">18%</td>
                        <td class="position-droit">{{ getprice($clientdevisavoir->tva) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <htmlpagefooter name="myFooter">
        <div class="footer ft">
            <p>Groupe clis - NCC:1600597G / RCCM: <!--CI-ABJ-03-2015-B13-21043--></p>
            <!-- <p>Adresse</p> -->
            <div class="page-number">Page {PAGENO} / {nbpg}</div>
        </div>
    </htmlpagefooter>

    <setdiv name="myHeader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myFooter" value="on" />

</body>
</html>
