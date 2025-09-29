{{-- resources/views/invoices/biomedical.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Facture N° 0042</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
    .facture-droit {
      display: inline-block;
      width: 40%;
      border-radius: 5px;
      border: 1px solid black;
      padding: 5px;
    }
    .facture-title {
      font-size: 15px;
    }

    {{-- Coordonnées & Date --}}
    .text-end {
      width: 50%;
      text-align: center;
      margin-left: 50%;
      margin-top: -60px;
      margin-bottom: 20px;
    }
    .label-date {
      margin-bottom: 10px;
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

    {{-- MONTANT EN LETTRES --}}
    .montant-lettre {
      margin-top: 25px;
    }
    
    {{-- CONDITIONS DE PAIEMENT --}}
    .notes {
      margin-top: 25px;
    }
    .notes-child {
      font-weight: bold;
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

      {{-- Infos facture à droite --}}
      <div class="text-start">
        <div class="facture-droit">
          <p style="margin: 0; margin-bottom: 1;">N°CC 1600597G</p>
          <p style="margin: 0; margin-bottom: 1;">Régime d’imposition : Réel Normal</p>
          <p style="margin: 0;">Centre des impôts : CME Port-Bouët</p>
        </div>
        <div class="mt-2">
          <h1 class="facture-title">FACTURE N° 000{{ $clientdevisavoir->id }}</h1>
          <!-- <h1 class="facture-title">FACTURE N° 25 319 S083 / N° 0042</h1> -->
        </div>
      </div>

      {{-- Coordonnées & Date --}}
      <div class="text-end">
        <div class="kv">
          <div class="label-date"><span class="label">Abidjan, le</span> <span class="fw-700">{{ $clientdevisavoir->created_at->locale('fr')->translatedFormat('d F Y') }}</span></div>
          <div class="mt-2 fw-700">{{ $clientdevisavoir->clientdevis->client->nom }}</div>
          <div>{{ $clientdevisavoir->clientdevis->client->adresse_postale }}</div>
          <div>N°CC {{ $clientdevisavoir->clientdevis->client->NCC }}</div>
          @if(!$clientdevis->client->TC)
            <div>N°CC @if($clientdevis->client->NCC) {{ $clientdevis->client->NCC }} @else : Aucun @endif</div>
          @endif
          <div>{{ $clientdevisavoir->clientdevis->client->contact }}</div>
        </div>
      </div>

      {{-- OBJET & RÉFÉRENCE --}}
      <div class="objet">
        <div>
          <span class="objet-child" style="text-decoration: underline; font-weight: bold;">Objet</span> : 
          <span style="text-transform: uppercase;">@if($clientdevisavoir->clientdevis->objet) {{ $clientdevisavoir->clientdevis->objet }} @else VENTE DE PRODUIT @endif</span>
        </div>
      </div>

      {{-- REFERENCE FACTURE --}}
      <div class="text-center reference mb-3">REFERENCE FACTURE: N°{{ $clientdevisavoir->id }}/G-CLIS/{{ $clientdevisavoir->created_at->format('Y') }}</div>

      {{-- PÉRIODE --}}
      <!-- <div class="text-center periode mb-2">MOIS DE JUILLET 2025</div> -->

      {{-- TABLEAU DES LIGNES --}} {{-- AND --}} {{-- TOTAUX --}}
      <table class="table table-sm w-100 ms-auto totals" style="width: 100%;">
        <tbody>
          <tr>
            <td class="gras-td">DÉSIGNATION</td>
            <td class="gras-td">UNITÉ</td>
            <td class="gras-td">@if($clientdevisavoir->clientdevis->TDF != 2) QTE @else Passage @endif</td>
            <td class="gras-td">PU</td>
            <td class="gras-td">TOTAL</td>
          </tr>

          @if($clientdevisavoir->clientdevis->TDF != 2) 
            @foreach ($clientdevisavoir->clientdevisavoirprods as $clientdevisavoirprod)
                <tr>
                  <td style="text-align: left;">{{ $clientdevisavoirprod->clientdevisprod->produit->nom }}</td>
                  <td>{{ $clientdevisavoirprod->clientdevisprod->produit->unite }}</td>
                  <td>{{ $clientdevisavoirprod->quantite }}</td>
                  <td>
                    {{ getpricefr($clientdevisavoirprod->clientdevisprod->prix_unitaire) }}
                    @if($clientdevisavoirprod->clientdevisprod->clientdevisremise && $clientdevisavoirprod->clientdevisprod->clientdevisremise->TR)<span style="color: red; font-size: 10px;">({{ $clientdevisavoirprod->clientdevisprod->clientdevisremise->remise }}%)</span>@endif
                  </td>
                  <td style="text-align: right;">{{ getpricefr($clientdevisavoirprod->prix_total) }}</td>
                </tr>
            @endforeach
          @else
            @foreach($clientdevisavoir->clientdevisavoirprestations as $clientdevisavoirprestation)
                <tr>
                  <td style="text-align: left;">{{ $clientdevisavoirprestation->clientdevisprestation->designation }}</td>
                  <td>{{ $clientdevisavoirprestation->clientdevisprestation->unite }}</td>
                  <td>{{ $clientdevisavoirprestation->quantite }}</td>
                  <td>{{ getprice($clientdevisavoirprestation->clientdevisprestation->prix_unitaire) }}</td>
                  <td style="text-align: right;">{{ getpricefr($clientdevisavoirprestation->prix_total) }}</td>
                </tr>
            @endforeach
          @endif
          
          <tr>
            <td style="border:none;"></td>
            <td colspan="3" class="gras-td">MONTANT TOTAL HT</td>
            <td colspan="1" class="gras-td">{{ getpricefr($clientdevisavoir->total_ttc) }}</td>
          </tr>
          <tr>
            <td style="border:none;"></td>
            <td colspan="3" class="gras-td">TVA 18%</td>
            <td colspan="1" class="gras-td">{{ getpricefr($clientdevisavoir->tva) }}</td>
          </tr>
          <tr>
            <td style="border:none;"></td>
            <td colspan="3" class="gras-td">AUTRES TAXES</td>
            <td colspan="1" class="gras-td">{{ getpricefr($clientdevisavoir->airsi_montant) }}</td>
          </tr>
          <tr>
            <td style="border:none;"></td>
            <td colspan="3" class="gras-td">MONTANT TOTAL TTC</td>
            <td colspan="1" class="gras-td">{{ getpricefr($clientdevisavoir->total_payer) }}</td>
          </tr>
        </tbody>
      </table>

      {{-- MONTANT EN LETTRES --}}
      <div class="montant-lettre">
        <div>La présente facture d'avoir est arrêtée à la somme de :</div>
        <div class="amount-words">
          <span style="text-transform: uppercase;">{{ toWords($clientdevisavoir->total_payer) }}</span> FRANCS CFA
        </div>
      </div>

      {{-- CONDITIONS DE PAIEMENT --}}
      <!-- <div class="mt-2 notes">
        <span class="notes-child">Condition de paiement</span> :
        @if($clientdevisavoir->total_payer) {{ $clientdevisavoir->total_payer }} @else Comptant @endif à compter de la date de réception de la facture.
      </div> -->

      {{-- SIGNATURES & TAMPONS --}}
      <div class="row signature">
        <div style="text-align: right; font-weight:bold;">SERVICE COMPTABILITÉ</div>
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