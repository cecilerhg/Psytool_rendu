<?php 

    include "../../../connexion_database.php";

    //Vérifier l'existence des champs 
    if (isset($_GET['intitule']) && isset($_GET['defaut'])) {
        $intitule = $_GET['intitule'];
        $defaut = $_GET['defaut'];
    
        echo 'Par défaut : ' . $defaut . '. Intitulé : ' . $intitule ; 

        $select_derniere_q = "SELECT OUTIL_ID, PAR_DEFAUT FROM question WHERE INTITULE = '" . $intitule . "' ";
        $req = $conn->query($select_derniere_q);
        while ($row = $req->fetch_assoc()) {
            $q_id = $row['OUTIL_ID']; 
        }

        echo 'id question : ' . $q_id  ; 

        if($defaut == '0') {
            $insert_question_apparait = "INSERT INTO apparait(SELECTIONNE, ESPACE_PATIENT_ID, OUTIL_ID) VALUES (0, 1, '" . $q_id . "' )"; 
            if (mysqli_query($conn, $insert_question_apparait)) {
                echo "Enregistrement OK";
            } else {
                echo "Error : " . mysqli_error($conn);
            }
        } else {
            $insert_question_apparait_defaut = "INSERT INTO apparait(SELECTIONNE, ESPACE_PATIENT_ID, OUTIL_ID) VALUES (1, 1, '" . $q_id . "' )"; 
            if (mysqli_query($conn, $insert_question_apparait_defaut)) {
                echo "Enregistrement OK";
            } else {
                echo "Error : " . mysqli_error($conn);
            }
        }
        

        mysqli_close($conn);

        //Redirection vers la banque de questions
        header('Location: ../questions.php');
    }
    else {
        header('Location: ../questions.php?error=true');
    }
?>