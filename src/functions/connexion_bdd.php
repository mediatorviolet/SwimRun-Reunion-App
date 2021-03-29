<?php

$bdd;
function connexion_bdd()
{
    global $bdd;
    try { // Connexion à la BDD
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'antoine', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
        die('Erreur : ' . $e->getMessage());
    }
}
