<?php include('server/compte.php'); ?>
<?php include('components/Haut.php'); ?>
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow p-3 mb-5 bg-white rounded">
            <h2>Créer un compte</h2>
            <form method="POST" id="registerForm">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" maxlength="20" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" maxlength="20" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" maxlength="10" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" minlength="6" maxlength="8" required>
                        <button class="btn btn-light" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6" maxlength="8" required>
                        <button class="btn btn-light" type="button" id="toggleConfirmPassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <small id="passwordError" class="text-danger"></small>
                </div>
                <button type="submit" class="btn btn-info" id="submitBtn" disabled>Enregistrer</button>
            </form>
        </div>
    </div>
</div>
<script src="js/compte.js"></script>
<?php include('components/Bas.php'); ?>
