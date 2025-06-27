<?php
session_start();

// Vérifier si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Accès interdit. Vous devez être un administrateur pour accéder à cette page.");
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'nom_de_ta_base';
$username = 'ton_utilisateur';
$password = 'ton_mot_de_passe';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer tous les produits avec le nom du vendeur
$stmt = $pdo->prepare("
    SELECT p.id, p.nom AS produit_nom, p.description, p.prix, u.username AS vendeur_nom 
    FROM produits p 
    INNER JOIN utilisateurs u ON p.vendeur_id = u.id
");
$stmt->execute();
$produits = $stmt->fetchAll();

// Afficher les produits avec le nom du vendeur
if (count($produits) > 0) {
    echo "<h1>Liste des produits publiés par les vendeurs</h1>";
    echo "<table border='1'>";
    echo "<thead><tr><th>Produit</th><th>Description</th><th>Prix</th><th>Vendeur</th></tr></thead>";
    echo "<tbody>";
    
    foreach ($produits as $produit) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($produit['produit_nom']) . "</td>";
        echo "<td>" . htmlspecialchars($produit['description']) . "</td>";
        echo "<td>" . htmlspecialchars($produit['prix']) . "€</td>";
        echo "<td>" . htmlspecialchars($produit['vendeur_nom']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>Aucun produit n'a été publié.</p>";
}
?>
