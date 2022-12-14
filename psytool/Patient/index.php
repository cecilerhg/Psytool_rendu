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
    <title>Mon espace patient</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/css_index_patient.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <div class="container">
        <div class="row">
            <div class="col">
                <a href="./journal_de_bord.php" style="float:left; margin: 20px;">
                    <button type="button" class="btn btn-outline-light m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">                            
                        <img class="fit-picture"
                        src="../ICONES/journal.png"
                        alt="journal" height="30" width="30">                   
                    </button>
                </a>
            </div>
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
        </div>

        <?php 
        // Affichage des questions par défaut 
        $q_par_defaut = "SELECT INTITULE, question.OUTIL_ID, TITRE_OUTIL FROM question 
                        INNER JOIN apparait ON question.OUTIL_ID = apparait.OUTIL_ID
                        WHERE apparait.ESPACE_PATIENT_ID = 1
                        AND question.PAR_DEFAUT = 1 ; "; 
        $req4 = $conn->query($q_par_defaut); 
        
        
        // Affichage des questions liées au patient
        $q_pat = "SELECT INTITULE, question.OUTIL_ID, TITRE_OUTIL FROM question 
                INNER JOIN apparait ON question.OUTIL_ID = apparait.OUTIL_ID
                WHERE apparait.ESPACE_PATIENT_ID = 1
                AND question.PAR_DEFAUT = 0 
                AND apparait.SELECTIONNE = 1; "; 
        $req5 = $conn->query($q_pat);

        
        while($row4 = $req4->fetch_assoc()) {
            $intitule_q_par_defaut = $row4['INTITULE']; 
            $titre_q_par_defaut = $row4['TITRE_OUTIL'];
            $id_q_par_defaut = $row4['OUTIL_ID']; ?>

        <div class="row text-center">
            <div class="col">
                <?php 
                    if ($titre_q_par_defaut == 'Humeur') 
                    { 
                        
                        echo '<p class="fs-5 fw-semibold" style="margin-top: 30px; margin-bottom:0px;">' . $intitule_q_par_defaut . '</p>' ;?>
                        </br>
                        <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off" >
                        <label class="btn btn-outline-success" for="btn-check-outlined">Bien</label>

                        <input type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off" checked>
                        <label class="btn btn-outline-warning" for="btn-check-2-outlined">Mal</label><br>

                <?php } else {
                
                        echo '<p class="fs-5 fw-semibold" style="margin-top: 30px; margin-bottom:0px;">' . $intitule_q_par_defaut . '</p>' ;?>
                        </br>
                        <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
                        <label class="btn btn-outline-success" for="btn-check-outlined">Oui</label>

                        <input type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off" checked>
                        <label class="btn btn-outline-warning" for="btn-check-2-outlined">Non</label><br>

                <?php } ?>
            </div>
        </div>

        <?php
        }

        while($row5 = $req5->fetch_assoc()) {
            $intitule_q_liee = $row5['INTITULE'];
            $titre_q_liee = $row5['TITRE_OUTIL'];
            $id_q_liee = $row5['OUTIL_ID']; 
            
             ;?>

        <div class="row text-center">
            <div class="col">
                <?php echo '<p class="fs-5 fw-semibold" style="margin-top: 30px; margin-bottom:0px;">' .  $intitule_q_liee . '</p>'; ?>
                </br>
                    <input type="checkbox" class="btn-check" id="btn-check-outlined" checked autocomplete="off">
                    <label class="btn btn-outline-success" for="btn-check-outlined">Oui</label>

                    <input type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off">
                    <label class="btn btn-outline-warning" for="btn-check-2-outlined">Non</label><br>

            </div>
        </div>
    <?php }

?>

        <br>

        <div class="row">
            <div class="col">
                <div class="fixed-bottom">
                    <p class="text-center">
                        <button type="button" class="btn btn-danger">APPEL D'URGENCE</button>
                    </p>
                </div>
            </div>
        </div>


    </div>
</body>

</html>