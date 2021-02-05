<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\Antoine\Documents\GitHub\SwimRun-Reunion-App\vendor\autoload.php';

function send_mail($to, $subject, $template, $p1, $p2, $motif, $team, $code)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    // On force l'encodage en UTF-8 pour ne pas avoir de problèmes d'affichage
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';


    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'mail.gmx.com ';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'emaileur@gmx.fr';
        $mail->Password   = 'Pouetpouet123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('emaileur@gmx.fr', 'Swimrun Réunion');
        $mail->addAddress($to);

        // Content
        $message = file_get_contents("./templates/$template");
        $message = str_replace('%prenom1%', $p1, $message);
        $message = str_replace('%prenom2%', $p2, $message);
        $message = str_replace('%motif%', $motif, $message);
        $message = str_replace('%team%', $team, $message);
        $message = str_replace('%code_invite%', $code, $message);

        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AltBody = strip_tags($message);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

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
                $req = $bdd->query('SELECT e.id_attente, e.id_team, e.email1 email1, e.prenom1 p1, e.prenom2 p2, t.id, t.team team, t.code_invite code FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.id_attente = "' . $_POST['id_attente'] . '"');
                $donnees = $req->fetch();
                $to = $donnees['email1'];
                $p1 = html_entity_decode($donnees['p1']);
                $p2 = html_entity_decode($donnees['p2']);
                $team = html_entity_decode($donnees['team']);
                $code = $donnees['code'];
                $motif = $_POST['motif'];
                $template = 'non-valide-mail.html';
                // send_mail($to, 'Modifications non validées', $template, $p1, $p2, $motif, $team, $code);
                $req->closeCursor();
                $bdd->exec('UPDATE en_attente SET etat = \'non_valide\' WHERE id_attente = "' . $_POST['id_attente'] . '"');
                $bool = false;
            }
        }
    }
}

// Fonction qui compare les valeurs de la table team avec celles de la table en_attente, si elles sont différentes, la case correspondante du tableau est colorée en jaune
function highlight_change($t, $e)
{
    echo $t != html_entity_decode($e) ? "<td class='table-warning'>" . $e . "</td>" : "<td>" . $e . "</td>";
}
