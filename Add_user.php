<?php
require_once 'config.php';
$nom_err='';

$nom_utilisateur = $_POST['userName'];
$numero_tel = $_POST['numero_tel'];
$password = $_POST['password'];


$sql_check_user = "SELECT id FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur'";
    $result_check_user = $link->query($sql_check_user);

    if ($result_check_user->num_rows > 0) {
        $nom_err = 'Nom d\'utilisateur déjà existant.';
        session_start();
        $_SESSION['nom_err'] = $nom_err;
        header("Location: inscription.php?STATUS=Nom d'utilisateur déjà existant");
        exit();
    } else {
        $sql_insert = "INSERT INTO utilisateur (nom_utilisateur, numero_tel ,password) 
                        VALUES ('$nom_utilisateur', '$numero_tel','$password')";
        if ($link->query($sql_insert) === TRUE) {
            header("location:../connexion.php?profil=added_successfully");
            exit();
        } else {
            echo "Erreur: " . $link->error;
        }
    }