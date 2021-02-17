<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Porvider\Google;

require 'C:\Users\Antoine\Documents\GitHub\SwimRun-Reunion-App\vendor\autoload.php';

function send_mail($to, $subject, $template, $p1, $p2, $motif, $team, $code)
{
    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = 'XOAUTH2';

    // Authentication details
    $email = 'nthestripper@gmail.com';
    $clientId = '471704535165-7g4ri2bkkf7t9mtgh5a4ph13l3j72see.apps.googleusercontent.com';
    $clientSecret = 'h2-XTUdnxXGgNijNiUYa52YB';
    $refreshToken = '1//03sTFsNZuMU_VCgYIARAAGAMSNwF-L9IreUhWV9sG0wHakr-BxYeE6PQ3brOdtWhNAUEmFpEr0gNhsEqufJo462xGApRlYGPLOgY';

    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret
        ]
    );

    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email
            ]
        )
    );

    $mail->setFrom($email, 'Swimrun Réunion');
    $mail->addAddress($to);
    $mail->Subject = $subject;

    // Content
    $message = file_get_contents("./templates/$template");
    $message = str_replace('%prenom1%', $p1, $message);
    $message = str_replace('%prenom2%', $p2, $message);
    $message = str_replace('%motif%', $motif, $message);
    $message = str_replace('%team%', $team, $message);
    $message = str_replace('%code_invite%', $code, $message);

    $mail->Charset = PHPMailer::CHARSET_UTF8;
    $mail->msgHTML($message);
    $mail->AltBody = strip_tags($message);

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    } else {
        echo 'Message sent!';
        return true;
    }
}

$bool;
function valider()
{
    global $bool;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and (isset($_POST['valide']) or isset($_POST['non-valide']) or isset($_POST['modifier']))) {
        try { // Connexion à la BDD
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }

        if (isset($_POST['valide'])) {
            $req = $bdd->query('SELECT prenom1 p1, prenom2 p2, email1 FROM en_attente WHERE id_attente = "' . $_POST['id_attente'] . '"');
            $donnees = $req->fetch();
            $to = $donnees['email1'];
            $p1 = $donnees['p1'];
            $p2 = $donnees['p2'];
            $template = 'valide-mail.html';
            // Ligne à décommenter pour envoyer le mail
            // send_mail($to, 'Modifications validées', $template, $p1, $p2, '', '', '');
            $req->closeCursor();
            // if (send_mail($to, 'Modifications validées', $template, $p1, $p2, '', '', '') == true) {
            // }
            extract($_POST);
            $sql = "UPDATE en_attente SET nom1 = '$nom1', prenom1 = '$prenom1', sexe1 = '$sexe1', tshirt1 = '$tshirt1', annee_naissance1 = '$annee_naissance1', email1 = '$email1', telephone1 = '$telephone1', licence_1 = '$licence_1', numero_licence_1 = '$numero_licence_1', club1 = '$club1', nom2 = '$nom2', prenom2 = '$prenom2', sexe2 = '$sexe2', tshirt2 = '$tshirt2', annee_naissance2 = '$annee_naissance2', email2 = '$email2', telephone2 = '$telephone2', licence_2 = '$licence_2', numero_licence_2 = '$numero_licence_2', club2 = '$club2', etat = 'valide' WHERE id_attente = '" . $_POST['id_attente'] . "'";
            $bdd->exec($sql);
            $bool = true;
        }

        if (isset($_POST['non-valide'])) {
            if (!empty($_POST['motif'])) {
                $req = $bdd->query('SELECT e.id_attente, e.id_team, e.email1 email1, e.prenom1 p1, e.prenom2 p2, t.id, t.team team, t.code_invite code FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.id_attente = "' . $_POST['id_attente'] . '"');
                $donnees = $req->fetch();
                $to = $donnees['email1'];
                $p1 = html_entity_decode($donnees['p1']);
                $p2 = html_entity_decode($donnees['p2']);
                $team = html_entity_decode($donnees['team']);
                $code = $donnees['code'];
                $motif = $_POST['motif'];
                $template = 'non-valide-mail.html';
                // Ligne à décommenter pour envoyer le mail
                // send_mail($to, 'Modifications non validées', $template, $p1, $p2, $motif, $team, $code);
                $req->closeCursor();
                // if (send_mail($to, 'Modifications non validées', $template, $p1, $p2, $motif, $team, $code) == true) {
                // }
                extract($_POST);
                $sql = "UPDATE en_attente SET nom1 = '$nom1', prenom1 = '$prenom1', sexe1 = '$sexe1', tshirt1 = '$tshirt1', annee_naissance1 = '$annee_naissance1', email1 = '$email1', telephone1 = '$telephone1', licence_1 = '$licence_1', numero_licence_1 = '$numero_licence_1', club1 = '$club1', nom2 = '$nom2', prenom2 = '$prenom2', sexe2 = '$sexe2', tshirt2 = '$tshirt2', annee_naissance2 = '$annee_naissance2', email2 = '$email2', telephone2 = '$telephone2', licence_2 = '$licence_2', numero_licence_2 = '$numero_licence_2', club2 = '$club2', etat = 'non-valide' WHERE id_attente = '" . $_POST['id_attente'] . "'";
                $bdd->exec($sql);
                $bool = false;
            }
        }
    }
}

// Fonction qui compare les valeurs de la table team avec celles de la table en_attente, si elles sont différentes, la case correspondante du tableau est colorée en jaune
function highlight_change($a, $t, $e)
{
    echo $a["$t"] != html_entity_decode($a["$e"]) ? '<td class="table-warning"><input style="background-color: #fff3cd;" type="text" value="' . html_entity_decode($a["$e"]) . '" name= "' . $e . '"></td>' : '<td><input type="text" value="' . html_entity_decode($a["$e"]) . '" name="' . $e . '"></td>';
}
