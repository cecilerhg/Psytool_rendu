<?php 
    include "../connexion_database.php";
    session_start();

    if(isset($_POST['send']))
    {
    $id_pat_select = $_POST["pat_selectionne"];
    echo "Id patient sélectionné =  ".$id_pat_select;
    }

    header('Location: fiche_patient/fiche_patient.php?id_pat='.$id_pat_select.'');
?>