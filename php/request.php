<?php
  require_once('database.php');
  session_start();
  // Enable all warnings and errors.
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

    // Database connexion.
    $db = dbConnect();

    // Check the request.
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $requestRessource = array_shift($request);

    if ($requestMethod == 'POST' and $requestRessource == 'register') {
        if($_POST['first_name'] != NULL && $_POST['last_name']!=NULL && $_POST['city'] != NULL && $_POST['mail'] != NULL && $_POST['password'] != NULL){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $city = $_POST['city'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $response = add_user($db,$mail,$last_name,$first_name,$city,$password);
            echo json_encode($response);
        }
    }

    if($requestMethod == 'GET' and $requestRessource == 'login'){
            $mail = $_GET['mail'];
            $password = $_GET['password'];
            $response = request_connection($db,$mail,$password);
            $_SESSION['id_user'] = get_id_user($db,$mail)["id_user"];
            echo json_encode($response);           
    }

    if ($requestMethod == 'GET' and $requestRessource == 'search') {
        //gestion timestant
        
        $date = $_GET['time'];
        $city = $_GET['city'];
        $sport = $_GET['sport'];
        $status = $_GET['match_status'];
        $response = search_match($db,$city,$sport,$date,$status);
        echo json_encode($response);
    }

    if ($requestMethod == 'POST' and $requestRessource == 'create_match') {
        $localisation = $_POST['localisation'];
        $sport = $_POST['sport'];
        $min_number_players = $_POST['min_number_players'];
        $max_number_players = $_POST['max_number_players'];
        $date_hours = $_POST['date_hours'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

        $response = create_match($db,$localisation,$sport,$max_number_players,$min_number_players,$duration,$price,$date_hours);
        echo json_encode($response);
    }

    if($requestMethod == 'GET' and $requestRessource == "infos_match"){
        $id_match = $_GET['id_match'];
        $_SESSION["id_match"] = $id_match;
        echo json_encode(NULL);
    }

    if($requestMethod == 'GET' and $requestRessource == "get_info-match"){
        $id_match = $_SESSION["id_match"];
        $response = get_informations_match($db,$id_match);
        echo json_encode($response);
    }

    if($requestMethod == 'POST' and $requestRessource == "inscription_match"){
        $id_match = $_SESSION["id_match"];
        $response = inscription_match($db,$id_match);
        echo json_encode($response);
    }

    if($requestMethod == 'GET' and $requestRessource == "notification_validation"){
        $id_user = $_SESSION["id_user"];
        $response = get_notification($db,$id_user);
        echo json_encode($response);
    }
    if($requestMethod == 'PUT' and $requestRessource == "add"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id_user = $_PUT['id_user'];
        $id_match = $_PUT['id_match'];
        $response = add_user_match($db,$id_user,$id_match);
    }
    if($requestMethod == 'PUT' and $requestRessource == "dont_add"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id_user = $_PUT['id_user'];
        $id_match = $_PUT['id_match'];
        $response = dont_add_user_match($db,$id_user,$id_match);
    }
    if($requestMethod == 'PUT' and $requestRessource == "update_stat"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id_user = $_PUT['id_user'];
        $response = update_statistique($db,$id_user);
    }
    if($requestMethod == 'GET' and $requestRessource == "futur_match"){

        $id_user = $_SESSION['id_user'];
        $response = get_future_match($db,$id_user);
        echo json_encode($response);
    }
    if($requestMethod == 'GET' and $requestRessource == "past_match"){

        $id_user = $_SESSION['id_user'];
        $response = get_past_match($db,$id_user);
       echo json_encode($response);
    }

    //Modifications compte

    if($requestMethod == 'PUT' and $requestRessource == "modif_age"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id = $_SESSION['id_user'];
        $age = $_PUT['age'];
        $response = modif_age($db,$id,$age);
        echo json_encode($response);
    }


    if($requestMethod == 'PUT' and $requestRessource == "modif_city"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id = $_SESSION['id_user'];
        $city = $_PUT['ville'];
        $response = modif_city($db,$id,$city);
        echo json_encode($response);
    }

    if($requestMethod == 'PUT' and $requestRessource == "modif_sportsform"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id = $_SESSION['id_user'];
        $sportsform = $_PUT['formesportive'];
        $response = modif_sportsform($db,$id,$sportsform);
        echo json_encode($response);
    }


    if($requestMethod == 'PUT' and $requestRessource == "modif_rating"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id = $_SESSION['id_user'];
        $rating = $_PUT['notation'];
        $response = modif_rating($db,$id,$rating);
        echo json_encode($response);
    }

    if($requestMethod == 'PUT' and $requestRessource == "modif_mdp"){
        parse_str(file_get_contents('php://input'), $_PUT);
        $id = $_SESSION['id_user'];
        $mdp = $_PUT['newmdp'];
        $confirm = $_PUT['confirm_newmdp'];
        $response = modif_mdp($db,$id,$mdp,$confirm);
        echo json_encode($response);
    }
    if($requestMethod == 'GET' and $requestRessource == "get_info-profil"){
        $id_user = $_SESSION["id_user"];
        $response = get_informations_profil($db,$id_user);
        echo json_encode($response);
    }
    // fin modification compte

    if($requestMethod == 'GET' and $requestRessource == "notification_inscription"){
        $id_user = $_SESSION["id_user"];
        $response = get_inscriptions($db,$id_user);
        echo json_encode($response);
    }
?>