<?php
$count = 0;
$required_input = [];
function validation_form()
{
    global $count;
    global $required_input;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_modif'])) {
        $count = 0;
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

        if ($_POST['licence1'] == 'FFTri') {
            array_push($required_input, 'num_licence1', 'club1');
        }
        if ($_POST['licence1'] == 'NON-LICENCIE') {
            if (!empty($_FILES['certif1'])) {
                upload("certif1");
            }
        }
        if ($_POST['licence2'] == 'FFTri') {
            array_push($required_input, 'num_licence2', 'club2');
        }
        if ($_POST['licence2'] == 'NON-LICENCIE') {
            if (!empty($_FILES['certif2'])) {
                upload("certif2");
            }
        }

        foreach ($required_input as $input) {
            if (empty($_POST["$input"])) {
                $count++;
                echo 'C';
            } else {
                $_POST["$input"] = trim(htmlentities($_POST["$input"], ENT_QUOTES));
            }
        }

        if ($count > 0) {
            // echo 'Veuillez remplir tous les champs';
        } else {
            echo 'Modification OK';
            envoi_form();
        }
    }
}

function envoi_form()
{
    try { // Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
        die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO en_attente(id_team, nom_relayeur_1, prenom_relayeur_1, sexe1, tshirt1, annee_naissance_1, telephone1, licence_1, numero_licence_1, club1, certificat1, nom_relayeur_2, prenom_relayeur_2, sexe2, tshirt2, annee_naissance_2, telephone2, licence_2, numero_licence_2, club2, certificat2, etat) VALUES(:id_team, :nom_relayeur_1, :prenom_relayeur_1, :sexe1, :tshirt1, :annee_naissance_1, :telephone1, :licence_1, :numero_licence_1, :club1, :certificat1, :nom_relayeur_2, :prenom_relayeur_2, :sexe2, :tshirt2, :annee_naissance_2, :telephone2, :licence_2, :numero_licence_2, :club2, :certificat2, :etat)');

    $req->execute(array(
        'id_team' => $_SESSION['user']['id'],
        'nom_relayeur_1' => $_POST['nom1'],
        'prenom_relayeur_1' => $_POST['prenom1'],
        'sexe1' => $_POST['sexe1'],
        'tshirt1' => $_POST['t-shirt1'],
        'annee_naissance_1' => $_POST['annee_naissance1'],
        'telephone1' => $_POST['tel1'],
        'licence_1' => $_POST['licence1'],
        'numero_licence_1' => $_POST['num_licence1'],
        'club1' => $_POST['club1'],
        'certificat1' => 'uploads/'. md5(pathinfo($_FILES["certif1"]["name"])['filename']) . '.' . pathinfo($_FILES["certif1"]["name"])['extension'],
        'nom_relayeur_2' => $_POST['nom2'],
        'prenom_relayeur_2' => $_POST['prenom2'],
        'sexe2' => $_POST['sexe2'],
        'tshirt2' => $_POST['t-shirt2'],
        'annee_naissance_2' => $_POST['annee_naissance2'],
        'telephone2' => $_POST['tel2'],
        'licence_2' => $_POST['licence2'],
        'numero_licence_2' => $_POST['num_licence2'],
        'club2' => $_POST['club2'],
        'certificat2' => 'uploads/'. md5(pathinfo($_FILES["certif2"]["name"])['filename']) . '.' . pathinfo($_FILES["certif2"]["name"])['extension'],
        'etat' => 'a_valider'
    ));
    header('Location: index.php?page=espace_personnel');
    die;
}

function upload($certif)
{
    global $count;
    if (isset($_FILES["$certif"]) and $_FILES["$certif"]["error"] == 0) {
        if ($_FILES["$certif"]["size"] <= 1000000) {
            $infosFichier = pathinfo($_FILES["$certif"]["name"]);
            $extensionUpload = $infosFichier["extension"];
            if ($extensionUpload == "pdf") {
                move_uploaded_file($_FILES["$certif"]["tmp_name"], 'uploads/'. md5($infosFichier['filename']) . '.' . $infosFichier['extension']);
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