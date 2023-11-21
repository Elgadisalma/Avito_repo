<?php

require_once 'config.php';

$nom_utilisateur = $_POST['userName'];
$password = $_POST['password'];

$sql_check_user = "SELECT id, nom_utilisateur, password FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur' && password = '$password'";
$result_check_user = $link->query($sql_check_user);

if (!$result_check_user) { 
    die("Erreur dans la requête : " . $link->error);
}

if ($result_check_user->num_rows > 0) {
    $user = $result_check_user->fetch_assoc();

        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];
        $_SESSION['numero_tel'] = $user['numero_tel'];

        header("Location: index.php?STATUS=connected avec succes");
        exit();
    } else {
        header("Location: connexion.php?STATUS=probleme de connexion");
        exit();
    }


// Fermer la connexion
$link->close();
?>

