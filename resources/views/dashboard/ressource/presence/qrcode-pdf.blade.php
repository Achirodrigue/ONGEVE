<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from htmlstream.com/preview/front-dashboard-v2.1.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Nov 2024 10:27:09 GMT -->
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Groupe clis</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset("dashboard/img/logo2.jpg") }}">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="{{ asset("dashboard/assets/css/vendor.min.css") }}">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="{{ asset("dashboard/assets/css/theme.minc619.css?v=1.0") }}">

  <link rel="preload" href="{{ asset("dashboard/assets/css/theme.min.css") }}" data-hs-appearance="default" as="style">
  <link rel="preload" href="{{ asset("dashboard/assets/css/theme-dark.min.css") }}" data-hs-appearance="dark" as="style">
  <link rel="stylesheet" href="{{ asset("dashboard/css/style.css") }}" >
  <link href="{{ asset("auth/css/style.css") }}" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script><style>
  body, html {
    height: 100%;
    margin: 0;
  }
  #container {
    display: flex;
    justify-content: center; /* centre horizontalement */
    align-items: center;    /* centre verticalement */
    height: 100vh;          /* prend toute la hauteur de la fenêtre */
    flex-direction: column; /* pour que le bouton soit en dessous du QR code */
    gap: 20px;              /* espace entre QR code et bouton */
  }
</style>

</head>
<body>

<div id="container">
  <div id="qrcode"></div>
  <div class="page-header">
    <div class="row align-items-center mb-3">
      <div class="col-auto">
        <button id="download-pdf" class="btn btn-primary">
          <i class="bi-file-earmark-arrow-down me-1"></i> Generer un pdf
        </button>
      </div>
      <div class="col-auto">
        <a class="btn btn-primary" href="{{ route('ressource.liste.presence') }}">
          <i class="bi-arrow-return-left me-1"></i> Retour
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  const urlFormulaire = "{{ route('commun.formulaire.presence') }}";

  const qrcode = new QRCode(document.getElementById("qrcode"), {
    text: urlFormulaire,
    width: 200,
    height: 200,
    colorDark : "#000000",
    colorLight : "#ffffff",
  });

  document.getElementById("download-pdf").addEventListener("click", () => {
    const qrDiv = document.getElementById("qrcode");
    let imgData;

    const canvas = qrDiv.querySelector("canvas");
    if (canvas) {
      imgData = canvas.toDataURL("image/png");
    } else {
      const img = qrDiv.querySelector("img");
      if (img) {
        imgData = img.src;
      } else {
        alert("QR code non trouvé !");
        return;
      }
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const pageWidth = doc.internal.pageSize.getWidth();
    const pageHeight = doc.internal.pageSize.getHeight();

    const imgWidth = 50;  // largeur souhaitée de l'image dans le PDF (mm)
    const imgHeight = 50; // hauteur souhaitée

    // Calculer la position pour centrer l'image
    const x = (pageWidth - imgWidth) / 2;
    const y = (pageHeight - imgHeight) / 2;

    doc.text("Formulaire d'inscription", pageWidth / 2, y - 10, { align: "center" });
    doc.addImage(imgData, "PNG", x, y, imgWidth, imgHeight);
    doc.save("formulaire_inscription_qr.pdf");
  });

</script>

</body>
</html>
