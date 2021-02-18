<?php include 'src/functions/login.php'; ?>
<?php login() ?>

<!-- Login la longue -->
<div class="container-fluid main-page d-flex justify-content-center align-items-center">
    <div class="card text-center shadow-lg border-0" style="width: 25rem;">
        <div class="card-header fw-bold">
            Connexion :
        </div>
        <div class="card-body py-5">
            <span class="alert-danger"><?= $error_login ?></span>
            <form action="<?= login() ?>" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Nom de l'équipe" name="team" required>
                    <label for="floatingInput">Nom de l'équipe</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" name="password" required>
                    <label for="floatingPassword">Mot de passe</label>
                </div>
                <button type="submit" class="btn rounded-0" name="connexion">
                    Connexion <i class="fas fa-sign-in-alt text-white"></i>
                </button>
            </form>
        </div>
        <div class="card-footer text-muted">
            <a href="http://www.swimrun-reunion.com" class="text-decoration-none" style="color: #242424;">
                <i class="fas fa-angle-left me-1"></i> Retour vers swimrun-reunion.com
            </a>
        </div>
    </div>
</div>