<?php

function logout()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['deconnexion'])) { // Quand user clique sur btn deconnexion on détruit sa session et on reviens à l'accueil
        $_SESSION['user'] = false;
        session_destroy();
        header('Location: index.php?page=connexion');
        die;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['deconnexion_admin'])) {
        $_SESSION['admin'] = false;
        session_destroy();
        header('Location: index.php?page=connexion');
        die;
    }
}
