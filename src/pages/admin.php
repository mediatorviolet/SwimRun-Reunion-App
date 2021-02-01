<?php include 'functions/logout.php' ?>
<?php include 'functions/admin_functions.php' ?>
<?php
connexion_bdd();
valider();
?>
<?php
function badge_count($etat)
{
    try { // Connexion à la BDD
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd->query('SELECT COUNT(etat) FROM en_attente WHERE etat =\'' . $etat . '\'')->fetchColumn();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold mx-lg-4" href="#">Tableau de bord administrateur</a>
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

<div class="container-fluid">
    <ul class="nav nav-tabs nav-fill mt-5 pt-5 mx-lg-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bold active" id="a-valider-tab" data-bs-toggle="tab" href="#a-valider" role="tab" aria-controls="a-valider" aria-selected="true">
                À valider <span class="badge ms-2"><?= badge_count('a_valider') ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-bold" id="non-valide-tab" data-bs-toggle="tab" href="#non-valide" role="tab" aria-controls="non-valide" aria-selected="false">
                Non validé <span class="badge ms-2"><?= badge_count('non_valide') ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-bold" id="valide-tab" data-bs-toggle="tab" href="#valide" role="tab" aria-controls="valide" aria-selected="false">
                Validé <span class="badge ms-2"><?= badge_count('valide') ?></span>
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active mt-5" id="a-valider" role="tabpanel" aria-labelledby="a-valider-tab">
            <?php

            $reponse = $bdd->query('SELECT t.rsfp_product course, t.team team, e.* FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.etat = \'a_valider\'');

            while ($donnees = $reponse->fetch()) { ?>

                <div class="table-responsive mb-5 mx-lg-4">
                    <table class="table table-hover table-bordered border-dark shadow">
                        <thead>
                            <tr>
                                <th scope="col"><?= substr($donnees['course'], 20) . ' | ' . $donnees['team'] . ' | N° ' . $donnees['id_team'] ?></th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <td><?= $donnees['nom_relayeur_1'] ?></td>
                                <td><?= $donnees['nom_relayeur_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <td><?= $donnees['prenom_relayeur_1'] ?></td>
                                <td><?= $donnees['prenom_relayeur_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <td><?= $donnees['sexe1'] ?></td>
                                <td><?= $donnees['sexe2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <td><?= $donnees['tshirt1'] ?></td>
                                <td><?= $donnees['tshirt2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <td><?= $donnees['annee_naissance_1'] ?></td>
                                <td><?= $donnees['annee_naissance_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <td><?= '0' . $donnees['telephone1'] ?></td>
                                <td><?= '0' . $donnees['telephone2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <td><?= $donnees['licence_1'] ?></td>
                                <td><?= $donnees['licence_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <td><?= $donnees['numero_licence_1'] ?></td>
                                <td><?= $donnees['numero_licence_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <td><?= $donnees['club1'] ?></td>
                                <td><?= $donnees['club2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Certificat médical</th>
                                <?php
                                if (!empty($donnees['certificat1'])) {
                                    echo '<td><a href="' . $donnees['certificat1'] . '" target="_blank">Voir le certificat</a></td>';
                                } else {
                                    echo '<td></td>';
                                }

                                if (!empty($donnees['certificat2'])) {
                                    echo '<td><a href="' . $donnees['certificat2'] . '" target="_blank">Voir le certificat</a></td>';
                                } else {
                                    echo '<td></td>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                    <form action="<?= valider() ?>" method="post">
                        <input type="hidden" name="id_attente" value="<?= $donnees['id_attente'] ?>">
                        <button type="submit" name="valide" class="btn rounded-0 me-4">Valider</button>
                        <button type="submit" name="non-valide" class="btn rounded-0">Ne pas valider</button>
                    </form>
                </div>
            <?php
            }

            $reponse->closeCursor();
            ?>
        </div>
        <div class="tab-pane fade mt-5" id="non-valide" role="tabpanel" aria-labelledby="non-valide-tab">
            <?php
            try { // Connexion à la BDD
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
                die('Erreur : ' . $e->getMessage());
            }

            $reponse = $bdd->query('SELECT t.rsfp_product course, t.team team, e.* FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.etat = \'non_valide\'');

            while ($donnees = $reponse->fetch()) { ?>

                <div class="table-responsive mb-5 mx-lg-4">
                    <table class="table table-hover table-bordered border-dark shadow">
                        <thead>
                            <tr>
                                <th scope="col"><?= substr($donnees['course'], 20) . ' | ' . $donnees['team'] . ' | N° ' . $donnees['id_team'] ?></th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <td><?= $donnees['nom_relayeur_1'] ?></td>
                                <td><?= $donnees['nom_relayeur_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <td><?= $donnees['prenom_relayeur_1'] ?></td>
                                <td><?= $donnees['prenom_relayeur_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <td><?= $donnees['sexe1'] ?></td>
                                <td><?= $donnees['sexe2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <td><?= $donnees['tshirt1'] ?></td>
                                <td><?= $donnees['tshirt2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <td><?= $donnees['annee_naissance_1'] ?></td>
                                <td><?= $donnees['annee_naissance_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <td><?= '0' . $donnees['telephone1'] ?></td>
                                <td><?= '0' . $donnees['telephone2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <td><?= $donnees['licence_1'] ?></td>
                                <td><?= $donnees['licence_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <td><?= $donnees['numero_licence_1'] ?></td>
                                <td><?= $donnees['numero_licence_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <td><?= $donnees['club1'] ?></td>
                                <td><?= $donnees['club2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Certificat médical</th>
                                <?php
                                if (!empty($donnees['certificat1'])) {
                                    echo '<td><a href="' . $donnees['certificat1'] . '" target="_blank">Voir le certificat</a></td>';
                                } else {
                                    echo '<td></td>';
                                }

                                if (!empty($donnees['certificat2'])) {
                                    echo '<td><a href="' . $donnees['certificat2'] . '" target="_blank">Voir le certificat</a></td>';
                                } else {
                                    echo '<td></td>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php
            }

            $reponse->closeCursor();
            ?>
        </div>
        <div class="tab-pane fade mt-5" id="valide" role="tabpanel" aria-labelledby="valide-tab">
            <?php
            try { // Connexion à la BDD
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
                die('Erreur : ' . $e->getMessage());
            }

            $reponse = $bdd->query('SELECT t.rsfp_product course, t.team team, e.* FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.etat = \'valide\'');

            while ($donnees = $reponse->fetch()) { ?>

                <div class="table-responsive mb-5 mx-lg-4">
                    <table class="table table-hover table-bordered border-dark shadow">
                        <thead>
                            <tr>
                                <th scope="col"><?= substr($donnees['course'], 20) . ' | ' . $donnees['team'] . ' | N° ' . $donnees['id_team'] ?></th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <td><?= $donnees['nom_relayeur_1'] ?></td>
                                <td><?= $donnees['nom_relayeur_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <td><?= $donnees['prenom_relayeur_1'] ?></td>
                                <td><?= $donnees['prenom_relayeur_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <td><?= $donnees['sexe1'] ?></td>
                                <td><?= $donnees['sexe2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <td><?= $donnees['tshirt1'] ?></td>
                                <td><?= $donnees['tshirt2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <td><?= $donnees['annee_naissance_1'] ?></td>
                                <td><?= $donnees['annee_naissance_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <td><?= '0' . $donnees['telephone1'] ?></td>
                                <td><?= '0' . $donnees['telephone2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <td><?= $donnees['licence_1'] ?></td>
                                <td><?= $donnees['licence_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <td><?= $donnees['numero_licence_1'] ?></td>
                                <td><?= $donnees['numero_licence_2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <td><?= $donnees['club1'] ?></td>
                                <td><?= $donnees['club2'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Certificat médical</th>
                                <?php
                                if (!empty($donnees['certificat1'])) {
                                    echo '<td><a href="' . $donnees['certificat1'] . '" target="_blank">Voir le certificat</a></td>';
                                } else {
                                    echo '<td></td>';
                                }

                                if (!empty($donnees['certificat2'])) {
                                    echo '<td><a href="' . $donnees['certificat2'] . '" target="_blank">Voir le certificat</a></td>';
                                } else {
                                    echo '<td></td>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php
            }

            $reponse->closeCursor();
            ?>
        </div>
    </div>

</div>