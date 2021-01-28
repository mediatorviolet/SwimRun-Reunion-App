<?php include 'functions/logout.php' ?>
<nav class="nav justify-content-between bg-light shadow fixed-top">
    <div class="d-flex">
        <p class="navbar-brand fw-bold ms-4 my-2">Tableau de bord administrateur</p>
    </div>
    <div class="d-flex">
        <a href="" class="btn rounded-0 d-flex align-items-center">
            En attente de validation <span class="badge ms-2">4</span>
        </a>
        <form action="<?= logout() ?>" method="post">
            <button type="submit" name="deconnexion" class="btn rounded-0 ms-5 h-100">
                Déconnexion
            </button>
        </form>
    </div>
</nav>
<div class="container-fluid">

</div>