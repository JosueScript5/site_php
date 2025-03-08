<?php
// Démarrer la session au tout début du fichier
session_start();
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
        $message = "<p class='alert alert-danger'>Le mot de passe doit contenir entre 6 à 8 caractères</p>";
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
                // Définir la durée de vie de la session à 1 an (en secondes)
                $oneYear = 365 * 24 * 60 * 60;
                ini_set('session.gc_maxlifetime', $oneYear);
                session_set_cookie_params($oneYear);
                
                // Récupérer l'ID de l'utilisateur créé
                $user_id = null;
                if (isset($result[0]['id'])) {
                    $user_id = $result[0]['id'];
                } elseif (isset($result['id'])) {
                    $user_id = $result['id'];
                } else {
                    // Si l'ID n'est pas directement disponible, récupérer l'utilisateur par téléphone
                    $new_user = supabaseRequest("utilisateurs?telephone=eq.$telephone", "GET");
                    if (!empty($new_user) && isset($new_user[0]['id'])) {
                        $user_id = $new_user[0]['id'];
                    }
                }
                
                if ($user_id) {
                    // Stocker les informations de l'utilisateur dans la session
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_nom'] = $nom;
                    $_SESSION['user_prenom'] = $prenom;
                    $_SESSION['user_telephone'] = $telephone;
                    $_SESSION['nouveau_compte'] = true;
                    
                    // Enregistrer la session avant la redirection
                    session_write_close();
                    
                    // Rediriger vers la page board.php
                    header("Location: board.php");
                    exit();
                } else {
                    $message = "<p class='alert alert-danger'>Impossible de récupérer l'utilisateur</p>";
                }
            }
        }
    }
}
?>
