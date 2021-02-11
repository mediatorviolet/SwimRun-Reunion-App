<?php

class Auth
{
    static function isLogged()
    {
        if (isset($_SESSION['auth']) && isset($_SESSION['auth']['login']) && isset($_SESSION['auth']['pass'])) {
            extract($_SESSION['auth']);
            try { // Connexion à la BDD
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
                die('Erreur : ' . $e->getMessage());
            }

            $req = $bdd->query("SELECT id FROM team WHERE team = '$login' AND code_invite = '$pass'");
            $res = $req->fetch();

            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }
}
