<?php 

    include "../../../connexion_database.php";

    //Vérifier l'existence des champs 
    if (isset($_GET['q_id'])) {
        $q_id = $_GET['q_id'];

        // echo 'Q_id =  : ' . $q_id ; 

        //Insertion dans la base de données 
        $update_apparait = "UPDATE apparait SET SELECTIONNE = 1 WHERE OUTIL_ID = '" . $q_id . "';"; 
        if (mysqli_query($conn, $update_apparait)) {
            echo "Update OK";
        } else {
            echo "Error : " . mysqli_error($conn);
        }
        

        mysqli_close($conn);

        //Redirection vers la fiche patient
        header('Location: ../fiche_patient.php?id_pat=1');
    }
    else {
        header('Location: ../fiche_patient.php?error=true');
    }
?>