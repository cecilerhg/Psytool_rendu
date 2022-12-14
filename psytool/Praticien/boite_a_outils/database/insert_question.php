<?php 

    include "../../../connexion_database.php";

    //Vérifier l'existence des champs 
    if (isset($_POST['DEFAUT']) && isset($_POST['INTITULE_Q']) && isset($_POST['TITRE'])) {
        $defaut = $_POST['DEFAUT'];
        $intitule = $_POST['INTITULE_Q'];
        $titre = $_POST['TITRE'];
    

        // echo 'Par défaut : ' . $defaut . '. Intitulé : ' . $intitule ; 

        //Insertion dans la base de données 
        $insert_question = "INSERT INTO question(TITRE_OUTIL, INTITULE, PAR_DEFAUT, ID_BOITE) VALUES ('" . $titre . "', '" . $intitule . "', '" . $defaut . "', 1 )"; 
        if (mysqli_query($conn, $insert_question)) {
            echo "Enregistrement OK";
        } else {
            echo "Error : " . mysqli_error($conn);
        }
        

        mysqli_close($conn);

        //Redirection vers la banque de questions
        header('Location: ./insert_apparait.php?intitule='.$intitule.'&defaut='.$defaut.' ');
    }
    else {
        header('Location: ../questions.php?error=true');
    }
?>