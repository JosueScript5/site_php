<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$nom = $_SESSION['user_nom'];
$prenom = $_SESSION['user_prenom'];
?>

<?php include('components/Haut.php'); ?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-8 shadow p-3 mb-5 bg-white rounded">
            <h4>Tableau de bord</h4>
            <div>
                <h2><?php echo htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom); ?></h2>
                <p>Vous êtes maintenant connecté à votre compte</p>
            </div>
        </div>
    </div>
</div>

<?php include('components/Bas.php'); ?>
