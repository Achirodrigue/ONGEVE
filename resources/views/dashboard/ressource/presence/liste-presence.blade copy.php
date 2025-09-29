<!DOCTYPE html>
<html>
<head>
  <title>Test QR code PDF</title>
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
  <div style="display: none;" id="qrcode"></div>
  <button id="download-pdf">Télécharger PDF</button>
</div>

<script>
  const urlFormulaire = "https://exemple.com/inscription";

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
