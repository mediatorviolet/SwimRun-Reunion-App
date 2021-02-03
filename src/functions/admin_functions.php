<?php

$bool;
function valider()
{
    global $bool;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and (isset($_POST['valide']) or isset($_POST['non-valide']))) {
        try { // Connexion à la BDD
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }

        if (isset($_POST['valide'])) {
            $bdd->exec('UPDATE en_attente SET etat = \'valide\' WHERE id_attente = "' . $_POST['id_attente'] . '"');
            $bool = true;
        }

        if (isset($_POST['non-valide'])) {
            if (!empty($_POST['motif'])) {
                $bdd->exec('UPDATE en_attente SET etat = \'non_valide\' WHERE id_attente = "' . $_POST['id_attente'] . '"');
                $bool = false;
            }
        }
        // header('Location: index.php?page=admin');
        // die;
    }
}

// Fonction qui compare les valeurs de la table team avec celles de la table en_attente, si elles sont différentes, la case correspondante du tableau est colorée en jaune
function highlight_change($t, $e)
{
    echo $t != $e ? "<td class='table-warning'>" . $e . "</td>" : "<td>" . $e . "</td>";
}
