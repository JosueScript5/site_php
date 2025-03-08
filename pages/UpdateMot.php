<div class="col-md-6">
    <div class="shadow p-3 mb-5 bg-white rounded">
        <h3>Modifier votre mot de passe</h3>
        <form method="POST" action="server/update.php" id="updatePasswordForm">
            <input type="hidden" name="update_type" value="password">
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
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
            <button type="submit" class="btn btn-info" id="submitBtn" disabled>Mettre à jour</button>
        </form>
    </div>
</div>
