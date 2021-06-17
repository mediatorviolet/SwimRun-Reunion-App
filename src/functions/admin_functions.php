<?php
require_once('src/functions/sendMailSiB.php');
require_once('src/helpers/dotenv.php');

$bool;
function valider()
{
    global $bool;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and (isset($_POST['valide']) or isset($_POST['non-valide']) or isset($_POST['modifier']))) {
        try { // Connexion à la BDD
            $bdd = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';dbname=' . $_ENV["DB_NAME"] . ';charset=utf8', $_ENV["MYSQL_USERNAME"], $_ENV["MYSQL_PASSWORD"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }

        if (isset($_POST['valide'])) {
            $req = $bdd->query('SELECT prenom1 p1, prenom2 p2, email1, email2 FROM en_attente WHERE id_attente = "' . $_POST['id_attente'] . '"');
            $donnees = $req->fetch();

            // With Sendinblue
            $to = [
                [
                    "email" => $donnees["email1"],
                    "name" => $donnees["p1"],
                ],
                [
                    "email" => $donnees["email2"],
                    "name" => $donnees["p2"],
                ]
            ];

            $params = ["prenom1" => html_entity_decode($donnees["p1"]), "prenom2" => html_entity_decode($donnees["p2"])];

            $templateId = 1;

            // sendMail(json_encode($to), json_encode($params), $templateId);

            $req->closeCursor();

            if (sendMail($to, $params, $templateId) === true) {
                extract($_POST);
                $sql = "UPDATE en_attente SET nom1 = '$nom1', prenom1 = '$prenom1', sexe1 = '$sexe1', tshirt1 = '$tshirt1', annee_naissance1 = '$annee_naissance1', email1 = '$email1', telephone1 = '$telephone1', licence_1 = '$licence_1', numero_licence_1 = '$numero_licence_1', club1 = '$club1', nom2 = '$nom2', prenom2 = '$prenom2', sexe2 = '$sexe2', tshirt2 = '$tshirt2', annee_naissance2 = '$annee_naissance2', email2 = '$email2', telephone2 = '$telephone2', licence_2 = '$licence_2', numero_licence_2 = '$numero_licence_2', club2 = '$club2', etat = 'valide' WHERE id_attente = '" . $_POST['id_attente'] . "'";
                $bdd->exec($sql);
                $bool = true;
            }
        }

        if (isset($_POST['non-valide'])) {
            if (!empty($_POST['motif'])) {
                $req = $bdd->query('SELECT e.id_attente, e.id_team, e.email1 email1, e.email2 email2, e.prenom1 p1, e.prenom2 p2, t.id, t.team team, t.code_invite code FROM team t RIGHT JOIN en_attente e ON e.id_team = t.id WHERE e.id_attente = "' . $_POST['id_attente'] . '"');
                $donnees = $req->fetch();

                // With Sendinblue
                $to = [
                    [
                        "email" => $donnees["email1"],
                        "name" => $donnees["p1"],
                    ],
                    [
                        "email" => $donnees["email2"],
                        "name" => $donnees["p2"],
                    ]
                ];

                $params = ["prenom1" => $donnees["p1"], "prenom2" => $donnees["p2"], "motif" => $_POST["motif"], "team" => $donnees["team"], "code_invite" => $donnees['code']];

                $templateId = 2;

                $req->closeCursor();

                if (sendMail($to, $params, $templateId) === true) {
                    extract($_POST);
                    $sql = "UPDATE en_attente SET nom1 = '$nom1', prenom1 = '$prenom1', sexe1 = '$sexe1', tshirt1 = '$tshirt1', annee_naissance1 = '$annee_naissance1', email1 = '$email1', telephone1 = '$telephone1', licence_1 = '$licence_1', numero_licence_1 = '$numero_licence_1', club1 = '$club1', nom2 = '$nom2', prenom2 = '$prenom2', sexe2 = '$sexe2', tshirt2 = '$tshirt2', annee_naissance2 = '$annee_naissance2', email2 = '$email2', telephone2 = '$telephone2', licence_2 = '$licence_2', numero_licence_2 = '$numero_licence_2', club2 = '$club2', etat = 'non_valide' WHERE id_attente = '" . $_POST['id_attente'] . "'";
                    $bdd->exec($sql);
                    $bool = false;
                }
            }
        }
    }
    return $bool;
}

// Fonction qui compare les valeurs de la table team avec celles de la table en_attente, si elles sont différentes, la case correspondante du tableau est colorée en jaune
function highlight_change($a, $t, $e)
{
    echo $a["$t"] != html_entity_decode($a["$e"]) ? '<td class="table-warning"><input style="background-color: #fff3cd;" type="text" value="' . html_entity_decode($a["$e"]) . '" name= "' . $e . '"></td>' : '<td><input type="text" value="' . html_entity_decode($a["$e"]) . '" name="' . $e . '"></td>';
}

function highlight_change_noInput($a, $t, $e)
{
    echo $a["$t"] != html_entity_decode($a["$e"]) ? '<td class="table-warning">' . html_entity_decode($a["$e"]) . '</td>' : '<td>' . html_entity_decode($a["$e"]) . '</td>';
}
