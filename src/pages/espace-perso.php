<?php include 'functions/logout.php' ?>
<?php $user =  $_SESSION['user']; ?>

<div class="container-fluid">
    <form action="<?= logout() ?>" method="post">
    <button type="submit" name="deconnexion" class="btn rounded-0">
        Deconnexion
    </button>
    </form>
    <h2>Bienvenue <?= $user['team'] ?> !</h2>
    <p>Voici vos infos :</p>
    <p>
        Nom de l'équipe : <?= $user['team'] ?>
    </p>
    <p>
        Responsable de l'équipe : <?= $user['responsable_equipe'] ?>
    </p>
    <p>
        Télephone du responsable d'équipe : 0<?= $user['telephone'] ?>
    </p>
</div>