<?php include 'functions/logout.php' ?>
<?php $user =  $_SESSION['user']; ?>

<div class="container-fluid">
    <form action="<?= logout() ?>" method="post">
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" name="deconnexion" class="btn rounded-0">
                Deconnexion
            </button>
        </div>
    </form>
    <div>
        <h2>Bienvenue <?= $user['team'] ?> !</h2>
        <p>
            Nom de l'équipe : <?= $user['team'] ?>
        </p>
        <p>
            Responsable de l'équipe : <?= $user['responsable_equipe'] ?>
        </p>
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="col-sm-4 mx-auto">
                <h3 class="mb-3">Coureur 1 :</h3>
                <div class="mb-3">
                    <label for="nom1" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom1" name="nom1" value="<?= $user['nom_relayeur_1'] ?>">
                </div>
                <div class="mb-3">
                    <label for="prenom1" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom1" name="prenom1" value="<?= $user['prenom_relayeur_1'] ?>">
                </div>
                <div class="mb-3">
                    <label for="sexe1" class="form-label">Sexe</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="sexe1" id="sexe1_1" value="F" <?= $user['sexe_relayeur_1'] == 'F' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="sexe1_1">F</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe1" id="sexe1_2" value="M" <?= $user['sexe_relayeur_1'] == 'M' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="sexe1_2">M</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="t-shirt1" class="form-label">Taille de t-shirt</label>
                    <select class="form-select" aria-label="Taille de t-shirt" name="t-shirt1">
                        <option>Sélectionnez une taille de t-shirt</option>
                        <option value="S" <?= $user['tshirt_relayeur_1'] == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $user['tshirt_relayeur_1'] == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $user['tshirt_relayeur_1'] == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $user['tshirt_relayeur_1'] == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="annee_naissance1" class="form-label">Année de naissance</label>
                    <input type="tel" maxlength="4" class="form-control" id="annee_naissance1" name="annee_naissance1" value="<?= $user['annee_naissance_1'] ?>">
                </div>
                <div class="mb-3">
                    <label for="email1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email1" name="email1" value="<?= $user['email_relayeur_1'] ?>">
                </div>
                <div class="mb-3">
                    <label for="tel1" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="tel1" name="tel1" value="<?= $user['tel1'] ? '0' . $user['tel1'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="licence1" class="form-label">Type de licence</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="licence1" id="licence1_1" value="FFTri" <?= $user['type_licence_relayeur_1'] == 'FFTri' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="licence1_1">FFTri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licence1" id="licence1_2" value="NON-LICENCIE" <?= $user['type_licence_relayeur_1'] == 'NON-LICENCIE' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="licence1_2">NON-LICENCIE</label>
                        </div>
                    </div>
                </div>
                <div id="num_licence1_div" class="mb-3">
                    <label for="num_licence1" class="form-label">Numéro de licence (au minimum les 7 premiers caractères)</label>
                    <input type="text" class="form-control" id="num_licence1" name="num_licence1" value="<?= $user['numero_licence_relayeur_1'] ?>" maxlength="7">
                </div>
                <div id="certif1_div" class="mb-3">
                    <label for="certif1" class="form-label">Certificat médical</label>
                    <input class="form-control" type="file" id="certif1">
                </div>
            </div>
            <div class="col-sm-4 mx-auto">
                <h3 class="mb-3">Coureur 2 :</h3>
                <div class="mb-3">
                    <label for="nom2" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom2" name="nom2" value="<?= $user['nom_relayeur_2'] ?>">
                </div>
                <div class="mb-3">
                    <label for="prenom2" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom2" name="prenom2" value="<?= $user['prenom_relayeur_2'] ?>">
                </div>
                <div class="mb-3">
                    <label for="sexe2" class="form-label">Sexe</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="sexe2" id="sexe2_1" value="F" <?= $user['sexe_relayeur_2'] == 'F' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="sexe2_1">F</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe2" id="sexe2_2" value="M" <?= $user['sexe_relayeur_2'] == 'M' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="sexe2_2">M</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="t-shirt2" class="form-label">Taille de t-shirt</label>
                    <select class="form-select" aria-label="Taille de t-shirt" name="t-shirt2">
                        <option>Sélectionnez une taille de t-shirt</option>
                        <option value="S" <?= $user['tshirt_relayeur_2'] == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $user['tshirt_relayeur_2'] == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $user['tshirt_relayeur_2'] == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $user['tshirt_relayeur_2'] == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="annee_naissance2" class="form-label">Année de naissance</label>
                    <input type="tel" maxlength="4" class="form-control" id="annee_naissance2" name="annee_naissance2" value="<?= $user['annee_naissance_2'] ?>">
                </div>
                <div class="mb-3">
                    <label for="email2" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email2" name="email2" value="<?= $user['email_relayeur_2'] ?>">
                </div>
                <div class="mb-3">
                    <label for="tel2" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="tel2" name="tel2" value="<?= $user['tel2'] ? '0' . $user['tel2'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="licence2" class="form-label">Type de licence</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="licence2" id="licence2_1" value="FFTri" <?= $user['type_licence_relayeur_2'] == 'FFTri' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="licence2_1">FFTri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licence2" id="licence2_2" value="NON-LICENCIE" <?= $user['type_licence_relayeur_2'] == 'NON-LICENCIE' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="licence2_2">NON-LICENCIE</label>
                        </div>
                    </div>
                </div>
                <div id="num_licence2_div" class="mb-3">
                    <label for="num_licence2" class="form-label">Numéro de licence (au minimum les 7 premiers caractères)</label>
                    <input type="text" class="form-control" id="num_licence2" name="num_licence2" value="<?= $user['numero_licence_relayeur_2'] ?>" maxlength="7">
                </div>
                <div id="certif2_div" class="mb-3">
                    <label for="certif2" class="form-label">Certificat médical</label>
                    <input class="form-control" type="file" id="certif2">
                </div>
            </div>
        </div>
    </form>
</div>

<script> // A refactoriser !!!!!!!!!!!!!
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