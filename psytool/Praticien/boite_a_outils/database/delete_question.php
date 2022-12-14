<?php 

    include "../../../connexion_database.php";

    //Vérifier l'existence des champs 
    if (isset($_GET['outil_id'])) {
        $outil_id = $_GET['outil_id'];

        echo 'outil id : ' . $outil_id; 

        //Suppression de la question dans la base de données 
        $delete_apparait = "DELETE FROM apparait WHERE OUTIL_ID = '" . $outil_id . "' ";
        $delete_question = "DELETE FROM question WHERE OUTIL_ID = '" . $outil_id . "' "; 
        
        if (mysqli_query($conn, $delete_apparait)) {
            echo "Suppression OK";
        } else {
            echo "Error : " . mysqli_error($conn);
        }
        
        if (mysqli_query($conn, $delete_question)) {
            echo "Suppression OK";
        } else {
            echo "Error : " . mysqli_error($conn);
        }

        mysqli_close($conn);

        //Redirection vers la banque de questions
        header('Location: ../questions.php');
    }
    else {
        header('Location: ../questions.php?error_delete=true');
    }
?>