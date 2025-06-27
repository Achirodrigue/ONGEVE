<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .invoice-container {
            width: 100%;
            margin: auto;
            padding: 0 20px;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }

        .invoice-details h1 {
            margin: 0;
            color: #007BFF;
        }

        .items-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .items-table th {
            background-color: #007BFF;
            color: #fff;
        }

        .totals {
            margin-top: 20px;
            text-align: right;
        }

        .totals h3 {
            margin: 5px 0;
        }

        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        .page-number {
            text-align: right;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

{{-- Définir l'entête de chaque page --}}
<htmlpageheader name="myHeader">
    <div class="invoice-details">
        <div style="width: 48%;">
            <img src="{{ public_path('principale/assets/img/logo/logo.png') }}" style="width: 60%;" alt="Logo de l'entreprise">
        </div>
        <div style="width: 48%; text-align: right;">
            <h1>Facture</h1>
            <p>Ravmel Informatique</p>
            <p>Date : {{ date('d/m/Y') }}</p>
        </div>
    </div>
</htmlpageheader>

{{-- Définir le pied de page de chaque page --}}
<htmlpagefooter name="myFooter">
    <div class="footer">
        <p>RAVMEL INFORMATIQUE - NCC:1543674E / RCCM: CI-ABJ-03-2015-B13-21043</p>
        <p>ABIDJAN TREICHVILLE</p>
        <div class="page-number">Page {PAGENO} / {nbpg}</div>
    </div>
</htmlpagefooter>

{{-- Activer l’entête et pied de page --}}
<sethtmlpageheader name="myHeader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myFooter" value="on" />

{{-- CONTENU PRINCIPAL --}}
<div class="invoice-container">

    {{-- Informations client et commande --}}
    <div style="margin-top: 20px;">
        <div style="float: left; width: 48%;">
            <h2>Informations du Client</h2>
            <p><strong>Nom :</strong> {{ $commande->client->nom }}</p>
            <p><strong>Prénom :</strong> {{ $commande->client->prenom }}</p>
            <p><strong>Téléphone :</strong> {{ $commande->client->contact }}</p>
            <p><strong>Lieu d'habitation :</strong> {{ $commande->client->adresse }}</p>
        </div>
        <div style="float: right; width: 48%;">
            <h2>Informations sur Commande</h2>
            <p><strong>Facture N° :</strong> {{ $commande->numero_facture }}</p>
            <p><strong>Date :</strong> {{ $commande->created_at->format("d-m-Y H:i:s") }}</p>
            <p><strong>Adresse livraison :</strong> {{ $commande->adresse_livraison }}</p>
            <p><strong>Frais de livraison :</strong> <span style="color: green">{{ getprice($commande->frais_livraison) }}</span></p>
        </div>
        <div style="clear: both;"></div>
    </div>

    {{-- Tableau des produits --}}
    <table class="items-table">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Image</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire (Fcfa)</th>
                <th>Total (Fcfa)</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Cart::content() as $produit)
                <tr>
                    <td>{{ $produit->model->reference }}</td>
                    <td><img src="{{ asset(Storage::url($produit->model->image)) }}" style="width: 30px;"></td>
                    <td>{{ $produit->model->nom }}</td>
                    <td>{{ $produit->qty }}</td>
                    <td style="text-align: right">{{ getpriceSFpdf($produit->price) }}</td>
                    <td style="text-align: right">{{ getpriceSFpdf($produit->subtotal()) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totaux --}}
    <div class="totals">
        <h3>Sous-total : {{ getprice(Cart::subtotal()) }}</h3>
        <h3>Frais de livraison : {{ getprice($commande->frais_livraison) }}</h3>
        <h3>Total à payer : <strong>{{ getprice($commande->total_prix + $commande->frais_livraison) }}</strong></h3>
    </div>

</div>

</body>
</html>
