<?php
$count = 0;
$required_input = [];
// Fonction qui gère la validation du formulaire
function validation_form()
{
    global $count;
    global $required_input;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_modif'])) {
        $count = 0;
        // Liste des inputs requis pour que le formulaire s'envoie
        $required_input = array(
            'nom1',
            'prenom1',
            'sexe1',
            't-shirt1',
            'annee_naissance1',
            'email1',
            'tel1',
            'licence1',
            'nom2',
            'prenom2',
            'sexe2',
            't-shirt2',
            'annee_naissance2',
            'email2',
            'tel2',
            'licence2'
        );

        // Si le coureur est licencié FFTri on rajoute num_licence et club à la liste des inputs requis
        if ($_POST['licence1'] == 'FFTri') {
            array_push($required_input, 'num_licence1', 'club1');
        }

        if ($_POST['licence2'] == 'FFTri') {
            array_push($required_input, 'num_licence2', 'club2');
        }

        // Si le coureur est NON-LICENCIE et que l'input file n'est pas vide, on appelle la fonction upload
        if ($_POST['licence1'] == 'NON-LICENCIE') {
            if (!empty($_FILES['certif1'])) {
                upload("certif1");
            }
        }

        if ($_POST['licence2'] == 'NON-LICENCIE') {
            if (!empty($_FILES['certif2'])) {
                upload("certif2");
            }
        }

        // Pour chaque input dans le tableau $required_input
        foreach ($required_input as $input) {
            if (empty($_POST["$input"])) { // Si un input est vide, le compteur augmente
                $count++;
            } else { // Sinon si l'input n'est pas vide, on lui passe les methodes trim() et htmlentities() -> faille XSS
                $_POST["$input"] = trim(htmlentities($_POST["$input"], ENT_QUOTES));
            }
        }

        // Si le compteur est <= 0, alors on appelle la fonction envoi_form()
        if ($count <= 0) {
            envoi_form();
        }
    }
}

// Fonction qui gère l'envoi des infos dans la BDD
function envoi_form()
{
    try { // Connexion à la BDD
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
        die('Erreur : ' . $e->getMessage());
    }

    // On fait appel à la fonction verif_team() pour savoir si on doit ajouter une ligne ou modifier une ligne déjà existante
    if (verif_team() == true) {
        $req = $bdd->prepare('UPDATE en_attente SET id_team = :id_team, nom1 = :nom1, prenom1 = :prenom1, sexe1 = :sexe1, tshirt1 = :tshirt1, annee_naissance1 = :annee_naissance1, email1 = :email1, telephone1 = :telephone1, licence_1 = :licence_1, numero_licence_1 = :numero_licence_1, club1 = :club1, certificat1 = :certificat1, nom2 = :nom2, prenom2 = :prenom2, sexe2 = :sexe2, tshirt2 = :tshirt2, annee_naissance2 = :annee_naissance2, email2 = :email2, telephone2 = :telephone2, licence_2 = :licence_2, numero_licence_2 = :numero_licence_2, club2 = :club2, certificat2 = :certificat2, etat = :etat WHERE id_team = "' . $_SESSION['auth']['id'] . '"');
    } else {
        $req = $bdd->prepare('INSERT INTO en_attente(id_team, nom1, prenom1, sexe1, tshirt1, annee_naissance1, email1, telephone1, licence_1, numero_licence_1, club1, certificat1, nom2, prenom2, sexe2, tshirt2, annee_naissance2, email2, telephone2, licence_2, numero_licence_2, club2, certificat2, etat) VALUES(:id_team, :nom1, :prenom1, :sexe1, :tshirt1, :annee_naissance1, :email1, :telephone1, :licence_1, :numero_licence_1, :club1, :certificat1, :nom2, :prenom2, :sexe2, :tshirt2, :annee_naissance2, :email2, :telephone2, :licence_2, :numero_licence_2, :club2, :certificat2, :etat)');
    }

    $req->execute(array(
        'id_team' => $_SESSION['auth']['id'],
        'nom1' => $_POST['nom1'],
        'prenom1' => $_POST['prenom1'],
        'sexe1' => $_POST['sexe1'],
        'tshirt1' => $_POST['t-shirt1'],
        'annee_naissance1' => $_POST['annee_naissance1'],
        'email1' => $_POST['email1'],
        'telephone1' => $_POST['tel1'],
        'licence_1' => $_POST['licence1'],
        'numero_licence_1' => $_POST['num_licence1'],
        'club1' => $_POST['club1'],
        'certificat1' => isset(pathinfo($_FILES["certif1"]["name"])['extension']) ? 'uploads/' . md5(pathinfo($_FILES["certif1"]["name"])['filename']) . '.' . pathinfo($_FILES["certif1"]["name"])['extension']  : '',
        'nom2' => $_POST['nom2'],
        'prenom2' => $_POST['prenom2'],
        'sexe2' => $_POST['sexe2'],
        'tshirt2' => $_POST['t-shirt2'],
        'annee_naissance2' => $_POST['annee_naissance2'],
        'email2' => $_POST['email2'],
        'telephone2' => $_POST['tel2'],
        'licence_2' => $_POST['licence2'],
        'numero_licence_2' => $_POST['num_licence2'],
        'club2' => $_POST['club2'],
        'certificat2' => isset(pathinfo($_FILES["certif2"]["name"])['extension']) ? 'uploads/' . md5(pathinfo($_FILES["certif2"]["name"])['filename']) . '.' . pathinfo($_FILES["certif2"]["name"])['extension'] : '',
        'etat' => 'a_valider'
    ));
}

// Fonction qui gère l'upload des fichiers .pdf
function upload($certif)
{
    global $count;
    if (isset($_FILES["$certif"]) and $_FILES["$certif"]["error"] == 0) {
        if ($_FILES["$certif"]["size"] <= 1000000) {
            $infosFichier = pathinfo($_FILES["$certif"]["name"]);
            $extensionUpload = $infosFichier["extension"];
            $nomFichier = md5($infosFichier['filename']) . '.' . $infosFichier['extension'];
            if ($extensionUpload == "pdf") {
                move_uploaded_file($_FILES["$certif"]["tmp_name"], 'src/uploads/' . $nomFichier);
            } else {
                $count++;
            }
        } else {
            $count++;
        }
    } else {
        $count++;
    }
}

// Fonction qui vérifie si l'équipe à déjà effectué une modif de ses infos
function verif_team()
{
    try { // Connexion à la BDD
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
        die('Erreur : ' . $e->getMessage());
    }

    // On cherche si $_SESSION['user']['id'] correspond à un id_team dans la table en_attente
    $req = $bdd->query('SELECT EXISTS ( SELECT id_team FROM en_attente WHERE id_team = ' . $_SESSION['auth']['id'] . ') AS team_exists');

    $duplicate = $req->fetch();
    if ($duplicate['team_exists']) {
        // Si on trouve une correspondance on renvoie true
        return true;
    } else {
        // Sinon on renvoie false
        return false;
    }
}
