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
            echo json_encode($response['isSuccess']);
        }
    }

    if($requestMethod == 'GET' and $requestRessource == 'login'){
            $mail = $_GET['mail'];
            $password = $_GET['password'];
            $responce = request_connection($db,$mail,$password);
            $_SESSION['mail'] = $mail;
            echo json_encode($responce);           
    }

    if ($requestMethod == 'GET' and $requestRessource == 'search') {
        //gestion timestant
        $date = time();
        $date += $_GET['time']*86400;
        $city = $_GET['city'];
        $sport = $_GET['sport'];
        $status = $_GET['match_status'];
        $responce = search_match($db,$city,$sport,$date,$status);
        echo json_encode($responce);
    }
?>