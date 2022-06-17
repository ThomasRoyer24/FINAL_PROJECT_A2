<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Profil</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg" style = "background: #FFA800 ; border : 3px solid #FF7A00"  >  
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <div style = "margin-left: auto;">
                <a href = "choix.php" class="btn btn-primary" type="submit" style = "color:white;background: #4F5B5E; ">Menu</a>
                <a href = "notifications.php" class="btn btn-primary" type="submit" style = "color:white;background: #4F5B5E; ">Notifications</a>
                <a href = "connexion.php" class="btn btn-primary" type="submit" style = "color:white;background: #4F5B5E; ">Déconnection</a>
            </div>
        </div>
    </nav>
    <br>
    <section class="centrage">
            <div class="mask d-flex align-items-center h-150 gradient-custom-3 mx-2">
                <div class="container" style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
                    <div class="card-body p-4">
                        <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Nom & Prénom</h3>
                        
                        <img class = "displayed" src = "../images/pdp/profilepicture.jpg"style = "display: block; margin-left: auto; margin-right: auto">
                        <h6 style = "color :white">Nombre de maths joués :</h6>
                        <hr>
                        <div class="row">
                            <h6 style = "color :white">Age :</h6>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <h6 style = "color :white">Ville :</h6>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <h6 style = "color :white">Forme sportive :</h6>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="" id="">
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <h6 style = "color :white">Notation de l'application :</h6>
                            <div class="col-12">
                            <select id="match_status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value="0">0 ⭐</option>
                                    <option value="1">1 ⭐</option>
                                    <option value="2">2 ⭐</option>
                                    <option value="3">3 ⭐</option>
                                    <option value="4">4 ⭐</option>
                                    <option value="5">5 ⭐</option>
                                </select>
                            </div>
                            <br>
                            <h6 style = "color :white">Nouveau mot de passe :</h6>
                            <div class="col-12">
                                <input class="form-control" type="password" placeholder="" id="">
                            </div>
                            <h6 style = "color :white">Nouveau mot de passe :</h6>
                            <div class="col-12">
                                <input class="form-control" type="password" placeholder="" id="">
                            </div>
                            <br><br>

    
                            <button id="" class="btn btn-primary" type="submit" style="background: #FFA800; margin-left: auto; margin-right: auto;">Rechercher</button>
                        </div>
                    </div>
                </div>
        </section>


</body>


<footer class="fixed-bottom" style = "background: #FFA800 ; border : 3px solid #FF7A00">
    <div class="container">
        <p class="m-0 text-center text-black">PlayTogether</p>
    </div>
</footer>
    
</html>