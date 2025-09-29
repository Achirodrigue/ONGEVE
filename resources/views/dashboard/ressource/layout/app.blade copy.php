@include('dashboard.include.appTop')

    @include('dashboard.ressource.layout.utils.nav')
        @yield('body')
    @include('dashboard.ressource.layout.utils.footer')

    <!-- RH -->
        <!-- presence -->
            <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Header -->
                        <div class="modal-header">
                        <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">QR code de presence</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="modal-body">
                            <div id="qrcode"></div>
                        </div>
                        <!-- End Body -->
                    </div>
                </div>
            </div>
            <script>
                function openModal() {
                    const url = "{{ url('/commune/page/formulaire/presence') }}"; // lien vers le formulaire Laravel
                    const qrcodeContainer = document.getElementById('qrcode');
                    qrcodeContainer.innerHTML = ''; // réinitialiser à chaque ouverture

                    const qr = new QRCode(qrcodeContainer, {
                        text: url,
                        width: 200,
                        height: 200
                    });

                    // Attendre un peu que le QR soit généré puis créer le lien de téléchargement
                    setTimeout(() => {
                        const qrCanvas = qrcodeContainer.querySelector('canvas');
                        if (qrCanvas) {
                            const dataURL = qrCanvas.toDataURL("image/png");
                            document.getElementById("downloadBtn").href = dataURL;
                        }
                    }, 300);

                    // Ouvrir le modal
                    new bootstrap.Modal(document.getElementById('qrModal')).show();
                }
            </script>
        <!-- end presence -->
        <!-- presence -->
            <div id="qrcode"></div>
            
            <script>
                // Générer QR code avec l'URL du formulaire Laravel (injectée via Blade)
                const urlFormulaire = "{{ route('commun.formulaire.presence') }}";

                const qrcode = new QRCode(document.getElementById("qrcode"), {
                text: urlFormulaire,
                width: 200,
                height: 200,
                colorDark : "#000000",
                colorLight : "#ffffff",
                });

                // Fonction pour générer le PDF avec jsPDF
                function openModal() {
                // Récupérer le canvas généré par QRCode.js
                const qrCanvas = document.querySelector("#qrcode canvas");

                // Convertir canvas en image dataURL
                const imgData = qrCanvas.toDataURL("image/png");

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                doc.text("Formulaire d'inscription", 10, 10);
                doc.addImage(imgData, "PNG", 10, 20, 50, 50);
                doc.save("formulaire_inscription_qr.pdf");
                });
            </script>
        <!-- end presence -->
    <!-- End RH -->

@include('dashboard.include.appBottom')