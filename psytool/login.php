<?php

//Verification des données du formulaire de connexion
/*
Si les données sont valides : 
    - renvoie vers patient/index.php ou praticien/index.php
Si les données sont erronées : 
    - renvoie vers le form, index.php, avec une erreur
*/

session_start();

    $USERNAME = $_POST['USERNAME'];
    $PASSWORD = $_POST['PASSWORD'];

    $last_char_username = substr($USERNAME, -1);

    echo "user : ", $USERNAME, " mdp : ", $PASSWORD;

include "connexion_database.php";

//Validation form
if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD'])) {
    $USERNAME = $_POST['USERNAME'];
    $PASSWORD = $_POST['PASSWORD'];

    $last_char_username = substr($USERNAME, -1);

    echo "user : ", $USERNAME, " mdp : ", $PASSWORD;

    if ($USERNAME !== "" && $PASSWORD !== "") {
        $login_user = "SELECT COUNT(*) AS count FROM login 
                        WHERE USERNAME='" . $USERNAME . "' and PASSWORD='" . $PASSWORD . "' ";
        $req = $conn->query($login_user);
        while ($row = $req->fetch_assoc()) {
            $count = $row['count'];
            //if count != 0, l'utilisateur existe, et si son nom d'utilisateur
            //fini par P, on le redirige vers la page PATIENT, 
            //s'il fini par M, on redirige vers la page Praticien
            //sinon erreur et retour à la page du formulaire (index.php)
            if ($count != 0 && $last_char_username == 'P') {
                $_SESSION['USERNAME'] = $USERNAME;
                header('Location: patient/index.php');
            } elseif ($count != 0 && $last_char_username == 'M') {
                $_SESSION['USERNAME'] = $USERNAME;
                header('Location: praticien/index.php');
            } else {
                header('Location: index.php?error=true');
            }
        }
    }
} else {
   // header('Location: index.php');
   echo"Error: " . mysqli_error($conn);
}

mysqli_close($conn);

?>