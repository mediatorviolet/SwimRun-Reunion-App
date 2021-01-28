<?php include 'functions/logout.php' ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Tableau de bord administrateur</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <a href="" class="btn rounded-0 mt-lg-0 mt-4">
                À valider <span class="badge ms-2">4</span>
            </a>
            <form action="<?= logout() ?>" method="post">
                <button type="submit" name="deconnexion" class="btn rounded-0 mx-lg-4 mt-lg-0 mt-4 h-100">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>
<div class="container-fluid">

</div>