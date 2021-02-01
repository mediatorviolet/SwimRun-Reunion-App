<?php

function valider()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and (isset($_POST['valide']) or isset($_POST['non-valide']))) {
        try { // Connexion à la BDD
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }

        if (isset($_POST['valide'])) {
            $bdd->exec('UPDATE en_attente SET etat = \'valide\' WHERE id_attente = "' . $_POST['id_attente'] . '"');
            // header('Location: index.php?page=admin');
        }

        if (isset($_POST['non-valide'])) {
            $bdd->exec('UPDATE en_attente SET etat = \'non_valide\' WHERE id_attente = "' . $_POST['id_attente'] . '"');
        }
        header('Location: index.php?page=admin');
        die;
    }
}