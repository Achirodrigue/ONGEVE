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

    {{-- REFERENCE FACTURE --}} {{-- PÉRIODE --}} {{-- CHANTIER --}}
    .reference, .periode, .chantier {
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
      <h1 class="facture-title">FACTURE N° 000{{ $clientdevis->id }}</h1>
    </div>
  </div>

  {{-- Coordonnées & Date --}}
  <div class="text-end">
    <div class="kv">
      <div class="label-date"><span class="label">Abidjan, le</span> <span class="fw-700">{{ $clientdevis->created_at->locale('fr')->translatedFormat('d F Y') }}</span></div>
      <div class="mt-2 fw-700">{{ $clientdevis->client->nom }}</div>
      <div>{{ $clientdevis->client->adresse_postale }}</div>
      @if(!$clientdevis->client->TC)
        <div>N°CC @if($clientdevis->client->NCC) {{ $clientdevis->client->NCC }} @else : Aucun @endif</div>
      @endif
      <div>{{ $clientdevis->client->contact }}</div>
      <!-- <div class="label-date"><span class="label">Abidjan, le</span> <span class="fw-700">{{ $clientdevis->created_at->locale('fr')->translatedFormat('d F Y') }}</span></div>
        <div class="mt-2 fw-700">PHARMACIE & LABORATOIRE LONGCHAMP</div>
        <div>01 BP 11 ABIDJAN 01</div>
        <div>N° CC 07 08 392 V</div>
        <div>27 20 22 75 98</div> -->
    </div>
  </div>

  {{-- OBJET & RÉFÉRENCE --}}
  <div class="objet">
    <div>
      <span class="objet-child" style="text-decoration: underline; font-weight: bold;">Objet</span> : 
      <span style="text-transform: uppercase;">@if($clientdevis->objet) {{ $clientdevis->objet }} @else LOCATION DE PRODUIT @endif</span>
    </div>
  </div>

  {{-- REFERENCE FACTURE --}}
  <div class="text-center reference mb-3">REFERENCE FACTURE: N°{{ $clientdevis->id }}/G-CLIS/{{ $clientdevis->created_at->format('Y') }}</div>

  {{-- CHANTIER --}}
  @if($clientdevis->chantier)
    <div class="text-center chantier mb-2">CHANTIER : {{ $clientdevis->chantier }}</div>
  @endif

  {{-- PÉRIODE --}}
  <div class="text-center periode mb-2">
    DU {{ date('d/m/Y', strtotime($clientdevis->clientdevisinfo->debut)) }} AU {{ date('d/m/Y', strtotime($clientdevis->clientdevisinfo->fin)) }}
  </div>

  {{-- TABLEAU DES LIGNES --}} {{-- AND --}} {{-- TOTAUX --}}
  <table class="table table-sm w-100 ms-auto totals" style="width: 100%;">
    <tbody>
      <!-- <tr>
        <td class="gras-td" colspan="5" style="font-size: 120px; background-color: #acceac;">BON DE COMMANDE .......</td>
      </tr> -->
      <tr>
        <td class="gras-td">DÉSIGNATION</td>
        <td class="gras-td">Nombres de jours</td>
        <td class="gras-td">QTE</td>
        <td class="gras-td">PU</td>
        <td class="gras-td">TOTAL</td>
      </tr>
      
      @foreach ($clientdevis->clientdevisprods as $clientdevisprod)
        <tr>
          <td style="text-align: left;">{{ $clientdevisprod->produit->nom }}</td>
          <td>{{ $clientdevisprod->nbre_jour }}</td>
          <td>{{ $clientdevisprod->quantite }}</td>
          <td>
            {{ getpricefr($clientdevisprod->prix_unitaire) }}
            @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR)<span style="color: red; font-size: 10px;">({{ $clientdevisprod->clientdevisremise->remise }}%)</span>@endif
          </td>
          <td style="text-align: right;">{{ getpricefr($clientdevisprod->prix_total) }}</td>
        </tr>
      @endforeach
      
      <tr>
        <td style="border:none;"></td>
        <td colspan="3" class="gras-td">MONTANT TOTAL HT</td>
        <td colspan="1" class="gras-td">{{ getpricefr($clientdevis->total_ttc) }}</td>
      </tr>
      <tr>
        <td style="border:none;"></td>
        <td colspan="3" class="gras-td">TVA 18%</td>
        <td colspan="1" class="gras-td">{{ getpricefr($clientdevis->tva) }}</td>
      </tr>
      <tr>
        <td style="border:none;"></td>
        <td colspan="3" class="gras-td">AUTRES TAXES</td>
        <td colspan="1" class="gras-td">{{ getpricefr($clientdevis->airsi_montant + $clientdevis->timbre_montant + $clientdevis->frais) }}</td>
      </tr>
      <tr>
        <td style="border:none;"></td>
        <td colspan="3" class="gras-td">MONTANT TOTAL TTC</td>
        <td colspan="1" class="gras-td">{{ getpricefr($clientdevis->total_payer) }}</td>
      </tr>
    </tbody>
  </table>

  {{-- MONTANT EN LETTRES --}}
  <div class="montant-lettre">
    <div>La présente facture est arrêtée à la somme de :</div>
    <div class="amount-words">
      <span style="text-transform: uppercase;">{{ toWords($clientdevis->total_payer) }}</span> FRANCS CFA
    </div>
  </div>

  {{-- CONDITIONS DE PAIEMENT --}}
  <div class="mt-2 notes">
    <span class="notes-child">Condition de paiement</span> :
    @if($clientdevis->delai_paiement) {{ $clientdevis->delai_paiement }} @else Comptant @endif à compter de la date de dépôt de la facture.
  </div>

  {{-- SIGNATURES & TAMPONS --}}
  <div class="row signature">
    <div style="text-align: right; font-weight:bold;">SERVICE COMPTABILITÉ</div>
  </div> 

  <!-- 
    <div class="d-flex justify-content-between align-items-start mb-2 p-3">
      <div class="d-flex align-items-center p-3" style="background-color: orange;">
        {{-- Logo à gauche --}}
        <img src="{{ asset('dashboard/img/logo2.png') }}" 
            alt="Logo de l'entreprise" 
            style="width:70px; height:70px; object-fit:contain;">

        {{-- Texte à droite du logo --}}
        <div class="ms-3">
          <div class="title-xlg text-white fw-bold">GROUPE CLIS</div>
          <div class="small-legend text-white">Le partenaire de votre démarche environnementale</div>
        </div>
      </div>


      {{-- Infos facture à droite --}}
      <div class="text-end">
        <div class="box p-2 small-legend bg-light">
          <div>N° C 1600597 G</div>
          <div>Régime d’imposition : Réel Normal</div>
          <div>Centre des impôts : CME Port-Bouët</div>
        </div>
        <div class="mt-2">
          <div class="fw-bold">FACTURE N° 25 319 S083</div>
          <div class="fw-bold">N° 0042</div>
        </div>
      </div>
    </div>

    {{-- Coordonnées & Date --}}
    <div class="d-flex justify-content-between mb-3">
      <div class="kv">
        <div><span class="label">Abidjan, le</span> <span class="fw-700">15 Août 2025</span></div>
        <div class="mt-2 fw-700">PHARMACIE & LABORATOIRE LONGCHAMP</div>
        <div>01 BP 11 ABIDJAN 01</div>
        <div>N° CC 07 08 392 V</div>
        <div>27 20 22 75 98</div>
      </div>
      <div></div>
    </div>

    {{-- OBJET & RÉFÉRENCE --}}
    <div class="mb-3">
      <div><span class="fw-700">Objet :</span> COLLECTE ET DESTRUCTION DE DÉCHETS BIOMÉDICAUX</div>
      <div class="mt-1"><span class="bg-accent">RÉFÉRENCE FACTURE : N°531/G-CLIS/2025</span></div>
    </div>

    {{-- REFERENCE FACTURE --}}
    <div class="text-center fw-700 mb-3">REFERENCE FACTURE: N°531/G-CLIS/2025</div>

    {{-- PÉRIODE --}}
    <div class="text-center fw-700 mb-2">MOIS DE JUILLET 2025</div>

    {{-- TABLEAU DES LIGNES --}}
    <table class="table table-sm table-invoice w-100">
      <thead>
      <tr>
        <th style="width:45%">DÉSIGNATION</th>
        <th style="width:10%">UNITÉ</th>
        <th style="width:10%">QTE</th>
        <th style="width:15%">PU</th>
        <th style="width:20%">TOTAL</th>
      </tr>
      </thead>
      <tbody>
        <tr>
          <td>Enlèvement de déchets biomédicaux (déchets liquides)</td>
          <td class="text-center">L</td>
          <td class="text-center">75</td>
          <td class="text-center">FORFAIT</td>
          <td class="text-end">90 000</td>
        </tr>
        <tr>
          <td>Enlèvement de déchets biomédicaux (déchets solides)</td>
          <td class="text-center">KG</td>
          <td class="text-center">696</td>
          <td class="text-center">FORFAIT</td>
          <td class="text-end">720 000</td>
        </tr>
        <tr>
          <td>Quantité supplémentaire de déchets biomédicaux (déchets liquides)</td>
          <td class="text-center">L</td>
          <td class="text-center">315</td>
          <td class="text-center">1 075</td>
          <td class="text-end">338 625</td>
        </tr>
        <tr>
          <td>Quantité supplémentaire de déchets biomédicaux (déchets solides)</td>
          <td class="text-center">KG</td>
          <td class="text-center">319,75</td>
          <td class="text-center">1 075</td>
          <td class="text-end">343 731</td>
        </tr>
      </tbody>
    </table>

    {{-- TOTAUX --}}
    <table class="table table-sm w-50 ms-auto totals">
      <tbody>
      <tr>
        <td class="label">MONTANT TOTAL HT</td>
        <td class="value">1 492 356</td>
      </tr>
      <tr>
        <td class="label">TVA 18 %</td>
        <td class="value">268 624</td>
      </tr>
      <tr>
        <td class="label">MONTANT TOTAL TTC</td>
        <td class="value">1 760 980</td>
      </tr>
      </tbody>
    </table>

    {{-- MONTANT EN LETTRES --}}
    <div class="mt-3">
      <div>La présente facture est arrêtée à la somme de :</div>
      <div class="amount-words">
        UN MILLION SEPT CENT SOIXANTE MILLE NEUF CENT QUATRE-VINGTS FRANCS CFA
      </div>
    </div>

    {{-- CONDITIONS DE PAIEMENT --}}
    <div class="mt-2 notes">
      <span class="fw-700">Condition de paiement :</span>
      Payable 30 jours à compter de la date de réception de la facture.
    </div>

    {{-- SIGNATURES & TAMPONS --}}
    <div class="row mt-4">
      <div class="col-6">
        <div class="fw-700 mb-2">SERVICE COMPTABILITÉ</div>
        <div class="signature-line"></div>
        <div class="small-legend oblique mt-1">Signature & Nom</div>
      </div>
      <div class="col-6 text-end">
        <div class="d-inline-block text-center">
          <div class="stamp d-flex align-items-center justify-content-center small-legend">Cachet</div>
        </div>
      </div>
    </div>

    {{-- PIED DE PAGE --}}
    <div class="page-footer text-center">
      Siège Social : Abidjan, Treichville Boulevard Giscard d’Estaing Immeuble SCI Chevalier de Clieu - SARL au capital de 85 000 000 FCFA · RCCM : CI-ABJ-03-2002-M-29812 – N° Cpte BNI : 026931600006 79 – N° Cpte SGBCI : 012944824629 75 · Tél : (+225) 27 21 35 00 13 – Fax : 27 21 25 02 53 – www.groupeclis.com
    </div>

    <div class="no-print mt-4 text-end">
      <button onclick="window.print()" class="btn btn-dark">Imprimer / Export PDF</button>
    </div> 
  -->
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