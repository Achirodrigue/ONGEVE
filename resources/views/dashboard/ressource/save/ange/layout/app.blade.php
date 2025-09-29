@include('dashboard.include.appTop')

    

@include('dashboard.include.appBottom')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Groupe Clis</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset("ange/vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
    <style>
        body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
        color: #333;
        }

        .header {
        text-align: center;
        margin-bottom: 30px;
        }

        .header h1 {
        color: #2c3e50;
        margin-bottom: 5px;
        }

        .header p {
        color: #7f8c8d;
        font-style: italic;
        }

        .form-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        }

        .form-group {
        margin-bottom: 15px;
        }

        label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea,
        select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        }

        th {
        background-color: #f2f2f2;
        }

        .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        }

        .signature-box {
        width: 45%;
        }

        .signature-line {
        border-top: 1px solid #333;
        margin-top: 50px;
        padding-top: 5px;
        }

        .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        }

        button {
        background-color: #2c3e50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        }

        button:hover {
        background-color: #1a252f;
        }

        .step {
        display: none;
        }

        .step.active {
        display: block;
        }

        .state-options {
        display: flex;
        gap: 15px;
        }

        .state-option {
        display: flex;
        align-items: center;
        }

        .state-option input {
        margin-right: 5px;
        }
    </style>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset("ange/css/sb-admin-2.min.css") }}" rel="stylesheet">

</head>

<body id="page-top">

@php dd(5); @endphp


    @include('dashboard.ressource.ange.layout.utils.nav')
        @yield('body')
    @include('dashboard.ressource.ange.layout.utils.footer')


    <!-- <script>    
        function openModal() {
            const url = "{{ url('/presence-formulaire') }}"; // lien vers le formulaire Laravel
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
    </script> -->
 
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset("ange/vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("ange/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset("ange/vendor/jquery-easing/jquery.easing.min.js") }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset("ange/js/sb-admin-2.min.js") }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset("ange/vendor/chart.js/Chart.min.js") }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset("ange/js/demo/chart-area-demo.js") }}"></script>
    <script src="{{ asset("ange/js/demo/chart-pie-demo.js") }}"></script>

</body>

</html>