<?php
require('src/functions/auth.php');
if (!Auth::isLogged()) {
    header('Location: index.php?page=connexion');
}

include 'src/functions/logout.php';
include 'src/functions/traitement.php';
validation_form();
$user = $_SESSION['auth'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow py-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold mx-lg-4" href="#">Bienvenue <?= $user['team'] ?> !</a>
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

<div class="container-fluid mt-5">
    <?php
    if (isset($_POST['send_modif'])) {
        if ($count > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show col-6 mx-auto mb-5 text-center fw-bold shadow" role="alert">';
            echo '<span>Une erreur est survenue.</span>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-success alert-dismissible fade show col-6 mx-auto mb-5 text-center fw-bold shadow" role="alert">';
            echo '<span>Vos modifications ont bien été prises en compte.</span>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
    }
    ?>
    <div class="row mb-4">
        <div class="col-sm-4 mx-auto d-flex align-items-center">
            <div>
                <p>
                    Vous êtes inscrit à : <b><?= $user['course'] ?></b>
                </p>
                <p>
                    Nom d'équipe : <b><?= $user['team'] ?></b>
                </p>
                <p>
                    Catégorie : <span id="categorie" class="fw-bold"></span>
                </p>
                <p>
                    Responsable d'équipe : <span id="respo_equipe" class="fw-bold"></span>
                </p>
                <div class="divider"></div>
            </div>
        </div>
        <div class="col-sm-4 mx-auto d-flex justify-content-center">
            <div class="shape1">
                <img src="resources/img/LOGO SWIMRUN SEUL.png" alt="logo swimrun" class="img-fluid">
            </div>
        </div>
    </div>
    <form action="<?= validation_form() ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-4 mx-auto">
                <h3 class="mb-3"><b>COUREUR 1</b> <span>(responsable d'équipe)</span></h3>
                <div class="divider"></div>
                <div class="mb-3">
                    <label for="nom1" class="form-label">Nom</label>
                    <input type="text" class="form-control fw-bold" id="nom1" name="nom1" value="<?= $user['nom1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom1" class="form-label">Prénom</label>
                    <input type="text" class="form-control fw-bold" id="prenom1" name="prenom1" value="<?= $user['prenom1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sexe1" class="form-label">Sexe</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="sexe1" id="sexe1_1" value="F" <?= $user['sexe1'] == 'F' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="sexe1_1">F</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe1" id="sexe1_2" value="M" <?= $user['sexe1'] == 'M' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="sexe1_2">M</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="t-shirt1" class="form-label">Taille de t-shirt</label>
                    <select class="form-select fw-bold" aria-label="Taille de t-shirt" name="t-shirt1" required>
                        <option>Sélectionnez une taille de t-shirt</option>
                        <option value="S" <?= $user['t-shirt1'] == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $user['t-shirt1'] == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $user['t-shirt1'] == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $user['t-shirt1'] == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="annee_naissance1" class="form-label">Année de naissance</label>
                    <input type="tel" maxlength="4" class="form-control fw-bold" id="annee_naissance1" name="annee_naissance1" value="<?= $user['annee_naissance1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email1" class="form-label">Email</label>
                    <input type="email" class="form-control fw-bold" id="email1" name="email1" value="<?= $user['email1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel1" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control fw-bold" id="tel1" name="tel1" value="<?= $user['tel1'] ? '0' . $user['tel1'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="licence1" class="form-label">Type de licence</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="licence1" id="licence1_1" value="FFTri" <?= $user['licence1'] == 'FFTri' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="licence1_1">FFTri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licence1" id="licence1_2" value="NON-LICENCIE" <?= $user['licence1'] == 'NON-LICENCIE' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="licence1_2">NON-LICENCIE</label>
                        </div>
                    </div>
                </div>
                <div id="num_licence1_div">
                    <div class="mb-3">
                        <label for="num_licence1" class="form-label">Numéro de licence</label>
                        <input type="text" class="form-control fw-bold" id="num_licence1" name="num_licence1" value="<?= $user['num_licence1'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="club1" class="form-label">Nom du club</label>
                        <input type="text" class="form-control fw-bold" id="club1" name="club1" value="<?= $user['club1'] ?>">
                    </div>
                </div>
                <div id="certif1_div" class="mb-3">
                    <label for="certif1" class="form-label">Certificat médical</label>
                    <input class="form-control fw-bold" type="file" id="certif1" name="certif1">
                </div>
            </div>
            <div class="col-sm-4 mx-auto mt-md-0 mt-4">
                <h3 class="mb-3"><b>COUREUR 2</b></h3>
                <div class="divider"></div>
                <div class="mb-3">
                    <label for="nom2" class="form-label">Nom</label>
                    <input type="text" class="form-control fw-bold" id="nom2" name="nom2" value="<?= $user['nom2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom2" class="form-label">Prénom</label>
                    <input type="text" class="form-control fw-bold" id="prenom2" name="prenom2" value="<?= $user['prenom2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sexe2" class="form-label">Sexe</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="sexe2" id="sexe2_1" value="F" <?= $user['sexe2'] == 'F' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="sexe2_1">F</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe2" id="sexe2_2" value="M" <?= $user['sexe2'] == 'M' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="sexe2_2">M</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="t-shirt2" class="form-label">Taille de t-shirt</label>
                    <select class="form-select fw-bold" aria-label="Taille de t-shirt" name="t-shirt2" required>
                        <option>Sélectionnez une taille de t-shirt</option>
                        <option value="S" <?= $user['t-shirt2'] == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $user['t-shirt2'] == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $user['t-shirt2'] == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $user['t-shirt2'] == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="annee_naissance2" class="form-label">Année de naissance</label>
                    <input type="tel" maxlength="4" class="form-control fw-bold" id="annee_naissance2" name="annee_naissance2" value="<?= $user['annee_naissance2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email2" class="form-label">Email</label>
                    <input type="email" class="form-control fw-bold" id="email2" name="email2" value="<?= $user['email2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel2" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control fw-bold" id="tel2" name="tel2" value="<?= $user['tel2'] ? '0' . $user['tel2'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="licence2" class="form-label">Type de licence</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="licence2" id="licence2_1" value="FFTri" <?= $user['licence2'] == 'FFTri' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="licence2_1">FFTri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licence2" id="licence2_2" value="NON-LICENCIE" <?= $user['licence2'] == 'NON-LICENCIE' ? 'checked' : '' ?> required>
                            <label class="form-check-label fw-bold" for="licence2_2">NON-LICENCIE</label>
                        </div>
                    </div>
                </div>
                <div id="num_licence2_div">
                    <div class="mb-3">
                        <label for="num_licence2" class="form-label">Numéro de licence</label>
                        <input type="text" class="form-control fw-bold" id="num_licence2" name="num_licence2" value="<?= $user['num_licence2'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="club2" class="form-label">Nom du club</label>
                        <input type="text" class="form-control fw-bold" id="club2" name="club2" value="<?= $user['club2'] ?>">
                    </div>
                </div>
                <div id="certif2_div" class="mb-3">
                    <label for="certif2" class="form-label">Certificat médical</label>
                    <input class="form-control fw-bold" type="file" id="certif2" name="certif2">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-4">
            <button type="submit" id="send_modif" name="send_modif" class="btn rounded-0">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<footer class="text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3">
        2021 Copyright © Swimrun Réunion
        <a class="nav-link" href="https://github.com/mediatorviolet" target="_blank"><i class="fab fa-github"></i></a>
    </div>
    <!-- Copyright -->
</footer>

<script src="src/functions/script.js"></script>
<script>
    form_controller(radios1, licence1, certif1, "<?= $user['licence1'] ?>");
    form_controller(radios2, licence2, certif2, "<?= $user['licence2'] ?>");
</script>