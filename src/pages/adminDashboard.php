<?php
require('src/functions/auth.php');
if (!Auth::isLogged()) {
    header('Location: index.php?page=connexion');
}

include 'src/functions/logout.php';
?>

<style>
    th,
    td {
        font-size: .8rem;
    }
</style>

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
                <th>Numéro licence 1</th>
                <th>T-shirt 1</th>
                <th>Nom 2</th>
                <th>Prénom 2</th>
                <th>Sexe1</th>
                <th>Année naissance 2</th>
                <th>Licence 2</th>
                <th>Club 2</th>
                <th>Numéro licence 2</th>
                <th>T-shirt 2</th>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try { // Connexion à la BDD
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
                die('Erreur : ' . $e->getMessage());
            }

            $req = $bdd->query('SELECT * FROM final');
            while ($data = $req->fetch()) {
            ?>
                <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['date_inscription'] ?></td>
                    <td><?= $data['code_invite'] ?></td>
                    <td><?= $data['team'] ?></td>
                    <td><?= $data['responsable_equipe'] ?></td>
                    <td><?= $data['categorie_equipe'] ?></td>
                    <td><?= $data['telephone1'] ?></td>
                    <td><?= $data['telephone2'] ?></td>
                    <td><?= $data['email1'] ?></td>
                    <td><?= $data['email2'] ?></td>
                    <td><?= $data['adresse_postale'] ?></td>
                    <td><?= $data['code_postal'] ?></td>
                    <td><?= $data['ville'] ?></td>
                    <td><?= $data['nom1'] ?></td>
                    <td><?= $data['prenom1'] ?></td>
                    <td><?= $data['sexe1'] ?></td>
                    <td><?= $data['annee_naissance1'] ?></td>
                    <td><?= $data['licence_1'] ?></td>
                    <td><?= $data['club1'] ?></td>
                    <td><?= $data['numero_licence_1'] ?></td>
                    <td><?= $data['tshirt1'] ?></td>
                    <td><?= $data['nom2'] ?></td>
                    <td><?= $data['prenom2'] ?></td>
                    <td><?= $data['sexe2'] ?></td>
                    <td><?= $data['annee_naissance2'] ?></td>
                    <td><?= $data['licence_2'] ?></td>
                    <td><?= $data['club2'] ?></td>
                    <td><?= $data['numero_licence_2'] ?></td>
                    <td><?= $data['tshirt2'] ?></td>
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
                <th>Numéro licence 1</th>
                <th>T-shirt 1</th>
                <th>Nom 2</th>
                <th>Prénom 2</th>
                <th>Sexe1</th>
                <th>Année naissance 2</th>
                <th>Licence 2</th>
                <th>Club 2</th>
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

<script>
    $(document).ready(function() {
        $('#final-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            colReorder: true,
            scrollX: true
        });
    });
</script>