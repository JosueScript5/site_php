<?php include('server/form.php'); ?>
<?php include('components/Haut.php'); ?>
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow p-3 mb-5 bg-white rounded">
        <?php if (!empty($message)) echo $message; ?>
            <h2>Enregistrer un utilisateur</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" maxlength="20" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" maxlength="20" required>
                </div>
                <button type="submit" class="btn btn-info">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
<?php include('components/Bas.php'); ?>
