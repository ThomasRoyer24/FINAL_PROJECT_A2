<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Inscriptions</title>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"
        integrity="sha256-x3YZWtRjM8bJqf48dFAv/qmgL68SI4jqNWeSLMZaMGA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>

</head>


<body>
    <nav class="navbar navbar-expand-lg" style="background: #FFA800 ; border : 3px solid #FF7A00">
        <div class="container-fluid">
            <img src="../images/coupe.png" width="4%" height="100%">
            <button class="btn btn-primary" type="submit" style = "background: #4F5B5E; margin-left: auto; ">Se connecter</button>
        </div>
    </nav>

    <br>
    <section class="centrage">
        <div class="mask d-flex align-items-center h-150 gradient-custom-3">
            <div class="container"
                style="border-radius: 10px; background-color: #4F5B5E; top : 50px; margin-left: auto; margin-right: auto;">
                <div class="card-body p-4">
                    <h3 class="text-uppercase text-center mb-5" style="color: #FFFFFF;">Inscriptions :</h3>
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="text" placeholder="Prénom" id="first_name">
                        </div>
                        <div class="col-6">
                            <input class="form-control" type="text" placeholder="Nom" id="last_name">
                        </div>
                        <div class="row">
                            <p></p>
                        </div>
                        <br><br>
                        <div class="col-12">
                            <input class="form-control" type="text" placeholder="Ville" id="city">
                        </div>
                        <br><br>
                        <div class="row">
                            <p></p>
                        </div>
                        <br><br>
                        <div class="col-6">
                            <input class="form-control" type="text" placeholder="Email" id="mail">
                        </div>
                        <div class="col-6">
                            <input class="form-control" type="text" placeholder="Confirmation Email" id="confirm_mail">
                        </div>
                        <br><br>
                        <div class="col-6">
                            <input class="form-control" type="password" placeholder="Mot de passe" id="password">
                        </div>
                        <div class="col-6">
                            <input class="form-control" type="password" placeholder="Confirmation mot de passe" id="confirm_password">
                        </div>
                        <br><br>
                        <button id="create_account_buttom" class="btn btn-primary" type="submit"
                            style="background: #FFA800; margin-left: auto; margin-right: auto;">Je m'inscris</button>
                    </div>
                    <br>
                    <div id="error_message"></div>


                </div>
            </div>
    </section>





</body>
<footer class="fixed-bottom" style="background: #FFA800 ; border : 3px solid #FF7A00">
    <div class="container">
        <p class="m-0 text-center text-black">PlayTogether</p>
    </div>
</footer>

<script src="../js/ajax.js"></script>
<script src="../js/listen.js"></script>

</html>