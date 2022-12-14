<?php 
    include "../../connexion_database.php";
    session_start();

?>

<!DOCTYPE html>
<!-- 
Page contenant toutes les infos sur le patient sélectionné
-->
<html>

<head>
    <title>Fiche patient</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../CSS/css_fiche_patient.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    
    </style>
</head>

<body>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <div class="container-fluid">

        <div class="row">
            <div class="col">

                <a href="../index.php" style="float:left;" >
                    <button type="button" class="btn btn-success">Consulter une autre fiche patient </button>
                </a>
                <a href='../../index.php?deconnexion=true' style="float:right;">
                    <button type="button" class="btn btn-danger">Déconnexion</button>
                </a>
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

        <?php include "recup_infos_patient.php" ;
            //liste de toutes les variables 
            
            //echo 'id pat = ' . $id_pat_selectionne . '</br> id pers = ' . $id_pers_selectionnee . '</br>' ;
            //echo $nom . ' </br> ' . $prenom . ' </br> ' . $adresse . ' </br> ' . $telephone . ' </br> ' . $email . ' </br> ' . $ddn ;
            //echo 'Traitement = ' . $traitement . ' </br> Diagnostic = ' . $diagnostic . ' </br> Num urg = ' . $numero_urgence . ' </br> Freq consult = ' . $freq_consult ;
        ?>

        <div class="row">
            
            <div class="col-md-8 border rounded">
                <div class="row">
                    <div class="col">
                        <p class="text-center fs-5 fw-semibold text-primary ">Visualiser les données entre le 

                            <input type="date" id="start" name="trip-start" value="2022-12-05" min="2018-01-01" max="2018-12-31">

                             et le 

                            <input type="date" id="start" name="trip-start" value="2022-12-11" min="2018-01-01" max="2018-12-31">
                        </p>
                    </div>
                </div>
                <img src="../../ICONES/ca_va.png" class="img-fluid" alt="graphe">
                <img src="../../ICONES/graphe_sommeil.png" class="img-fluid" alt="graphe">
                <br><br><br>
                    <button type="button" class="btn btn-primary">Consulter tous les graphes</button>
              

            </div>
            <div class="col-md-4">
                <!-- Infos patient -->
                <div class="col-md-12 border rounded m-2" > 
                    <?php 
                        $aujourdhui = date("Y-m-d");
                        $diff = date_diff(date_create($ddn), date_create($aujourdhui));
    
                        echo '<p class="fs-5 fw-bold text-primary">' . $prenom . ' ' . $nom  ; ?>
                        
                        <button type="button" class="btn btn-light">
                            <img class="fit-picture"
                            src="../../ICONES/crayon.png"
                            alt="crayon" height="20" width="20">

                        </button> </p>

                    <?php
                        echo '<p>' . $diff->format('%y') . ' ans </br></p>  ';
                        echo '<p class="fw-semibold">' . $profession . ' </br> </p>' ;
                        echo '<p class="fw-semibold"> Pathologie : ' . $diagnostic . '</br></p> ' ;
                        echo '<p class="fw-semibold"> Fréq consultation : ' . $freq_consult . '</br> </p>  ' ;
                        echo '<p class="fw-semibold">Traitement : ' . $traitement . '</br></p>  ' ;
                    ?>

                    <button type="button" class="btn btn-secondary">+ d'infos</button>
                </div>
                <!-- Boîte à outils -->
                <?php 
                    //Récupération des outils par défaut
                    $outils_par_default = "SELECT TITRE_OUTIL, INTITULE FROM question
                                            WHERE PAR_DEFAUT = 1";
                    $req8 = $conn->query($outils_par_default);

                    //Récupération des outils liés au patient
                    $outils_patient = "SELECT question.OUTIL_ID, TITRE_OUTIL, INTITULE FROM question
                                       INNER JOIN apparait ON question.OUTIL_ID = apparait.OUTIL_ID
                                       WHERE question.PAR_DEFAUT = 0 
                                       AND apparait.SELECTIONNE = 1; "; 
                    $req9 = $conn->query($outils_patient);

                    //Récupération des outils non liés au patient et non par défaut 
                    $outils_non_par_def = "SELECT question.OUTIL_ID, TITRE_OUTIL, INTITULE FROM question
                                            INNER JOIN apparait ON question.OUTIL_ID = apparait.OUTIL_ID
                                            WHERE question.PAR_DEFAUT = 0 
                                            AND apparait.SELECTIONNE = 0; "; 
                    $req10 = $conn->query($outils_non_par_def);
                ?>
                <div class="col-md-12 border rounded m-1" >
                    <p class="fs-5 fw-bold">Espace questions du patient</br> </p>
                    
                   <!-- <a href="./database/add_outil_pat.php">-->
                        <button type="button" class="btn btn-outline-light m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">                            
                            <img class="fit-picture"
                            src="../../ICONES/plus.png"
                            alt="crayon" height="20" width="20">                   
                        </button> 
                    <!--</a>-->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une question</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">Selectionner ?</th>
                                            <th scope="col">Titre</th>
                                            <th scope="col">Questions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            while($row10 = $req10->fetch_assoc()) {
                                                $titre_q_non_select = $row10['TITRE_OUTIL'];
                                                $intitule_q_non_select = $row10['INTITULE'];
                                                $id_q_non_select = $row10['OUTIL_ID'];
                                                
                                                //echo $intitule_q_non_select . ' ' . $titre_q_non_select ;
                                                ?>
                                                <tr>
                                                    <th scope="row"> 
                                                        <a href="./database/add_outil_pat.php?q_id=<?php echo $id_q_non_select ; ?>">
                                                            <button type="button" class="btn btn-outline-light m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">                            
                                                                <img class="fit-picture"
                                                                src="../../ICONES/plus.png"
                                                                alt="crayon" height="20" width="20">                   
                                                            </button> 
                                                        </a>
                                                    </th>
                                                    <td><?php echo $titre_q_non_select ; ?></td>
                                                    <td><?php echo $intitule_q_non_select ; ?></td>
                                                    
                                                </tr>
                                            <?php } 
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <a href="../boite_a_outils/ajouter_question.php">
                                        <button type="button" class="btn btn-success">Ajouter une question</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <ol class="list-group list-group-numbered">
                        <?php
                            while ($row8 = $req8->fetch_assoc()) {
                                $titre_q_par_def = $row8['TITRE_OUTIL'];
                                $intitule_q_par_def = $row8['INTITULE']; ?>
                                
                                <li class="list-group-item list-group-item-primary"><?php echo $titre_q_par_def ; ?></li>
                            
                            <?php
                            } 
                            while ($row9 = $req9->fetch_assoc()) {
                                $outil_id_pat = $row9['OUTIL_ID'];
                                $titre_q_pat = $row9['TITRE_OUTIL'];
                                $intitule_q_pat = $row9['INTITULE']; ?>

                                <li class="list-group-item list-group-item-warning">
                                    <?php echo $titre_q_pat ; ?>
                                    <a href="./database/delete_outil_pat.php?outil_id=<?php echo $outil_id_pat;?>">
                                        <img class="fit-picture"
                                        src="../../ICONES/effacer.png"
                                        alt="crayon" height="20" width="20">
                                    </a>
                                </li>
                                    <!-- Button trigger modal -->

                            <?php    
                            }
                            ?>
                    </ol>
                </div>
            </div>
        </div>

    </div>

</body>

</html>