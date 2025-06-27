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
        .totals {
            margin-top: 20px;
            text-align: right;
        }
        .totals h3 {
            margin: 5px 0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="invoice-details invoice-details-header">
            <div style="float: left;">
                <img src="{{ public_path('principale/assets/img/logo/logo.png') }}" style="width: 60%;" alt="Logo de l'entreprise">
            </div>
            <div style="float: right;">
                <h1>Facture</h1>
                <p>Ravmel Informatique</p>
                <p>Date : {{ date('d/m/Y') }}</p>
            </div>
        </div>

        <div class="invoice-details invoice-details-body">
            <div style="float: left;">
                <h2>Informations du Client</h2>
                <p><strong>Nom :</strong> {{ $commande->client->nom }}</p>
                <p><strong>Prénom :</strong> {{ $commande->client->prenom }}</p>
                <p><strong>Téléphone :</strong> {{ $commande->client->contact }}</p>
                <p><strong>Lieu d'habitation :</strong> {{ $commande->client->adresse }}</p>
            </div>
            <div style="float: right;">
                <h2>Informations sur Commande</h2>
                <p><strong>Facture N° :</strong> {{ $commande->numero_facture }}</p>
                <p><strong>Date :</strong> {{ $commande->created_at->format("d-m-Y H:i:s") }}</p>
                <p><strong>Adresse livraison :</strong> {{ $commande->adresse_livraison }}</p>
                <p><strong>Frais de livraison :</strong> <span style="color: green">{{ getprice($commande->frais_livraison) }}</span></p>
            </div>
        </div>

        <!-- Tableau des produits -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="text-align: center">Référence</th>
                    <th style="text-align: center">Image</th>
                    <th style="text-align: center">Produit</th>
                    <th style="text-align: center">Quantité</th>
                    <th style="text-align: center">Prix Unitaire <br>en Fcfa</th>
                    <th style="text-align: center">Total <br>en Fcfa</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::content() as $produit)
                    <tr>
                        <td style="text-align: center;">{{ $produit->model->reference }}</td>
                        <td style="text-align: center;">
                            <img class="image" src="{{ asset(Storage::url($produit->model->image)) }}" alt="" style="width: 10%;" >
                        </td>
                        <td>{{ $produit->model->nom }}</td>
                        <td style="text-align: center">{{ $produit->qty }}</td>
                        <td style="text-align: right">{{ getpriceSFpdf($produit->price) }}</td>
                        <td style="text-align: right">{{ getpriceSFpdf($produit->subtotal()) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totaux -->
        <div class="totals">
            <h3>Sous-total : {{ getprice(Cart::subtotal()) }}</h3>
            <h3>Frais de livraison : {{ getprice($commande->frais_livraison) }}</h3>
            <h3>Total à payer : <strong>{{ getprice($commande->total_prix + $commande->frais_livraison) }}</strong></h3>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>Merci pour votre achat ! Pour toute assistance, contactez-nous.</p>
            <p>www.ravmelinformatique.com | Service-client@ravmelinformatique.com</p>
        </div>
    </div>

    <section style="border-top: 1px solid; margin-top: 170px; padding-top: 0;">
        <div class="footer" style="margin-top: 0;">
            <p>RAVMEL INFORMATIQUE - NCC:1543674E / RCCM: CI-ABJ-03-2015-B13-21043</p>
            <p>ABIDJAN TREICHVILLE</p>
        </div>
    </section>

</body>
</html>
