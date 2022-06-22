
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Informations</title>
        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"
        integrity="sha256-x3YZWtRjM8bJqf48dFAv/qmgL68SI4jqNWeSLMZaMGA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>

</head>


<body style = "background: #4F5B5E;">
<nav class="navbar navbar-expand-lg" style = "background: #FFA800 ; border : 3px solid #FF7A00"  >
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <div style = "margin-left: auto;">
                <a href = "choix.php" class="btn" type="submit" style = " color:white; background: #4F5B5E; margin-left: auto; ">Menu</a>
                <a href = "explorer.php" class="btn" type="submit" style = " color:white; background: #4F5B5E; margin-left: auto; ">Explorer</a>
                <a href = "connexion.php" class="btn" type="submit" style = " color:white;background: #4F5B5E; margin-left: auto; ">Déconnection</a>
            </div>
        </div>
    </nav>
    <br>

    <div class="mask d-flex align-items-center h-150 gradient-custom-3">
        <div class="container" style="border-radius: 10px; background-color: #FFFFFF; top : 0px; margin-left: auto; margin-right: auto;">
            
            <div class="card-body p-4 d-flex flex-column">
                <h3 class="text-uppercase text-center mb-5" style="color: #FFA800;">Match sélectionné </h3>
                <h5 id ="sport"style="color: #FFA800;"><img src="../images/logos/cuptest.svg"> Sport : </h5>
                <h5 id ="ville" style="color: #FFA800;"><img src="../images/logos/buildtest.svg"> Ville : </h5>
                <h5 id ="date" style="color: #FFA800;"><img src="../images/logos/timetest.svg"> Date/Heure : </h5>
                <h5 id ="adresse" style="color: #FFA800;"><img src="../images/logos/loctest.svg"> Adresse : </h5>
                <h5 id ="prix" style="color: #FFA800;"><img src="../images/logos/moneytest.svg"> Prix :</h5>
                <hr>
                <h5 id ="admin" style="color: #FFA800;"><img src="../images/logos/crowntest.svg"> Organisateur : </h5>
                <h5 style="color: #FFA800;"><img src="../images/logos/persontest.svg"> Joueurs : </h5>
                <div class="container" style="border-radius: 5px; background-color: #4F5B5E; top : 0px; margin-left: auto; margin-right: auto;">
                    
                <p style = "color : white;"> ---------------  PHOTOS A METTRE ICI  --------------- </p>
                
                </div>
                <br>
                <button id="inscription_match" class="btn justify-content-center" type="submit" style="color:white; background: #FFA800; margin-left: auto; margin-right: auto;">Je m'inscris</button>
        <br><div id="error_message"></div>    </div>  
            </div> 
        </div>
        
    </div>

</body>


<footer class="fixed-bottom" style = "background: #FFA800 ; border : 3px solid #FF7A00">
    <div class="container">
        <p class="m-0 text-center text-black">PlayTogether</p>
    </div>
</footer>
<script src="../js/ajax.js"></script>
<script src="../js/listen.js"></script>
<script>ajaxRequest('GET', "../php/request.php/get_info-match",display_info_match);</script>
</html>