<?php
require('src/functions/auth.php');
if (!Auth::isLogged()) {
    header('Location: index.php?page=connexion');
}

include 'src/functions/logout.php';
include 'src/functions/admin_functions.php';
?>

<link rel="stylesheet" href="src/style/adminDash.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold mx-lg-4" href="index.php?page=admin">
            Tableau de bord administrateur
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <form action="<?= logout() ?>" method="post">
                <button type="submit" name="deconnexion" id="btn_deco_admin" class="btn rounded-0 mx-lg-4 mt-lg-0 mt-4 h-100">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="p-5 w-100">
    <table id="final-table" class="display table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date inscription</th>
                <th>Code</th>
                <th>Team</th>
                <th>Responsable équipe</th>
                <th>Catégorie</th>
                <th>Téléphone 1</th>
                <th>Téléphone 2</th>
                <th>Email 1</th>
                <th>Email 2</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Nom 1</th>
                <th>Prénom 1</th>
                <th>Sexe1</th>
                <th>Année naissance 1</th>
                <th>Licence 1</th>
                <th>Club 1</th>
                <th>Certificat 1</th>
                <th>Numéro licence 1</th>
                <th>T-shirt 1</th>
                <th>Nom 2</th>
                <th>Prénom 2</th>
                <th>Sexe1</th>
                <th>Année naissance 2</th>
                <th>Licence 2</th>
                <th>Club 2</th>
                <th>Certificat 2</th>
                <th>Numéro licence 2</th>
                <th>T-shirt 2</th>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try { // Connexion à la BDD
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'antoine', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
                die('Erreur : ' . $e->getMessage());
            }

            $sql = 'SELECT t.*, f.* FROM team t RIGHT JOIN final f ON f.id = t.id';

            $req = $bdd->query($sql);
            while ($data = $req->fetch()) {
            ?>
                <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['date_inscription'] ?></td>
                    <td><?= $data['code_invite'] ?></td>
                    <td><?= $data['team'] ?></td>
                    <?php
                    highlight_change_noInput($data, 'responsable_equipe', 'respo_equipe');
                    highlight_change_noInput($data, 'categorie_equipe', 'cat_equipe');
                    highlight_change_noInput($data, 'tel1', 'telephone1');
                    highlight_change_noInput($data, 'tel2', 'telephone2');
                    highlight_change_noInput($data, 'email_relayeur_1', 'email1');
                    highlight_change_noInput($data, 'email_relayeur_2', 'email2');
                    ?>
                    <td><?= $data['adresse_postale'] ?></td>
                    <td><?= $data['code_postal'] ?></td>
                    <td><?= $data['ville'] ?></td>
                    <?php
                    highlight_change_noInput($data, 'nom_relayeur_1', 'nom1');
                    highlight_change_noInput($data, 'prenom_relayeur_1', 'prenom1');
                    highlight_change_noInput($data, 'sexe_relayeur_1', 'sexe1');
                    highlight_change_noInput($data, 'annee_naissance_1', 'annee_naissance1');
                    highlight_change_noInput($data, 'type_licence_relayeur_1', 'licence_1');
                    highlight_change_noInput($data, 'club_relayeur_1', 'club1');
                    ?>
                    <?=
                    empty($data['certif1']) ? "<td></td>" : "<td class='table-warning'><a href='src/" . $data['certif1'] . "' target='_blank'>Voir le certificat</a></td>";
                    ?>
                    <?php
                    highlight_change_noInput($data, 'numero_licence_relayeur_1', 'numero_licence_1');
                    highlight_change_noInput($data, 'tshirt_relayeur_1', 'tshirt1');
                    highlight_change_noInput($data, 'nom_relayeur_2', 'nom2');
                    highlight_change_noInput($data, 'prenom_relayeur_2', 'prenom2');
                    highlight_change_noInput($data, 'sexe_relayeur_2', 'sexe2');
                    highlight_change_noInput($data, 'annee_naissance_2', 'annee_naissance2');
                    highlight_change_noInput($data, 'type_licence_relayeur_2', 'licence_2');
                    highlight_change_noInput($data, 'club_relayeur_2', 'club2');
                    ?>
                    <?=
                    empty($data['certif2']) ? "<td></td>" : "<td class='table-warning'><a href='src/" . $data['certif2'] . "' target='_blank'>Voir le certificat</a></td>";
                    ?>
                    <?php
                    highlight_change_noInput($data, 'numero_licence_relayeur_2', 'numero_licence_2');
                    highlight_change_noInput($data, 'tshirt_relayeur_2', 'tshirt2');
                    ?>
                    <td><?= $data['rsfp_product'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Date inscription</th>
                <th>Code</th>
                <th>Team</th>
                <th>Responsable équipe</th>
                <th>Catégorie</th>
                <th>Téléphone 1</th>
                <th>Téléphone 2</th>
                <th>Email 1</th>
                <th>Email 2</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Nom 1</th>
                <th>Prénom 1</th>
                <th>Sexe1</th>
                <th>Année naissance 1</th>
                <th>Licence 1</th>
                <th>Club 1</th>
                <th>Certificat 1</th>
                <th>Numéro licence 1</th>
                <th>T-shirt 1</th>
                <th>Nom 2</th>
                <th>Prénom 2</th>
                <th>Sexe1</th>
                <th>Année naissance 2</th>
                <th>Licence 2</th>
                <th>Club 2</th>
                <th>Certificat 2</th>
                <th>Numéro licence 2</th>
                <th>T-shirt 2</th>
                <th>Course</th>
            </tr>
        </tfoot>
    </table>
</div>

<footer class="text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3">
        <a class="nav-link" href="https://github.com/mediatorviolet" target="_blank"><i class="fab fa-github"></i></a>
    </div>
    <!-- Copyright -->
</footer>

<script src="src/functions/dataTables.js"></script>