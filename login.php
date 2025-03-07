<?php include('server/login.php'); ?>
<?php include('components/Haut.php'); ?>
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow p-3 mb-5 bg-white rounded">
            <?php if (!empty($message)) echo $message; ?>
            <h2 class="text-center">Connexion</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" maxlength="10" required 
                        value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required 
                            value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
                        <button class="btn btn-light" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-info w-100">Se connecter</button>
            </form>
            <div class="mt-3">
                <p>Vous n'avez pas de compte ? <a href="compte.php">Créer un compte</a></p>
            </div>
        </div>
    </div>
</div>
<script src="js/login.js"></script>
<?php include('components/Bas.php'); ?>
