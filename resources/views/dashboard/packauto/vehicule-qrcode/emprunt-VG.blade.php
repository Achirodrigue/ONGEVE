@extends('dashboard.qrcodeLayout.app')
@section('body')


    <div id="container">
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-auto">
            <h1>QR Code d'emprunt général pour tout les véhicules</h1>
          </div>
        </div>
      </div>

      <div id="qrcode"></div>

      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-auto">
            <button id="download-pdf" class="btn btn-primary">
              <i class="bi-file-earmark-arrow-down me-1"></i> Generer un pdf
            </button>
          </div>
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('packauto.pvehicule.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
        </div>
      </div>
    </div>

    <script>
      const urlFormulaire = "{{ route('commun.emprunt.vehicule.generale') }}";

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

        doc.text("Formulaire d'emprunt des véhicules", pageWidth / 2, y - 10, { align: "center" });
        doc.addImage(imgData, "PNG", x, y, imgWidth, imgHeight);
        doc.save("formulaire_emprunt_vehicule.pdf");
      });

    </script>


@endsection