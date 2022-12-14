<!DOCTYPE html>
<!--
Page du formulaire de connexion
-->
<html>

<head>
    <title>Psytool - Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/css_index.css">
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
                <div class="mx-auto" style="width: 400px; margin-top:100px;">

                    <form class="row g-3" action="login.php" method="POST">
                        <h3 class="title">Formulaire de connexion</h3>
                        <div class="form-group">
                            <span class="input-icon">Nom d'utilisateur</span>
                            <input type="text" class="form-control" name="USERNAME" id="username" placeholder="Entrez votre nom d'utilisateur" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon">Mot de passe</span> 
                            <input type="password" class="form-control" name="PASSWORD" id="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Connexion</button>
                        </div>
                    </form>

                    <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == true) {
                                echo "<p id='error'> Nom d'utilisateur ou mot de passe invalide, veuillez réessayer. </p>";
                            }
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

