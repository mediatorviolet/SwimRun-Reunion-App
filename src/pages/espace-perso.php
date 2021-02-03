<?php include 'functions/logout.php' ?>
<?php $user =  $_SESSION['user']; ?>
<?php include 'functions/traitement.php'; ?>
<?php validation_form() ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
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

<div class="container-fluid mt-5 pt-5">
    <?php
    if (isset($_POST['send_modif'])) {
        if ($count > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show col-6 mx-auto mb-5 text-center fw-bold" role="alert">';
            echo '<span>Une erreur est survenue.</span>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        } else {
            // envoi_form();
            echo '<div class="alert alert-success alert-dismissible fade show col-6 mx-auto mb-5 text-center fw-bold" role="alert">';
            echo '<span>Vos modifications ont bien été prises en compte.</span>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
    }
    ?>
    <div class="row mb-4">
        <div class="col-sm-4 mx-auto">
            <p>
                Vous êtes inscrit à : <?= $user['rsfp_product'] ?>
            </p>
            <p>
                Nom d'équipe : <?= $user['team'] ?>
            </p>
            <p>
                Catégorie : <span id="categorie"></span> <?= $user['categorie_equipe'] ?>
            </p>
            <p>
                Responsable d'équipe : <span id="respo_equipe"></span>
            </p>
        </div>
        <div class="col-sm-4 mx-auto"></div>
    </div>
    <form action="<?= validation_form() ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-4 mx-auto">
                <h3 class="mb-3">Coureur 1 (responsable d'équipe) :</h3>
                <div class="mb-3">
                    <label for="nom1" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom1" name="nom1" value="<?= $user['nom_relayeur_1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom1" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom1" name="prenom1" value="<?= $user['prenom_relayeur_1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sexe1" class="form-label">Sexe</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="sexe1" id="sexe1_1" value="F" <?= $user['sexe_relayeur_1'] == 'F' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="sexe1_1">F</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe1" id="sexe1_2" value="M" <?= $user['sexe_relayeur_1'] == 'M' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="sexe1_2">M</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="t-shirt1" class="form-label">Taille de t-shirt</label>
                    <select class="form-select" aria-label="Taille de t-shirt" name="t-shirt1" required>
                        <option>Sélectionnez une taille de t-shirt</option>
                        <option value="S" <?= $user['tshirt_relayeur_1'] == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $user['tshirt_relayeur_1'] == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $user['tshirt_relayeur_1'] == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $user['tshirt_relayeur_1'] == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="annee_naissance1" class="form-label">Année de naissance</label>
                    <input type="tel" maxlength="4" class="form-control" id="annee_naissance1" name="annee_naissance1" value="<?= $user['annee_naissance_1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email1" name="email1" value="<?= $user['email_relayeur_1'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel1" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="tel1" name="tel1" value="<?= $user['tel1'] ? '0' . $user['tel1'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="licence1" class="form-label">Type de licence</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="licence1" id="licence1_1" value="FFTri" <?= $user['type_licence_relayeur_1'] == 'FFTri' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="licence1_1">FFTri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licence1" id="licence1_2" value="NON-LICENCIE" <?= $user['type_licence_relayeur_1'] == 'NON-LICENCIE' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="licence1_2">NON-LICENCIE</label>
                        </div>
                    </div>
                </div>
                <div id="num_licence1_div">
                    <div class="mb-3">
                        <label for="num_licence1" class="form-label">Numéro de licence</label>
                        <input type="text" class="form-control" id="num_licence1" name="num_licence1" value="<?= $user['numero_licence_relayeur_1'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="club1" class="form-label">Nom du club</label>
                        <input type="text" class="form-control" id="club1" name="club1" value="<?= $user['club_relayeur_1'] ?>">
                    </div>
                </div>
                <div id="certif1_div" class="mb-3">
                    <label for="certif1" class="form-label">Certificat médical</label>
                    <input class="form-control" type="file" id="certif1" name="certif1">
                </div>
            </div>
            <div class="col-sm-4 mx-auto">
                <h3 class="mb-3">Coureur 2 :</h3>
                <div class="mb-3">
                    <label for="nom2" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom2" name="nom2" value="<?= $user['nom_relayeur_2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom2" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom2" name="prenom2" value="<?= $user['prenom_relayeur_2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sexe2" class="form-label">Sexe</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="sexe2" id="sexe2_1" value="F" <?= $user['sexe_relayeur_2'] == 'F' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="sexe2_1">F</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe2" id="sexe2_2" value="M" <?= $user['sexe_relayeur_2'] == 'M' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="sexe2_2">M</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="t-shirt2" class="form-label">Taille de t-shirt</label>
                    <select class="form-select" aria-label="Taille de t-shirt" name="t-shirt2" required>
                        <option>Sélectionnez une taille de t-shirt</option>
                        <option value="S" <?= $user['tshirt_relayeur_2'] == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $user['tshirt_relayeur_2'] == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $user['tshirt_relayeur_2'] == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $user['tshirt_relayeur_2'] == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="annee_naissance2" class="form-label">Année de naissance</label>
                    <input type="tel" maxlength="4" class="form-control" id="annee_naissance2" name="annee_naissance2" value="<?= $user['annee_naissance_2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email2" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email2" name="email2" value="<?= $user['email_relayeur_2'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel2" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="tel2" name="tel2" value="<?= $user['tel2'] ? '0' . $user['tel2'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="licence2" class="form-label">Type de licence</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="licence2" id="licence2_1" value="FFTri" <?= $user['type_licence_relayeur_2'] == 'FFTri' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="licence2_1">FFTri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licence2" id="licence2_2" value="NON-LICENCIE" <?= $user['type_licence_relayeur_2'] == 'NON-LICENCIE' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="licence2_2">NON-LICENCIE</label>
                        </div>
                    </div>
                </div>
                <div id="num_licence2_div">
                    <div class="mb-3">
                        <label for="num_licence2" class="form-label">Numéro de licence</label>
                        <input type="text" class="form-control" id="num_licence2" name="num_licence2" value="<?= $user['numero_licence_relayeur_2'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="club2" class="form-label">Nom du club</label>
                        <input type="text" class="form-control" id="club2" name="club2" value="<?= $user['club_relayeur_2'] ?>">
                    </div>
                </div>
                <div id="certif2_div" class="mb-3">
                    <label for="certif2" class="form-label">Certificat médical</label>
                    <input class="form-control" type="file" id="certif2" name="certif2">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-4">
            <button type="submit" id="send_modif" name="send_modif" class="btn rounded-0">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
    // On affiche le bouton que si un champ est modifié
    var input = document.getElementsByTagName('input');
    var send_modif = document.getElementById('send_modif');
    send_modif.style.display = 'none';
    for (let i = 0; i < input.length; i++) {
        input[i].addEventListener('change', afficher_btn);
    }

    function afficher_btn() {
        send_modif.style.display = 'block';
    }

    // ca marche pas à check
    var radios_S1 = document.getElementsByName('sexe1');
    var radios_S2 = document.getElementsByName('sexe2');
    var categorie = document.getElementById('categorie');
    for (var i = 0; i < radios_S1.length; i++) {
        radios_S1[i].onclick = function() {
            var val = this.value;
            for (var i = 0; i < radios_S2.length; i++) {
                radios_S2[i].onclick = function() {
                    var val2 = this.value;
                    if (val != val2) {
                        categorie.innerHTML = 'MIXTE';
                    }
                }
            }
        }
    }

    // Changement dynamique du nom du responsable d'équipe
    var nom_respo = document.getElementById('nom1');
    var prenom_respo = document.getElementById('prenom1');
    var respo_equipe = document.getElementById('respo_equipe');
    respo_equipe.innerHTML = nom_respo.value + ' ' + prenom_respo.value;

    function respo() {
        respo_equipe.innerHTML = nom_respo.value + ' ' + prenom_respo.value;
    }

    nom_respo.addEventListener('keyup', respo, false);
    prenom_respo.addEventListener('keyup', respo, false);

    // A refactoriser !!!!!!!!!!!!!
    // On affiche les inputs correspondant en fonction de si l'utilisateur coche 'FFTri' ou  'NON-LICENCIE'
    var radios1 = document.getElementsByName("licence1");
    var licence1 = document.getElementById("num_licence1_div");
    var certif1 = document.getElementById("certif1_div");
    if ('<?= $user['type_licence_relayeur_1'] ?>' == 'FFTri') {
        licence1.style.display = 'block';
        certif1.style.display = 'none';
    } else {
        licence1.style.display = 'none';
        certif1.style.display = 'block';
    }
    for (var i = 0; i < radios1.length; i++) {
        radios1[i].onclick = function() {
            var val = this.value;
            if (val == 'FFTri') {
                licence1.style.display = 'block';
                certif1.style.display = 'none';
            } else if (val == 'NON-LICENCIE') {
                licence1.style.display = 'none';
                certif1.style.display = 'block';
            }
        }
    }

    var radios2 = document.getElementsByName("licence2");
    var licence2 = document.getElementById("num_licence2_div");
    var certif2 = document.getElementById("certif2_div");
    if ('<?= $user['type_licence_relayeur_2'] ?>' == 'FFTri') {
        licence2.style.display = 'block'; // show
        certif2.style.display = 'none'; // hide
    } else {
        licence2.style.display = 'none'; // hide
        certif2.style.display = 'block'; // show
    }
    for (var i = 0; i < radios2.length; i++) {
        radios2[i].onclick = function() {
            var val = this.value;
            if (val == 'FFTri') {
                licence2.style.display = 'block';
                certif2.style.display = 'none';
            } else if (val == 'NON-LICENCIE') {
                licence2.style.display = 'none';
                certif2.style.display = 'block';
            }
        }
    }
</script>