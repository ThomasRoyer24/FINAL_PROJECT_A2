<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Explorer</title>
        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"
        integrity="sha256-x3YZWtRjM8bJqf48dFAv/qmgL68SI4jqNWeSLMZaMGA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>

</head>


<body>
    <nav class="navbar navbar-expand-lg" style = "background: #FFA800 ; border : 3px solid #FF7A00"  >
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <div style = "margin-left: auto;">
                <a href = "choix.php" class="btn" type="submit" style = "color:white;background: #4F5B5E; ">Menu</a>
                <a href = "matchs.php" class="btn" type="submit" style = "color:white;background: #4F5B5E; ">Matchs</a>
                <a href = "connexion.php" class="btn" type="submit" style = "color:white;background: #4F5B5E; ">Déconnection</a>
            </div>
        </div>
    </nav>


    <br>
    <div class="d-flex m-2">
        
        <section class="centrage">
            <div class="mask d-flex align-items-center h-150 gradient-custom-3 mx-2">
                <div class="container" style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
                    <div class="card-body p-4">
                        <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Explorer</h3>
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Ville" id="city">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Sport" id="sport">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br><br>
                            <div class="col-12">
                                <select id = "time" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option id="plus_7">+ 7 jours</option>
                                    <option id="plus_15">+ 15 jours</option>
                                    <option id="plus_30">+ 30 jours</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <select id="match_status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value="true">Disponible</option>
                                    <option value="false">Complet</option>
                                </select>
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
    
                        </div>
                    </div>
                </div>
        </section>
    
    <br>
        <div class="container mx-2" style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
            <div class="card-body p-4">
                <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Informations Matchs</h3>
                <table class="table" style="color: #FFFFFF;" id="tableau_match">
                                          
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
<script src="../js/listen_recherche.js"></script>
<script>generate_input_date(false)</script>
</html>