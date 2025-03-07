<?php
include('supabase.php');

$message = ""; // Initialisation du message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $data = [
        'nom' => $nom,
        'prenom' => $prenom
    ];

    $result = supabaseRequest('utilisateurs', 'POST', $data);

    if (isset($result['error'])) {
        $message = "<p class='alert alert-danger'>Erreur " . $result['error']['message'] . "</p>";
    } else {
        $message = "<p class='alert alert-info'>Musicien enregistré avec succès</p>";
    }
}
?>
