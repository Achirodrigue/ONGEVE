<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agrandir une image au clic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .thumbnail {
      max-width: 200px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .thumbnail:hover {
      opacity: 0.8;
    }

    .modal-img {
      width: 100%;
    }
  </style>
</head>
<body>

<div class="container mt-5 text-center">
  <img src="{{ asset("principale/assets/img/perso/6.jpg") }}" class="thumbnail img-thumbnail" alt="Image" data-bs-toggle="modal" data-bs-target="#imageModal">
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img src="{{ asset("principale/assets/img/perso/6.jpg") }}" class="modal-img" alt="Image agrandie">
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
