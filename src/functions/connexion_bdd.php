<?php
require_once('src/helpers/dotenv.php');

$bdd;
function connexion_bdd()
{
    global $bdd;
    try { // Connexion à la BDD
        $bdd = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';dbname=' . $_ENV["DB_NAME"] . ';charset=utf8', $_ENV["MYSQL_USERNAME"], $_ENV["MYSQL_PASSWORD"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
        die('Erreur : ' . $e->getMessage());
    }
}
