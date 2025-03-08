<div class="col-md-6">
    <?php if (isset($_GET['message'])) echo $_GET['message']; ?>
    <div class="shadow p-3 mb-5 bg-white rounded">
        <h3>Modifier vos informations personnelles</h3>
        <form method="POST" action="server/update.php" id="updateInfoForm">
            <input type="hidden" name="update_type" value="info">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" maxlength="20" required value="<?php echo htmlspecialchars($nom); ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" maxlength="20" required value="<?php echo htmlspecialchars($prenom); ?>">
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" minlength="10" maxlength="10" required value="<?php echo htmlspecialchars($telephone); ?>">
            </div>
            <div class="mb-3">
                <label for="gmail" class="form-label">Gmail</label>
                <input type="email" class="form-control" id="gmail" name="gmail" required value="<?php echo htmlspecialchars($gmail); ?>">
            </div>
            <button type="submit" class="btn btn-info">Mettre à jour</button>
        </form>
    </div>
</div>
