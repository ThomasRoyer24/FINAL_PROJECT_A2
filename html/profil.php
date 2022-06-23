<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Profil</title>
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
                <a href = "notifications.php" class="btn" type="submit" style = "color:white;background: #4F5B5E; ">Notifications</a>
                <a href = "connexion.php" class="btn" type="submit" style = "color:white;background: #4F5B5E; ">Déconnection</a>
            </div>
        </div>
    </nav>
    

    <div class="d-flex m-2 justify-content-center">
        <section class="centrage">
                <div class="mask d-flex align-items-center h-150 gradient-custom-3 mx-2">
                    <div class="container" style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
                        <div class="card-body p-4">
                            <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Votre profil :</h3>
                            <div id = "photo"></div>
                            <hr>
                            <h6  style = "color :white">Nombre de matchs joués : <h8 id = "match_profil" style = "color :white"></h8></h6>
                            <h6  style = "color :white">Nom : <h8 id = "nom_profil" style = "color :white"></h8></h6>
                            <h6  style = "color :white">Prénom : <h8 id = "prenom_profil" style = "color :white"></h8></h6>
                            <h6  style = "color :white">Date de naissance : <h8 id = "age_profil" style = "color :white"></h8></h6>
                            <h6  style = "color :white">Ville : <h8 id = "ville_profil" style = "color :white"></h8></h6>
                            <h6  style = "color :white">Forme sportive : <h8 id = "forme_profil" style = "color :white"></h8></h6>
                            <h6  style = "color :white">Note de l'application : <h8 id = "note_profil" style = "color :white"></h8><h8 style = "color :white"> / 5</h8></h6>
                        </div>
                    </div>
                </div>
        </section>

        <br>
        <section class="centrage">
                <div class="mask d-flex align-items-center h-150 gradient-custom-3 mx-2">
                    <div class="container" style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
                        <div class="card-body p-4">
                            <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Modifier vos informations :</h3>
                            <div class="row">
                                <h6 style = "color :white">Age :</h6>
                                <div class="col-12">
                                    <input id="new_age" type="date"> 
                                </div>
                                <br><br>
                                <div class="row">
                                    <p></p>
                                </div>
                                <br><br>
                                <h6 style = "color :white">Ville :</h6>
                                <div class="col-12">
                                    <input class="form-control" type="text" placeholder="" id="new_city">
                                </div>
                                <br><br>
                                <div class="row">
                                    <p></p>
                                </div>
                                <br><br>
                                <h6 style = "color :white">Forme sportive :</h6>
                                <div class="col-12">
                                    <input class="form-control" type="text" placeholder="" id="new_fit_indicator">
                                </div>

                                <br><br>
                                <h6 style = "color :white">Notation de l'application :</h6>
                                <div class="col-12">
                                <select id="new_notation" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value=""> Choisir </option>    
                                    <option value="5">5 ⭐</option>
                                    <option value="4">4 ⭐</option>   
                                    <option value="3">3 ⭐</option>
                                    <option value="2">2 ⭐</option>
                                    <option value="1">1 ⭐</option>
                                    <option value="0">0 ⭐</option>
                                </select>
                                </div>
                                <br>
                                <h6 style = "color :white">Nouveau mot de passe :</h6>
                                <div class="col-12">
                                    <input class="form-control" type="password" placeholder="" id="new_mdp">
                                </div>
                                <br><br>
                                <h6 style = "color :white">Confirmez le mot de passe</h6>
                                <div class="col-12">
                                    <input class="form-control" type="password" placeholder="" id="new_mdp_confirm">
                                </div>
                                <br><br>

        
                                <button id="new_infos_button" class="btn" type="submit" style="color:white; background: #FFA800; margin-left: auto; margin-right: auto;">Modifier</button>
                            </div><div id="error_message"></div>
                        </div>
                    </div>
            </section>


</body>


<footer class="fixed-bottom" style = "background: #FFA800 ; border : 3px solid #FF7A00">
    <div class="container">
        <p class="m-0 text-center text-black">PlayTogether</p>
    </div>
</footer>
<script src="../js/ajax.js"></script>
<script src="../js/listen.js"></script>
<script>ajaxRequest('GET', "../php/request.php/get_info-profil",display_info_profil);</script>

</html>