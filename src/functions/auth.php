<?php
require_once('src/helpers/dotenv.php');

class Auth
{
    static function isLogged()
    {
        if (isset($_SESSION['auth']) && isset($_SESSION['auth']['login']) && isset($_SESSION['auth']['pass'])) {
            extract($_SESSION['auth']);
            try { // Connexion à la BDD
                $bdd = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';dbname=' . $_ENV["DB_NAME"] . ';charset=utf8', $_ENV["MYSQL_USERNAME"], $_ENV["MYSQL_PASSWORD"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
