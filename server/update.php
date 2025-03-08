<?php
session_start();
include('supabase.php'); // Inclusion du fichier de configuration et des fonctions Supabase

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateType = $_POST['update_type'];
    $userId = $_SESSION['user_id'];

    if ($updateType === 'info') {
        // Récupération et validation des champs pour la mise à jour des informations personnelles
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $telephone = trim($_POST['telephone']);
        $gmail = trim($_POST['gmail']);

        $hasError = false; // Variable pour suivre s'il y a des erreurs

        if (empty($nom) || empty($prenom) || empty($telephone) || empty($gmail)) {
            $message = "<p class='alert alert-danger'>Tous les champs sont obligatoires</p>";
            $hasError = true;
        } elseif (!preg_match('/^\\d{10}$/', $telephone)) {
            $message = "<p class='alert alert-danger'>Le numéro de téléphone doit contenir exactement 10 chiffres</p>";
            $hasError = true;
        } elseif (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            $message = "<p class='alert alert-danger'>Adresse mail invalide</p>";
            $hasError = true;
        } 
        
        // Si pas d'erreur de validation de base, vérifier les doublons
        if (!$hasError) {
            // Vérifier si le téléphone est déjà utilisé par un autre utilisateur
            $check_phone = supabaseRequest("utilisateurs?telephone=eq." . urlencode($telephone), "GET");
            if (!empty($check_phone) && count($check_phone) > 0) {
                // Vérifier si le téléphone appartient à un autre utilisateur
                $phoneUsedByOther = false;
                foreach ($check_phone as $user) {
                    if ($user['id'] != $userId) {
                        $phoneUsedByOther = true;
                        break;
                    }
                }
                
                if ($phoneUsedByOther) {
                    $message = "<p class='alert alert-danger'>Ce numéro de téléphone est déjà utilisé par un autre utilisateur</p>";
                    $hasError = true;
                }
            }

            // Vérifier si l'email est déjà utilisé par un autre utilisateur seulement si pas d'erreur de téléphone
            if (!$hasError) {
                $check_email = supabaseRequest("utilisateurs?gmail=eq." . urlencode($gmail), "GET");
                if (!empty($check_email) && count($check_email) > 0) {
                    // Vérifier si l'email appartient à un autre utilisateur
                    $emailUsedByOther = false;
                    foreach ($check_email as $user) {
                        if ($user['id'] != $userId) {
                            $emailUsedByOther = true;
                            break;
                        }
                    }
                    
                    if ($emailUsedByOther) {
                        $message = "<p class='alert alert-danger'>Cette adresse mail est déjà utilisée par un autre utilisateur</p>";
                        $hasError = true;
                    }
                }
            }

            // Si aucune erreur après toutes les vérifications, procéder à la mise à jour
            if (!$hasError) {
                $data = [
                    'nom'       => $nom,
                    'prenom'    => $prenom,
                    'telephone' => $telephone,
                    'gmail'     => $gmail
                ];

                // Mise à jour via Supabase (requête PATCH)
                $result = supabaseRequest("utilisateurs?id=eq." . $userId, "PATCH", $data);

                if (isset($result['error'])) {
                    $message = "<p class='alert alert-danger'>Erreur " . $result['error']['message'] . "</p>";
                } else {
                    // Mise à jour des valeurs en session
                    $_SESSION['user_nom'] = $nom;
                    $_SESSION['user_prenom'] = $prenom;
                    $_SESSION['user_telephone'] = $telephone;
                    $_SESSION['user_gmail'] = $gmail;
                    $message = "<p class='alert alert-info'>Vos informations ont été mises à jour avec succès</p>";
                }
            }
        }
    } elseif ($updateType === 'password') {
        // Récupération et validation des champs pour la mise à jour du mot de passe
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($password) || empty($confirm_password)) {
            $message = "<p class='alert alert-danger'>Tous les champs sont obligatoires</p>";
        } elseif ($password !== $confirm_password) {
            $message = "<p class='alert alert-danger'>Les mots de passe ne correspondent pas</p>";
        } elseif (strlen($password) < 6 || strlen($password) > 8) {
            $message = "<p class='alert alert-danger'>Le mot de passe doit contenir entre 6 et 8 caractères</p>";
        } else {
            // Hachage du nouveau mot de passe
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $data = ['password' => $hashed_password];

            // Mise à jour du mot de passe via Supabase (requête PATCH)
            $result = supabaseRequest("utilisateurs?id=eq." . $userId, "PATCH", $data);

            if (isset($result['error'])) {
                $message = "<p class='alert alert-danger'>Erreur " . $result['error']['message'] . "</p>";
            } else {
                $message = "<p class='alert alert-info'>Votre mot de passe a été mis à jour avec succès</p>";
            }
        }
    }
}

// Redirection avec le message d'erreur si présent
header("Location: ../update.php?message=" . urlencode($message));
exit();
?>
