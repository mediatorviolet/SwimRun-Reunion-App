<?php
$error_login = '';
function login()
{
    global $error_login;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['connexion'])) {
        try { // Connexion à la BDD
            $bdd = new PDO('mysql:host=localhost;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->prepare('SELECT * FROM la_longue WHERE team = :team AND email_relayeur_1 = :email_relayeur_1');

        $req->execute(array(
            'team' => $_POST['team'],
            'email_relayeur_1' => $_POST['password']
        ));

        $result = $req->fetch();

        if (!$result) {
            $error_login = 'Nom d\'équipe ou mot de passe incorrect';
        } else {
            $error_login = '';
            $_SESSION['user'] = $result;
            header('Location: index.php?page=choix_connexion');
            die;
        }
    }
}
