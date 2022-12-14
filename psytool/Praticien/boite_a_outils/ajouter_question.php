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
    <title>Ajouter une question</title>
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
                    <button type="button" class="btn btn-light">Retour questions</button>
                </a>
            </div>
            <div class="col">
                <a href='ajouter_question.php?deconnexion=true' style="float:right; margin: 20px;">
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
                <form class="row g-3" action="./database/insert_question.php" method="POST">
                    <h3 class="title">Ajouter une question</h3>
                    <div class="form-group">
                        <span class="input-icon">Question par défaut ?</span>
                        <input type="text" class="form-control" name="DEFAUT" id="defaut" placeholder="1 = oui, 0 = non" required>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">Titre</span>
                        <input type="text" class="form-control" name="TITRE" id="defaut" placeholder="Titre de la question" required>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">Intitulé</span> 
                        <input type="text" class="form-control" name="INTITULE_Q" id="intitule" placeholder="Ecrivez la nouvelle question" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                    </div>
                </form>
                
            </div>
        </div>

    </div>

</body>

</html>