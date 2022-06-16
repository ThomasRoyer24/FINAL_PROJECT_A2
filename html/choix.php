<?php
    include("../php/database.php");
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    session_start();
    $db = dbConnect(); // Database connection
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Choix</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg" style = "background: #FFA800 ; border : 3px solid #FF7A00"  >
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <a href = "connexion.php" class="btn btn-primary" type="submit" style = "background: #4F5B5E; margin-left: auto; ">Déconnection</a>
        </div>
    </nav>
    <br><br>
    <div class="mask d-flex align-items-center h-150 gradient-custom-3">
        <div class="container" style="border-radius: 10px; background-color: #4F5B5E; top : 0px; margin-left: auto; margin-right: auto;">
            <div class="card-body p-4">
                <h3 class="text-uppercase text-center mb-5" style = "color: #FFFFFF;"> Que voulez vous faire ?</h3>  
                <div class="row align-items-center h-100">
                    <a href = "explorer.php" class="btn btn-primary" type="submit" style = "background: #FFA800; margin-left: auto; margin-right: auto;">Je veux jouer</a>
                    <br><br><br>
                </div>
                <div class="row align-items-center h-100">
                    
                    <a href = "organiser.php"  class="btn btn-primary" type="submit" style = "background: #FFA800; margin-left: auto; margin-right: auto;">Je veux organiser</a>
                    <br><br><br>
                </div>
                <div class="row align-items-center h-100">
                    <a href = "profil.php" class="btn btn-primary" type="submit" style = "background: #FFA800; margin-left: auto; margin-right: auto;">Mon profil</a>
                    <br><br><br>
                </div>
                
            </div>
        </div>
    </div>



</body>


<footer class="fixed-bottom" style = "background: #FFA800 ; border : 3px solid #FF7A00">
    <div class="container">
        <p class="m-0 text-center text-black">PlayTogether</p>
    </div>
</footer>
    
</html>