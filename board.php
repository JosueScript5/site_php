<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$user_id = $_SESSION['user_id'];
$nom = $_SESSION['user_nom'] ?? '';
$prenom = $_SESSION['user_prenom'] ?? '';
$telephone = $_SESSION['user_telephone'] ?? '';
$gmail = $_SESSION['user_gmail'] ?? '';
?>

<?php include('components/Haut.php'); ?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow p-3 mb-5 bg-white rounded">
            <h3 class="text-center">Profil Utilisateur</h3>
            <hr>
            <p>Nom <h4><?php echo htmlspecialchars($nom); ?></h4></p>
            <p>Prénom <h4><?php echo htmlspecialchars($prenom); ?></h4></p>
            <p>Téléphone <h4><?php echo htmlspecialchars($telephone); ?></h4></p>
            <p>Gmail <h4><?php echo htmlspecialchars($gmail); ?></h4></p>
            <div>
                <a href="update.php" class="btn btn-info">Modifier les informations</a>
                <button class="btn btn-dark mt-3" onclick="confirmLogout()">Déconnexion</button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmLogout() {
    if (confirm('Voulez-vous vous déconnecter ?')) {
        window.location.href = 'server/logout.php';
    }
}
</script>

<?php include('components/Bas.php'); ?>
