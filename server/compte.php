<?php
include('supabase.php');

$message = ""; // Initialisation du message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $telephone = trim($_POST['telephone']);
    $password = $_POST['password'];

    // Vérification des champs vides
    if (empty($nom) || empty($prenom) || empty($telephone) || empty($password)) {
        $message = "<p class='alert alert-danger'>Tous les champs sont obligatoires</p>";
    } elseif (!preg_match('/^\d{10}$/', $telephone)) {
        $message = "<p class='alert alert-danger'>Le numéro de téléphone doit contenir exactement 10 chiffres</p>";
    } elseif (strlen($password) < 6 || strlen($password) > 8) {
        $message = "<p class='alert alert-danger'>Le mot de passe doit contenir entre 6 et 8 caractères</p>";
    } else {
        // Vérification si le numéro existe déjà dans la base
        $check_result = supabaseRequest("utilisateurs?telephone=eq.$telephone", "GET");

        if (!empty($check_result) && count($check_result) > 0) {
            $message = "<p class='alert alert-danger'>Ce numéro de téléphone est déjà utilisé</p>";
        } else {
            // Hachage du mot de passe avec bcrypt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Données à insérer
            $data = [
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => $telephone,
                'password' => $hashed_password
            ];

            // Envoi des données à Supabase
            $result = supabaseRequest('utilisateurs', 'POST', $data);

            if (isset($result['error'])) {
                $message = "<p class='alert alert-danger'>Erreur " . $result['error']['message'] . "</p>";
            } else {
                $message = "<p class='alert alert-info'>Compte créé avec succès</p>";
            }
        }
    }
}
?>
