<?php 
    include "../connexion_database.php";
    session_start();

?>

<!DOCTYPE html>
<!-- 
Page contenant le drop down pour choisir un patient en fonction du praticien connecté 
-->
<html>

<head>
    <title>Psytool - Accueil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/css_index_praticien.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<div class="container">
    <div class="row">
        <div class="col">
            <a href='../index.php?deconnexion=true' style="float:right; margin: 20px;">
                <button type="button" class="btn btn-danger">Déconnexion</button>
            </a>
        </div>
    </div>


        <div class="row">
            <div class="col">
                <?php
                    if (isset($_GET['deconnexion'])) {
                        if ($_GET['deconnexion'] == true) {
                            session_unset();
                            header('Location: ../index.php');
                        }
                    } else if ($_SESSION['USERNAME'] !== "") {
                        $user = $_SESSION['USERNAME'];   
                    }
                    
                    // on inclut la requete de recherche de la personne connectée
                    include "../personne_connectee.php";
                ?>
        
        </div>
        <?php
        
        ?> 
        <div class="row">
            <div class="col">
                <p id='fiche_pat' class="fw-bold fs-5"> Quelle fiche patient souhaitez-vous consulter ? </p>

                <form class="row g-3" action="select_patient.php" method="POST">
                    <div class="dropdown" >
                        <select class="form-control" name="pat_selectionne">

                            <?php
                                
                            //Récupération des patients du médecin connecté
                            $liste_pats = "SELECT personne.NOM as nom, personne.PRENOM as prenom, personne.PERSONNE_ID as id_pers_pat, patient.PATIENT_ID as id_pat, patient.PRATICIEN_ID AS prati_id
                                            FROM patient 
                                            INNER JOIN personne ON personne.PERSONNE_ID = patient.PERSONNE_ID
                                            WHERE patient.PRATICIEN_ID = '" . $praticien_id . "' ";
                                $req4 = $conn->query($liste_pats);
                                while ($row4 = $req4->fetch_assoc()) {
                                    $pat_nom = $row4['nom'];
                                    $pat_prenom = $row4['prenom'];
                                    $pat_id = $row4['id_pat'];
                                    $pers_id_pat = $row4['id_pers_pat'];
                                    $prati_id = $row4['prati_id'];
                                    
                                // echo "patient " . $pat_id . ', personne id ' . $pers_id_pat .' : ' . $pat_prenom . ' ' . $pat_nom . ' praticien id = ' . $prati_id ;
                                    echo '<option value=' .$pat_id. '>' . $pat_prenom . ' ' . $pat_nom . '</option>';
                                } 
                            ?>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary mb-3" name="send" >Accéder à la fiche patient</button>

                </form>
                    
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col position-relative m-5 text-center" >
                <a href="./boite_a_outils/questions.php">
                    <button type="button" class="btn btn-success " >Banque de questions </button>
                </a>    
            </div>
        </div>

        <div class="row" >
            <div class="col position-relative text-center" >
                <a href="">
                    <button type="button" class="btn btn-warning" >Créer ou modifier un patient</button>
                </a>    
            </div>
        </div>
        
    </div>
</body>

</html>

