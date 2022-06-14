<?php
 include 'constants.php';


function dbConnect(){
    $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
    $user = DB_USER;
    $password = DB_PASSWORD;
    try {
        $conn = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
return $conn;
}

//** Function that check if a user can connect on the website through database */
//** Args => User Mail ($mail) | User Password ($password) */

function request_connection($db,$mail,$password){
    try {

    $request = "SELECT username.mail, username.password FROM username WHERE (username.mail = :mail AND username.password = :password)";
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

    return !empty($result) ? true : false;
}


//** Function that check if a professional can connect on the website through database */
//** Args => Professional Mail ($mail) | Professional Password ($password) */

function request_connection_professional($db,$mail,$password){
    try {

    $request = "SELECT professional.mail, professional.password FROM professional WHERE (professional.mail = :mail AND professional.password = :password)";
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

    return !empty($result) ? true : false;
}

//** Function that add a user to the database */
//** Args => Mail | Last_name | first_name | city | Password */

function add_user($db,$mail,$last_name,$first_name,$city,$password){
    $response = array();
    try {
        $is_registered = false;
        $request = "SELECT username.mail FROM username WHERE (username.mail = :mail)";    
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        #error_log('Request error: '.$exception->getMessage());
        $response['error'] = $exception->getMessage();
        $response['isSuccess'] = false;
        return $response;
    }
    if(!empty($result)){
        
        $is_registered = true;
    }
    
    if (!$is_registered) {
        try {
            $request = "INSERT INTO username (mail, last_name, first_name, city,password) VALUES (:mail,:name, :prename,:city,:password)";
            $statement = $db->prepare($request);

            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':name', $last_name);
            $statement->bindParam(':prename', $first_name);
            $statement->bindParam(':city', $city);
            $statement->bindParam(':password', $password);

            $statement->execute();
            $response['isSuccess'] = true;
            $response['id'] = $mail;
            return $response;
        }
        catch (PDOException $exception){
            #error_log('Request error: '.$exception->getMessage());
            $response['error'] = $exception->getMessage();
            $response['isSuccess'] = false;
            return $response;
        }
    }else {
        $response['error'] = "This email address is already in use";
        $response['isSuccess'] = false;
        return $response;
  }
}

?>