<?php 

    include "../../../connexion_database.php";

    //Vérifier l'existence des champs 
    if (isset($_GET['outil_id'])) {
        $outil_id = $_GET['outil_id'];

        echo 'outil id : ' . $outil_id; 

        //Suppression de la question dans l'espace patient
        $update_question = "UPDATE apparait SET SELECTIONNE = 0 WHERE OUTIL_ID = '" . $outil_id . "' "; 
        
        if (mysqli_query($conn, $update_question)) {
            echo "Suppression OK";
        } else {
            echo "Error : " . mysqli_error($conn);
        }

        mysqli_close($conn);

        //Redirection vers la fiche patient
        header('Location: ../fiche_patient.php?id_pat=1');
    }
    else {
        header('Location: ../fiche_patient.php?error_delete=true');
    }
?>