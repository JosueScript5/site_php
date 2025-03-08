<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Récupérer les informations de l'utilisateur depuis la session
$nom = isset($_SESSION['user_nom']) ? $_SESSION['user_nom'] : "";
$prenom = isset($_SESSION['user_prenom']) ? $_SESSION['user_prenom'] : "";
$telephone = isset($_SESSION['user_telephone']) ? $_SESSION['user_telephone'] : "";
$gmail = isset($_SESSION['user_gmail']) ? $_SESSION['user_gmail'] : "";
?>

<?php include('components/Haut.php'); ?>

<div class="container p-4">
    <div class="row">
        <?php include('pages/UpdateUser.php'); ?>
        <?php include('pages/UpdateMot.php'); ?>
    </div>
</div>

<script src="js/compte.js"></script>
<?php include('components/Bas.php'); ?>
