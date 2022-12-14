<?php 
//Requête pour trouver l'id de la personne connectée 
$pers_id = "SELECT LOGIN_ID FROM login WHERE username='" . $user . "' ";
$req0 = $conn->query($pers_id);
while ($row0 = $req0->fetch_assoc()) {
    $personne_id = $row0['LOGIN_ID'];
    //echo 'ID USER CONNECTE : ' . $personne_id ;
}

//Requête pour récupérer le nom et le prénom de la personne connectée 
$pers_nom = "SELECT NOM, PRENOM FROM personne WHERE PERSONNE_ID='" . $personne_id . "' ";
$req2 = $conn->query($pers_nom);
while ($row2 = $req2->fetch_assoc()) {
    $nom = $row2['NOM'];
    $prenom = $row2['PRENOM'];
    echo "<p class='fs-6 fw-normal text-secondary'> Bonjour $prenom $nom, bienvenue sur Psytool ! </p>";
}

//Récupération de l'ID du praticien ou du patient
$prat_id = "SELECT COUNT(PRATICIEN_ID) AS count_prat, PRATICIEN_ID  FROM praticien WHERE praticien.PERSONNE_ID = '" . $personne_id . "' ";
$pat_id = "SELECT COUNT(PATIENT_ID) AS count_pat, PATIENT_ID  FROM patient WHERE patient.PERSONNE_ID = '" . $personne_id . "'";
$req1 = $conn->query($prat_id);
$req3 = $conn->query($pat_id);
while ($row1 = $req1->fetch_assoc()) {
    $count_prat = $row1['count_prat'];
    if ($count_prat != 0) {
        $praticien_id = $row1['PRATICIEN_ID'];
        // echo "praticien id = " . $praticien_id ;
    } else {
        // echo " </br> user connecté est un patient";
    }
}

while ($row3 = $req3->fetch_assoc()) {
    $count_pat = $row3['count_pat'];
    if ($count_pat != 0) {
        $patient_id = $row3['PATIENT_ID'];
        // echo "patient id = " . $patient_id ; 
    } else {
        // echo " </br> user connecté est un médecin";
    }
}

?>