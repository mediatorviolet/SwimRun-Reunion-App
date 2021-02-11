<?php
$error_login = '';
function login()
{
    global $error_login;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['connexion'])) {
        try { // Connexion à la BDD
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=swimrun-app;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) { // Si erreur, on renvoi un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }

        // Préparation de la requête SQL : on va comparer le nom de la team et l'email du chef d'équipe
        $sql = "SELECT * FROM team WHERE team = :team AND code_invite = :code_invite";
        $req = $bdd->prepare($sql);

        // On exécute la requête SQL en comparant les infos de la BDD avec les infos rentrées dans le formulaire par l'utilisateur
        $req->execute(array(
            'team' => $_POST['team'],
            'code_invite' => $_POST['password']
        ));

        $result = $req->fetch();

        if (!$result) { // Si les identifiants ne concordent pas on affiche un message d'erreur
            $error_login = 'Nom d\'équipe ou mot de passe incorrect';
        } 
        if ($result && $result['role'] == 'user') { // Les identifiants correspondent avec ce qui se trouve dans la BDD
            $error_login = '';
            // $_SESSION['user'] = $result; // On stocke temporairement les infos de l'équipe dans la variable $_SESSION
            $_SESSION['auth'] = array(
                'id' => $result['id'],
                'login' => $_POST['team'],
                'pass' => $_POST['password'],
                'role' => $result['role'],
                'course' => $result['rsfp_product'],
                'team' => $result['team'],
                'nom1' => $result['nom_relayeur_1'],
                'prenom1' => $result['prenom_relayeur_1'],
                'sexe1' => $result['sexe_relayeur_1'],
                't-shirt1' => $result['tshirt_relayeur_1'],
                'annee_naissance1' => $result['annee_naissance_1'],
                'email1' => $result['email_relayeur_1'],
                'tel1' => $result['tel1'],
                'licence1' => $result['type_licence_relayeur_1'],
                'num_licence1' => $result['numero_licence_relayeur_1'],
                'club1' => $result['club_relayeur_1'],
                'nom2' => $result['nom_relayeur_2'],
                'prenom2' => $result['prenom_relayeur_2'],
                'sexe2' => $result['sexe_relayeur_2'],
                't-shirt2' => $result['tshirt_relayeur_2'],
                'annee_naissance2' => $result['annee_naissance_2'],
                'email2' => $result['email_relayeur_2'],
                'tel2' => $result['tel2'],
                'licence2' => $result['type_licence_relayeur_2'],
                'num_licence2' => $result['numero_licence_relayeur_2'],
                'club2' => $result['club_relayeur_2'],
            );
            header('Location: index.php?page=espace_personnel'); // On redirige l'utilisateur vers son espace personnel
            die;
        } 
        if ($result && $result['role'] == 'admin') {
            $error_login  = '';
            $_SESSION['auth'] = array(
                'login' => $_POST['team'],
                'pass' => $_POST['password'],
                'role' => $result['role']
            );
            header('Location: index.php?page=admin');
            die;
        }
    }
}
