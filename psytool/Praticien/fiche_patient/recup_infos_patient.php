<?php 

    include "../../connexion_database.php";


    //Vérification de l'url et récupération de l'id patient sélectionné 
    if (isset($_GET['id_pat'])) {
        if ($_GET['id_pat'] != '') {
            $id_pat_selectionne = $_GET['id_pat'];
            //echo "id pat selectionné = " . $id_pat_selectionne ;
        }
    }

    //Récupération de l'id de la personne 
    $id_pers = "SELECT PERSONNE_ID FROM patient WHERE PATIENT_ID = '" . $id_pat_selectionne . "' ";
    $req5 = $conn->query($id_pers);
    while ($row5 = $req5->fetch_assoc()) {
        $id_pers_selectionnee = $row5['PERSONNE_ID'];
        //echo "id pers selectionnée = " . $id_pers_selectionnee ;
    }

    //Récupération des infos de la table 'personne'
    $infos_pers = "SELECT NOM, PRENOM, ADRESSE, TELEPHONE, EMAIL, DATE_NAISS, PROFESSION FROM personne 
                  WHERE PERSONNE_ID = '" . $id_pers_selectionnee . "' ";
    $req6 = $conn->query($infos_pers);
    while ($row6 = $req6->fetch_assoc()) {
        $nom = $row6['NOM'];
        $prenom = $row6['PRENOM'];
        $ddn = $row6['DATE_NAISS'];
        $adresse = $row6['ADRESSE'];
        $telephone = $row6['TELEPHONE'];
        $email = $row6['EMAIL'];
        $profession = $row6['PROFESSION'];
        //echo $nom . ' </br> ' . $prenom . ' </br> ' . $adresse . ' </br> ' . $telephone . ' </br> ' . $email ;
    }

    //Récupération des infos de la table 'patient'
    $infos_pat = "SELECT TRAITEMENT, DIAGNOSTIC, NUMERO_URGENCE, FREQ_CONSULT
                    FROM patient 
                    WHERE PATIENT_ID = '" . $id_pat_selectionne . "' ";
    $req7 = $conn->query($infos_pat); 
    while ($row7 = $req7->fetch_assoc()) {
        $traitement = $row7['TRAITEMENT'];
        $diagnostic = $row7['DIAGNOSTIC'];
        $numero_urgence = $row7['NUMERO_URGENCE'];
        $freq_consult = $row7['FREQ_CONSULT'];
        //echo 'Traitement = ' . $traitement . ' </br> Diagnostic = ' . $diagnostic . ' </br> Num urg = ' . $numero_urgence . ' </br> Freq consult = ' . $freq_consult ;
    }
    



?>