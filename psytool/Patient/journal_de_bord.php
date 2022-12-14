<?php 
    include "../connexion_database.php";
    session_start();

?>

<!DOCTYPE html>
<!-- 
Page contenant toutes les infos sur le patient sélectionné
-->
<html>

<head>
    <title>Mon journal de bord</title>
    <meta charset="utf-8">
    <!--<link rel="stylesheet" href="css_index.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <div class="container">

        <div class="row">
            <div class="col m-1">
                    <a href="./index.php" style="float:left; margin: 20px;">
                        <button type="button" class="btn btn-light ">                            
                            Retour                   
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
                    //include "../personne_connectee.php";
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p class='fs-5 fw-semibold text-center text-primary'>Mon journal du jour</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
            <input class="form-control" type="text" placeholder="Titre du journal" aria-label="default input example">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Ecrivez ici ce que vous ressentez, ce que vous souhaiteriez dire à votre praticien lors de la prochaine séance..."></textarea>
            </div>
        </div>

        <div class="row m-2">
            <div class="col">
                <p class='fs-5 fw-semibold text-center text-primary'>Mes anciens journaux</p>
            </div>
        </div>

        <?php 
            // Récupération de la date et du titre des anciens journaux 
            $j_d_b = "SELECT JOURNAL_ID, TITRE, DATE, CONTENU FROM journal 
                     WHERE ESPACE_PATIENT_ID = 1;" ;

            $req1 = $conn->query($j_d_b);
        ?>

        <div class="row">
            <div class="col">
                <p class='fs-6 text-success fw-semibold'>Sélectionnez un journal</p>

                <form class="row g-3" action="journal_de_bord.php" method="POST">
                    <div class="dropdown" >
                        <select class="form-control" name="j_selectionne">

                            <?php
                                while($row1 = $req1->fetch_assoc()) {
                                    $id_j = $row1['JOURNAL_ID'];
                                    $titre_j = $row1['TITRE'];
                                    $date_j = date("d/m/Y", strtotime($row1['DATE']));
                                    $contenu_j = $row1['CONTENU'];
                                
                                    
                                // echo "patient " . $pat_id . ', personne id ' . $pers_id_pat .' : ' . $pat_prenom . ' ' . $pat_nom . ' praticien id = ' . $prati_id ;
                                    echo '<option value=' .$id_j. '>' . $titre_j . ' - ' . $date_j . '</option>';
                                } 
                            ?>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-success mb-3" name="send" >Afficher mon ancien journal</button>

                </form>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <?php 
                    if(isset($_POST['send'])) {
                        $id_j_d_b_select = $_POST['j_selectionne'];
                        //Récup du contenu du journal sélectionné
                        $j_d_b_select = "SELECT CONTENU FROM journal 
                        WHERE JOURNAL_ID = '" . $id_j_d_b_select . "' " ;

                        $req2 = $conn->query($j_d_b_select);

                        while($row2 = $req2->fetch_assoc()) {
                            $contenu_j_select = $row2['CONTENU']; 
                            
                            echo '<textarea class="text-sm-start form-control" rows="10">' . $contenu_j_select .'</textarea>' ;

                         }
                    }
                ?>
            </div>
        </div>
        

    </div>

</body>

</html>