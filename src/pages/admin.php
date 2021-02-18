<?php
require('src/functions/auth.php');
if (!Auth::isLogged()) {
    header('Location: index.php?page=connexion');
}

include 'src/functions/logout.php';
include 'src/functions/admin_functions.php';
connexion_bdd();
valider();

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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold mx-lg-4" href="index.php?page=admin">
            Tableau de bord administrateur
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <a class="nav-link text-light" href="index.php?page=adminDashboard">Dashboard</a>
            <form action="<?= logout() ?>" method="post">
                <button type="submit" name="deconnexion" id="btn_deco_admin" class="btn rounded-0 mx-lg-4 mt-lg-0 mt-4 h-100">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid my-5" style="min-height: 100vh;">
    <?php
    if (isset($_POST['valide']) or isset($_POST['non-valide'])) {
        if ($bool) {
            echo '<div class="alert alert-success alert-dismissible fade show col-6 mx-auto mb-5 text-center fw-bold shadow" role="alert">';
            echo '<span>Modifications validées.</span>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show col-6 mx-auto mb-5 text-center fw-bold shadow" role="alert">';
            echo '<span>Modifications non validées.</span>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
    }
    ?>
    <ul class="nav nav-tabs nav-fill mx-lg-4" id="myTab" role="tablist">
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
            $req = $bdd->query('SELECT t.*, e.* FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.etat = \'a_valider\'');

            while ($donnees = $req->fetch()) { ?>

                <div class="table-responsive mb-5 mx-lg-4">
                    <form action="<?= valider() ?>" method="post">
                        <table class="table table-hover table-bordered border-dark shadow">
                            <thead>
                                <tr>
                                    <th scope="col"><?= substr($donnees['rsfp_product'], 20) . ' | ' . $donnees['team'] . ' | N° ' . $donnees['id_team'] ?></th>
                                    <th scope="col">Coureur 1</th>
                                    <th scope="col">Coureur 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <?php
                                    highlight_change($donnees, "nom_relayeur_1", "nom1");
                                    highlight_change($donnees, "nom_relayeur_2", "nom2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Prénom</th>
                                    <?php
                                    highlight_change($donnees, "prenom_relayeur_1", "prenom1");
                                    highlight_change($donnees, "prenom_relayeur_2", "prenom2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Sexe</th>
                                    <?php
                                    highlight_change($donnees, "sexe_relayeur_1", "sexe1");
                                    highlight_change($donnees, "sexe_relayeur_2", "sexe2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Taille de t-shirt</th>
                                    <?php
                                    highlight_change($donnees, "tshirt_relayeur_1", "tshirt1");
                                    highlight_change($donnees, "tshirt_relayeur_2", "tshirt2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Année de naissance</th>
                                    <?php
                                    highlight_change($donnees, "annee_naissance_1", "annee_naissance1");
                                    highlight_change($donnees, "annee_naissance_2", "annee_naissance2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <?php
                                    highlight_change($donnees, "email_relayeur_1", "email1");
                                    highlight_change($donnees, "email_relayeur_2", "email2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Téléphone</th>
                                    <?php
                                    highlight_change($donnees, "tel1", "telephone1");
                                    highlight_change($donnees, "tel2", "telephone2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Type de licence</th>
                                    <?php
                                    highlight_change($donnees, "type_licence_relayeur_1", "licence_1");
                                    highlight_change($donnees, "type_licence_relayeur_2", "licence_2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Numéro de licence</th>
                                    <?php
                                    highlight_change($donnees, "numero_licence_relayeur_1", "numero_licence_1");
                                    highlight_change($donnees, "numero_licence_relayeur_2", "numero_licence_2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Nom du club</th>
                                    <?php
                                    highlight_change($donnees, "club_relayeur_1", "club1");
                                    highlight_change($donnees, "club_relayeur_2", "club2");
                                    ?>
                                </tr>
                                <tr>
                                    <th scope="row">Certificat médical</th>
                                    <?=
                                    !empty($donnees['certificat1']) ? '<td class="table-warning"><a href="src/' . $donnees['certificat1'] . '" target="_blank">Voir le certificat</a></td>' : '<td></td>';
                                    ?>
                                    <?=
                                    !empty($donnees['certificat2']) ? '<td class="table-warning"><a href="src/' . $donnees['certificat2'] . '" target="_blank">Voir le certificat</a></td>' : '<td></td>';
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" name="id_attente" value="<?= $donnees['id_attente'] ?>">
                        <button type="submit" name="valide" class="btn rounded-0 me-4">Valider</button>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn rounded-0 me-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Ne pas valider
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Motif de refus :</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <textarea name="motif" id="" cols="40" rows="10" placeholder="Entrez un motif de refus"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn rounded-0" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" name="non-valide" class="btn rounded-0">Envoyer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }

            $req->closeCursor();
            ?>
        </div>
        <div class="tab-pane fade mt-5" id="non-valide" role="tabpanel" aria-labelledby="non-valide-tab">
            <?php
            $req = $bdd->query('SELECT t.*, e.* FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.etat = \'non_valide\'');

            while ($donnees = $req->fetch()) { ?>

                <div class="table-responsive mb-5 mx-lg-4">
                    <table class="table table-hover table-bordered border-dark shadow">
                        <thead>
                            <tr>
                                <th scope="col"><?= substr($donnees['rsfp_product'], 20) . ' | ' . $donnees['team'] . ' | N° ' . $donnees['id_team'] ?></th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <?php
                                highlight_change($donnees, "nom_relayeur_1", "nom1");
                                highlight_change($donnees, "nom_relayeur_2", "nom2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <?php
                                highlight_change($donnees, "prenom_relayeur_1", "prenom1");
                                highlight_change($donnees, "prenom_relayeur_2", "prenom2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <?php
                                highlight_change($donnees, "sexe_relayeur_1", "sexe1");
                                highlight_change($donnees, "sexe_relayeur_2", "sexe2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <?php
                                highlight_change($donnees, "tshirt_relayeur_1", "tshirt1");
                                highlight_change($donnees, "tshirt_relayeur_2", "tshirt2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <?php
                                highlight_change($donnees, "annee_naissance_1", "annee_naissance1");
                                highlight_change($donnees, "annee_naissance_2", "annee_naissance2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <?php
                                highlight_change($donnees, "email_relayeur_1", "email1");
                                highlight_change($donnees, "email_relayeur_2", "email2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <?php
                                highlight_change($donnees, "tel1", "telephone1");
                                highlight_change($donnees, "tel2", "telephone2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <?php
                                highlight_change($donnees, "type_licence_relayeur_1", "licence_1");
                                highlight_change($donnees, "type_licence_relayeur_2", "licence_2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <?php
                                highlight_change($donnees, "numero_licence_relayeur_1", "numero_licence_1");
                                highlight_change($donnees, "numero_licence_relayeur_2", "numero_licence_2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <?php
                                highlight_change($donnees, "club_relayeur_1", "club1");
                                highlight_change($donnees, "club_relayeur_2", "club2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Certificat médical</th>
                                <?=
                                !empty($donnees['certificat1']) ? '<td class="table-warning"><a href="src/' . $donnees['certificat1'] . '" target="_blank">Voir le certificat</a></td>' : '<td></td>';
                                ?>
                                <?=
                                !empty($donnees['certificat2']) ? '<td class="table-warning"><a href="src/' . $donnees['certificat2'] . '" target="_blank">Voir le certificat</a></td>' : '<td></td>';
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php
            }

            $req->closeCursor();
            ?>
        </div>
        <div class="tab-pane fade mt-5" id="valide" role="tabpanel" aria-labelledby="valide-tab">
            <?php
            $req = $bdd->query('SELECT t.*, e.* FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.etat = \'valide\'');

            while ($donnees = $req->fetch()) { ?>

                <div class="table-responsive mb-5 mx-lg-4">
                    <table class="table table-hover table-bordered border-dark shadow">
                        <thead>
                            <tr>
                                <th scope="col"><?= substr($donnees['rsfp_product'], 20) . ' | ' . $donnees['team'] . ' | N° ' . $donnees['id_team'] ?></th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <?php
                                highlight_change($donnees, "nom_relayeur_1", "nom1");
                                highlight_change($donnees, "nom_relayeur_2", "nom2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <?php
                                highlight_change($donnees, "prenom_relayeur_1", "prenom1");
                                highlight_change($donnees, "prenom_relayeur_2", "prenom2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <?php
                                highlight_change($donnees, "sexe_relayeur_1", "sexe1");
                                highlight_change($donnees, "sexe_relayeur_2", "sexe2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <?php
                                highlight_change($donnees, "tshirt_relayeur_1", "tshirt1");
                                highlight_change($donnees, "tshirt_relayeur_2", "tshirt2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <?php
                                highlight_change($donnees, "annee_naissance_1", "annee_naissance1");
                                highlight_change($donnees, "annee_naissance_2", "annee_naissance2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <?php
                                highlight_change($donnees, "email_relayeur_1", "email1");
                                highlight_change($donnees, "email_relayeur_2", "email2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <?php
                                highlight_change($donnees, "tel1", "telephone1");
                                highlight_change($donnees, "tel2", "telephone2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <?php
                                highlight_change($donnees, "type_licence_relayeur_1", "licence_1");
                                highlight_change($donnees, "type_licence_relayeur_2", "licence_2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <?php
                                highlight_change($donnees, "numero_licence_relayeur_1", "numero_licence_1");
                                highlight_change($donnees, "numero_licence_relayeur_2", "numero_licence_2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <?php
                                highlight_change($donnees, "club_relayeur_1", "club1");
                                highlight_change($donnees, "club_relayeur_2", "club2");
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Certificat médical</th>
                                <?=
                                !empty($donnees['certificat1']) ? '<td class="table-warning"><a href="src/' . $donnees['certificat1'] . '" target="_blank">Voir le certificat</a></td>' : '<td></td>';
                                ?>
                                <?=
                                !empty($donnees['certificat2']) ? '<td class="table-warning"><a href="src/' . $donnees['certificat2'] . '" target="_blank">Voir le certificat</a></td>' : '<td></td>';
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php
            }

            $req->closeCursor();
            ?>
        </div>
    </div>

</div>

<footer class="text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3">
        <a class="nav-link" href="https://github.com/mediatorviolet" target="_blank"><i class="fab fa-github"></i></a>
    </div>
    <!-- Copyright -->
</footer>