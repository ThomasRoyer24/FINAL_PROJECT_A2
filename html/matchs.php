<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Matchs</title>
            <!-- jquery -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"
        integrity="sha256-x3YZWtRjM8bJqf48dFAv/qmgL68SI4jqNWeSLMZaMGA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>

</head>


<body style ="background: #4F5B5E ">
    <nav class="navbar navbar-expand-lg" style = "background: #FFA800 ; border : 3px solid #FF7A00"  >
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <div style = "margin-left: auto;">
                <a href = "choix.php" class="btn" type="submit" style = "color:white; background: #4F5B5E; margin-left: auto; ">Menu</a>
                <a href = "explorer.php" class="btn" type="submit" style = "color:white; background: #4F5B5E; margin-left: auto; ">Explorer</a>
                <a href = "connexion.php" class="btn" type="submit" style = "color:white; background: #4F5B5E; margin-left: auto; ">Déconnection</a>
                
            </div>
        </div>
    </nav>
    <br>
    <div class="container" style="border-radius: 10px; background-color: #FFFFFF; top : 50px; margin-left: auto; margin-right: auto;">
        <div class="card-body p-4">
            <h3  style="color: #FFA800;">Matchs à venir</h3>
            <table id="table_futur" class="table" style="color: black;">

                </table>
            </div>
            <br>
            <div class="card-body p-4">
            <h3  style="color: #FFA800;">Matchs à passé</h3>
            <table id="table_past" class="table" style="color: black;">

                </table>
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
<script>ajaxRequest('GET',"../php/request.php/futur_match",display_futur_match);ajaxRequest('GET',"../php/request.php/past_match",display_past_match);</script>
</html>