<?php

function logout()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['deconnexion'])) { // Quand user clique sur btn deconnexion on détruit sa session et on reviens à l'accueil
        $_SESSION = array();
        session_destroy();
        header('Location: index.php?page=connexion');
        die;
    }
}
