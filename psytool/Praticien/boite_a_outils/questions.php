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
    <title>Banque de questions</title>
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
            <div class="col">
                <a href='../index.php' style="float:left; margin: 20px;">
                    <button type="button" class="btn btn-light">Retour accueil</button>
                </a>
            </div>
            <div class="col">
                <a href='questions.php?deconnexion=true' style="float:right; margin: 20px;">
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
                            header('Location: ../../index.php');
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
                <h3 style="text-align: center ;">Banque de questions</h3>
            </div>
        </div>

        <div class="row" style="margin: 40px ;">
            <div class="col">
                <a href="./ajouter_question.php">
                    <button type="button" class="btn btn-success">Ajouter une question</button>
                </a>    
            </div>
        </div>
                

        <?php 
            //Récupération des questions de la boîte à outils 
            $questions = "SELECT OUTIL_ID, TITRE_OUTIL, INTITULE, PAR_DEFAUT FROM question";
            $req9 = $conn->query($questions);
        ?>

        <div class="row" style="margin: 20px ;">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Par défaut</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Questions</th>
                        <th scope="col" style="text-align: center ;">Modifier</th>
                        <th scope="col" style="text-align: center ;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($row9 = $req9->fetch_assoc()) {
                                $titre = $row9['TITRE_OUTIL'];
                                $intitule = $row9['INTITULE'];
                                $defaut = $row9['PAR_DEFAUT']; 
                                $id_outil = $row9['OUTIL_ID'];
                                ?>
                                <tr>
                                    <th scope="row">   
                                        <?php 
                                            if ($defaut == 1) {
                                                echo 'Oui' ;
                                            } else {
                                                echo 'Non' ;
                                            }
                                         ?>
                                    </th>
                                    <td><?php echo $titre ; ?></td>
                                    <td><?php echo $intitule ; ?></td>
                                    <td style="text-align: center ;">
                                        <a href="./modifier_question.php">
                                                <img class="fit-picture"
                                                src="../../ICONES/crayon.png"
                                                alt="crayon" height="20" width="20">
                                        </a>
                                    </td>    
                                    <td style="text-align: center ;">
                                        <a href="./database/delete_question.php?outil_id=<?php echo $id_outil;?>">
                                            <img class="fit-picture"
                                                src="../../ICONES/effacer.png"
                                                alt="crayon" height="20" width="20">
                                        </a>
                                    </td>  
                                </tr>
                           <?php } 
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>



    </div>

</body>

</html>