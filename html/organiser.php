<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Organiser</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg" style = "background: #FFA800 ; border : 3px solid #FF7A00"  >  
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <div style = "margin-left: auto;">
                <a href = "choix.php" class="btn btn-primary" type="submit" style = "color:white;background: #4F5B5E; ">Menu</a>
                <a href = "stats.php" class="btn btn-primary" type="submit" style = "color:white;background: #4F5B5E; ">Stats</a>
                <a href = "connexion.php" class="btn btn-primary" type="submit" style = "color:white;background: #4F5B5E; ">Déconnection</a>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <section class="centrage">
            <div class="mask d-flex align-items-center h-150 gradient-custom-3 mx-2">
                <div class="container" style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
                    <div class="card-body p-4">
                        <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Créer un match</h3>
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
                                <input class="form-control" type="text" placeholder="Nombre de joueurs min" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Nombre de joueurs max" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br><div class="col-12">
                                <input class="form-control" type="text" placeholder="Adresse" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Ville" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Heure" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Durée" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Prix" id="">
                            </div>
                            <br><br>
                            <div class="row">
                                <p></p>
                            </div>
                            <br><br>

    
                            <button id="search" class="btn btn-primary" type="submit"
                                style="background: #FFA800; margin-left: auto; margin-right: auto;">Rechercher</button>
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