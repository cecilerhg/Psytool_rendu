<?php 

include "../../connexion_database.php";
    session_start();


    if(isset($_POST['send'])) {
        $id_j_d_b_select = $_POST['j_selectionne'];
        //Récup du contenu du journal sélectionné
        $j_d_b_select = "SELECT CONTENU FROM journal 
        WHERE JOURNAL_ID = '" . $id_j_d_b_select . "' " ;
    
        $req2 = $conn->query($j_d_b_select);
    
        while($row2 = $req2->fetch_assoc()) {
            $contenu_j_select = $row2['CONTENU']; 
            
            // echo $contenu_j_select ;
        }
    } else {
        echo "Error : " . mysqli_error($conn);
    }
?>