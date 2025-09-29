{{-- resources/views/invoices/biomedical.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Facture N° 0042</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="{{ asset("dashboard/css/bootstrap.min.css") }}" > -->

  <style>
    body {
        font-family: "Cambria", "Algerian", "Book antiqua", "Times New Roman", Arial, sans-serif;
    }

    {{-- EN-TÊTE --}}
    .invoice-details {
      background-color: #19a35c;
      border-radius: 5px;
      padding: 30px;
      padding-left: 5px;
      margin-bottom: 15px;
    }
    /* img {
      position: absolute;
      top: -500px;
      right: 0;
    } */
    .logo {
      width: 100px;
      margin-top: -25px;
    }
    .invoice-details .entete {
      margin-top: -90px;
      text-align: center;
      padding-left: 25px;
    }
    .entete .title-xlg {
      font-size: 35px;
      font-weight: 900;
      color: white;
      margin: 0;
    }
    .entete .small-legend {
      text-align: center;
      margin: 0;
    }


    {{-- Infos facture à droite --}}
    .start-end {
      margin-top: 45px;
      margin-bottom: 75px;
    }

    .facture-droit {
      /* display: inline-block; */
      width: 50%;
      border-radius: 5px;
      border: 1px solid black;
      padding: 5px;
    }
    .facture-title {
      font-size: 15px;
    }
    .paragraphe {
      margin: 5px 0; 
      margin-bottom: 1;
    }

    {{-- Coordonnées & Date --}}
    .text-end {
      width: 45%;
      margin-left: 55%;
      margin-top: -248px;
      /* margin-bottom: 55px; */
    }
    .kv {
      border-radius: 5px;
      border: 1px solid black;
      padding: 5px;
    }
    .label-date {
      margin-bottom: 10px;
    }

    .trait {
      text-decoration: underline;
    }

    {{-- OBJET & RÉFÉRENCE --}}
    .objet {
      margin-bottom: 20px;
      font-weight: 900;
    }
    .objet-child {
      text-decoration: underline; 
      font-weight: bold;
    }

    {{-- REFERENCE FACTURE --}} {{-- PÉRIODE --}}
    .reference, .periode {
      font-weight: bold;
      text-align: center;
      margin-bottom: 15px;
    }

    {{-- TABLEAU DES LIGNES --}}
    table {
      border-collapse: collapse; /* Fusionne les bordures des cellules */
    }
    th {
      padding: 20px;
      text-transform: uppercase;
      text-align: center;
      border: 1px solid black; /* Applique la bordure sur les 4 côtés de chaque cellule */
    }
    td {
      padding: 10px;
      font-size: 14px;
      text-align: center;
      border: 1px solid black; /* Applique la bordure sur les 4 côtés de chaque cellule */
    }
    .gras-td {
      font-weight: bold;
    }
    .gras-ml {
      margin-left: 50px;
    }

    {{-- MONTANT EN LETTRES --}}
    .montant-lettre {
      margin-top: 25px;
    }
    
    {{-- CONDITIONS DE PAIEMENT --}}
    .notes {
      margin-top: 10px;
      margin-bottom: 120px;
    }
    .notes-child {
      /* font-weight: bold; */
      text-transform: uppercase;
      text-decoration: underline;
    }
    
    {{-- SIGNATURES & TAMPONS --}}
    .signature {
      margin-top: 25px;
    }


    .bottom-hr1{
        height: 2px;
        margin: 0;
    }
    .bottom-hr2 {
        border: 1px solid black;
        margin-top: 1.5px;

        margin-bottom: 5px;
    }
    .footer {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        color: #19a35c;
        opacity: 0.9;
    }
    .page-number {
        text-align: right;
        font-size: 12px;
    }
  </style>
</head>
<body>

    <div class="invoice-a4 position-relative">

      {{-- EN-TÊTE --}}
      <div class="invoice-details" style="margin-left: 120px;">
          <img class="logo" src="{{ public_path('dashboard/img/logo2.png') }}" alt="Logo de l'entreprise" style="margin-left: -120px;">

          <div class="entete">
            <h2 class="title-xlg">GROUPE CLIS</h2>
            <p class="small-legend">Le partenaire de votre démarche environnementale</p>
          </div>
      </div>

      <div class="start-end">
          {{-- Infos facture à droite --}}
          <div class="text-start">
            <div class="facture-droit">
              <p class="paragraphe">Raison Sociale : <span class="gras-td gras-ml">{{ $clientdevis->client->nom }}</span></p>
              <p class="paragraphe">Adresse Postale : {{ $clientdevis->client->adresse_postale ?? 'Aucune' }}</p>
              <p class="paragraphe">N° de Compte : <span class="gras-td gras-ml">{{ $clientdevis->client->reference }}</span></p>
              <p class="paragraphe">Condition de Paiement : {{ $clientdevis->MP }}</p>
              <p class="paragraphe">Interlocuteur : {{ $clientdevis->client->clientinfo->interlocuteur ?? 'Aucun' }}</p>
              <p class="paragraphe">Contact : {{ $clientdevis->client->contact }}</p>
              <p class="paragraphe">E-mail : {{ $clientdevis->client->email ?? 'Aucun' }}</p>
              <p class="paragraphe">N° CC : {{ $clientdevis->client->NCC ?? 'Aucun' }}</p>
            </div>
          </div>

          {{-- Coordonnées & Date --}}
          <div class="text-end">
            <div class="mt-2">
              <h1 class="facture-title">BON DE LIVRAISON</h1>
            </div>
            <div class="kv">
              <p class="paragraphe">N° BL : <span class="gras-td gras-ml">BL0000{{ $clientdevis->id }}</span></p>
              <p class="paragraphe">N° BC : </p>
              <p class="paragraphe">Date : <span class="gras-td gras-ml">{{ $clientdevis->created_at->format('d/m/Y H:i') }}</span></p>
              <p class="paragraphe">Suivi par : <span class="gras-td gras-ml">AMANI Jean Fabrice</span></p>
              <p class="paragraphe">Contact : <span class="gras-td gras-ml">05 46 00 84 15</span></p>
              <p class="paragraphe">Saisi par : MANASSE</p>
            </div>
          </div>
      </div>

      {{-- TABLEAU DES LIGNES --}} {{-- AND --}} {{-- TOTAUX --}}
      <table class="table table-sm w-100 ms-auto totals" style="width: 100%;">
        <tbody>
          <tr>
            <td class="gras-td">Référence</td>
            <td class="gras-td">Désignation</td>
            <td class="gras-td">Quantité commandée</td>
            <td class="gras-td">Quantité livrée</td>
          </tr>

          @foreach ($clientdevis->clientdevisprods as $clientdevisprod)
            <tr>
              <td style="text-align: left;">{{ $clientdevisprod->produit->reference }}</td>
              <td style="text-align: left;">{{ $clientdevisprod->produit->nom }}</td>
              <td>{{ $clientdevisprod->quantite }}</td>
              <td>{{ $clientdevisprod->quantite }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{-- CONDITIONS DE PAIEMENT --}}
      <div class="mt-2 notes">
        <span class="notes-child">Date de reception et visa client</span> 
      </div>
      
      <div>
        <span class="trait">N.B : Dans la limite des stocks disponibles</span> 
      </div>

    </div>

    <htmlpagefooter name="myFooter">
        <hr class="bottom-hr1">
        <hr class="bottom-hr2">
        <div class="footer ft">
            <p>
                Siège Social : Abidjan, Treichville Boulevard Giscard d’Estaing Immeuble SCI Chevalier de 
                Clieu - SARL au capital de 85 000 000 FCFA · RCCM : CI-ABJ-03-2002-M-29812 – N° Cpte BNI : 
                026931600006 79 – N° Cpte SGBCI : 012944824629 75 · Tél : (+225) 27 21 35 00 13 – Fax : 
                27 21 25 02 53 – www.groupeclis.com
            </p>
            <!-- <p>Adresse</p> -->
            <div class="page-number">Page {PAGENO} / {nbpg}</div>
        </div>
    </htmlpagefooter>

    <setdiv name="myHeader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myFooter" value="on" />
    
</body>
</html>