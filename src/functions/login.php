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

        // Préparation de la requête SQL : on va comparer le nom de la team et l'email du chef d'équipe
        $req = $bdd->prepare('SELECT * FROM la_longue_copie WHERE team = :team AND email_relayeur_1 = :email_relayeur_1');

        // On exécute la requête SQL en comparant les infos de la BDD avec les infos rentrées dans le formulaire par l'utilisateur
        $req->execute(array(
            'team' => $_POST['team'],
            'email_relayeur_1' => $_POST['password']
        ));

        $result = $req->fetch();

        if (!$result) { // Si les identifiants ne concordent pas on affiche un message d'erreur
            $error_login = 'Nom d\'équipe ou mot de passe incorrect';
        } else { // Les identifiants correspondent avec ce qui se trouve dans la BDD
            $error_login = '';
            $_SESSION['user'] = $result; // On stocke temporairement les infos de l'équipe dans la variable $_SESSION
            header('Location: index.php?page=espace_personnel'); // On redirige l'utilisateur vers son espace personnel
            die;
        }
    }
}
