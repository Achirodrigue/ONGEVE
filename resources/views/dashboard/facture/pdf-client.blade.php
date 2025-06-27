<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Groupe clis</title>
    <link rel="shortcut icon" href="{{ asset("dashboard/img/logo2.jpg") }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
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
            border-bottom: 2px solid #007BFF;
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
            text-align: left;
        }
        .items-table th {
            background-color: #007BFF;
            color: #fff;
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
    </style>
</head>
<body>

    <div class="invoice-container">

        <div class="invoice-details invoice-details-header">
            <div style="float: left;">
                <img src="{{ public_path('dashboard/img/logo1.jpg') }}" style="width: 150px;" alt="Logo de l'entreprise">
            </div>
            <div style="float: right;">
                <h1>Facture</h1>
                <p>Devis Commande</p>
                <p>Date : {{ date('d/m/Y') }}</p>
            </div>
        </div>

        <div class="invoice-details invoice-details-body">
            <div style="float: left;">
                <h2>Informations du Client</h2>
                <p><strong>Nom :</strong> {{ $clientdevis->client->nom }}</p>
                <p><strong>Prénom :</strong> {{ $clientdevis->client->prenom }}</p>
                <p><strong>Téléphone :</strong> {{ $clientdevis->client->contact }}</p>
                <p><strong>Lieu d'habitation :</strong> {{ $clientdevis->client->adresse }}</p>
            </div>
            <div style="float: right;">
                <h2>Informations sur le devis</h2>
                <p><strong>Devis N° :</strong> {{ $clientdevis->numero_devis }}</p>
                <p><strong>Date :</strong> {{ $clientdevis->created_at->format("d-m-Y H:i") }}</p>
                <p><strong>Délai de livraison :</strong> <span style="color: green">{{ $clientdevis->delai_livraison }}</span></p>
                <p><strong>Frais de livraison :</strong> <span style="color: green">{{ getprice($clientdevis->frais) }}</span></p>
                <p><strong>TVA :</strong> <span style="color: green">18%</span></p>
            </div>
        </div>

        <!-- Tableau des produits -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="text-align: center">Référence</th>
                    <th style="text-align: center">Produit</th>
                    <th style="text-align: center">Quantité</th>
                    <th style="text-align: center">Prix Unitaire <br>en Fcfa</th>
                    <th style="text-align: center">Total <br>en Fcfa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientdevis->clientdevisprods as $clientdevisprod)
                    <tr>
                        <td style="text-align: center;">{{ $clientdevisprod->produit->reference }}</td>
                        <td>{{ $clientdevisprod->produit->nom }}</td>
                        <td style="text-align: center">{{ $clientdevisprod->quantite }}</td>
                        <td style="text-align: right">{{ strrev(wordwrap(strrev($clientdevisprod->prix_unitaire), 3, ' ', true)) }}</td>
                        <td style="text-align: right">{{ strrev(wordwrap(strrev($clientdevisprod->prix_total), 3, ' ', true)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totaux -->
        <div class="totals">
            <h3>Sous-total : {{ strrev(wordwrap(strrev($clientdevis->total_ttc), 3, ' ', true)) }}F</h3>
            <h3>Frais : {{ strrev(wordwrap(strrev($clientdevis->frais), 3, ' ', true)) }}F</h3>
            <h3>TVA (18%) : {{ strrev(wordwrap(strrev($clientdevis->tva), 3, ' ', true)) }}F</h3>
            <h3>Total à payer : <strong>{{ strrev(wordwrap(strrev($clientdevis->total_ttc + $clientdevis->tva + $clientdevis->frais), 3, ' ', true)) }}F</strong></h3>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <!-- <p>Merci pour votre achat ! Pour toute assistance, contactez-nous.</p>
            <p>www.ravmelinformatique.com | Service-client@ravmelinformatique.com</p> -->
            <h3>Merci !</h3>
            <p>pour toute la confiance que vous nous accordez</p>
        </div>
    </div>
    
    <htmlpagefooter name="myFooter">
        <div class="footer ft">
            <p>Groupe clis - NCC:1543674E / RCCM: CI-ABJ-03-2015-B13-21043</p>
            <p>Adresse</p>
            <div class="page-number">Page {PAGENO} / {nbpg}</div>
        </div>
    </htmlpagefooter>

    <setdiv name="myHeader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myFooter" value="on" />

</body>
</html>
