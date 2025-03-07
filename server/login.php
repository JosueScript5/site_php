<?php
include('supabase.php');
session_start();

$message = ""; // Initialisation du message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $telephone = trim($_POST['telephone']);
    $password = $_POST['password'];

    // Vérification des champs vides
    if (empty($telephone) || empty($password)) {
        $message = "<p class='alert alert-danger'>Tous les champs sont obligatoires</p>";
    } elseif (!preg_match('/^\d{10}$/', $telephone)) {
        $message = "<p class='alert alert-danger'>Le numéro de téléphone doit contenir exactement 10 chiffres</p>";
    } else {
        // Première étape: Vérifier si le numéro existe
        $result = supabaseRequest("utilisateurs?telephone=eq.$telephone", "GET");

        if (empty($result) || count($result) == 0) {
            // Le numéro n'existe pas dans la base de données
            $message = "<p class='alert alert-danger'>Ce numéro de téléphone n'existe pas</p>";
        } else {
            // Deuxième étape: Vérifier le mot de passe
            $user = $result[0];
            
            if (password_verify($password, $user['password'])) {
                // Mot de passe correct, création de la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['user_prenom'] = $user['prenom'];
                $_SESSION['user_telephone'] = $user['telephone'];
                
                // Redirection vers board.php
                header("Location: board.php");
                exit();
            } else {
                // Mot de passe incorrect
                $message = "<p class='alert alert-danger'>Mot de passe incorrect</p>";
            }
        }
    }
}
?>

