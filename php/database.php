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

    $request = "SELECT username.mail FROM username WHERE (username.mail = :mail AND username.password = :password)";
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
    if (empty($result)) {
       $responce['isSuccess'] = false;
       $responce['error_message'] = "L'adresse mail ou le mot de passe est incorrect";
    }else{
        $responce['isSuccess'] = true;
    }
    return $responce;
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
    
    $id_city = get_id_city($db,$city,true)['id_city'];

    if (!$is_registered) {
        try {
            
            $request = "INSERT INTO username (mail, last_name, first_name, id_city,password,statistics) VALUES (:mail,:last_name, :first_name,:id_city,:password,0)";
            $statement = $db->prepare($request);

            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':last_name', $last_name);
            $statement->bindParam(':first_name', $first_name);
            $statement->bindParam(':id_city',$id_city);
            $statement->bindParam(':password', $password);
            $statement->execute();
            $response['isSuccess'] = true;
            $response['message'] = "Votre compte à bien été crée";
            
            return $response;
        }
        catch (PDOException $exception){
            #error_log('Request error: '.$exception->getMessage());
            $response['error'] = $exception->getMessage();
            $response['isSuccess'] = false;
            return $response;
        }
    }else {
        $response['message'] = "This email address is already in use";
        $response['isSuccess'] = false;
        return $response;
  }
}

function get_id_city($db,$name,$bool){
    try {

        $request = "SELECT id_city from city where name = :name";
        $statement = $db->prepare($request);
        $statement->bindParam(':name', $name);
        $statement->execute();  
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }

        if (empty($result) && $bool == true) {
            set_city($db,$name);
            $result = get_id_city($db,$name,false);
        }else if(empty($result) && $bool == false){
            return NULL;
        }
            return $result;
        
}

function set_city($db,$name){
    try {

        $request = "INSERT INTO city (name) VALUES (:name)";
        $statement = $db->prepare($request);
        $statement->bindParam(':name', $name);
        $statement->execute();  
        
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
}

function update_stat_user($db,$id){
    try {

        $request = "UPDATE username SET statistics = statistics+1 WHERE (id.username = :id)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
}

function create_match($db,$city,$sport,$max_number_players,$min_number_players,$duration,$price,$date_match){
    
    if ($city != NULL && $sport!= NULL && $max_number_players!= NULL && $min_number_players != NULL && $duration != NULL && $price != NULL && $date_match != NULL ) {
       
        try {
            $id_city = get_id_city($db,$city,true);
            $id_user = $_SESSION['id_user'];
            $request = "INSERT INTO match (id_user,id_city,sport,sport,actual_number_players,min_number_players,duration,price,date_match) VALUES(:id_user,:city,:sport,:max_number_player,0,:min_number_players,:duration,:date_match)";
            $statement = $db->prepare($request);
            $statement->bindParam(':city', $id_city);
            $statement->bindParam(':id_user', $id_user);
            $statement->bindParam(':sport', $sport);
            $statement->bindParam(':max_number_players', $max_number_players);
            $statement->bindParam(':min_number_players', $min_number_players);
            $statement->bindParam(':duration', $duration);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':date_match', $date_match);
            $statement->execute();
            
            $response['isSuccess'] = true;
            $response['message'] = "Votre match à bien été crée";
            }
            catch (PDOException $exception){
                error_log('Request error: '.$exception->getMessage());
                return false;
        }
    }else{
        $response['isSuccess'] = false;
        $response['message'] = "il manque des informations pour créé votre match";
    }
    return $response;
}

function get_information_user($db,$id){
    try {
        $request = "SELECT first_name,last_name, sports_form, rating,statistic , name.city, password   FROM username, city WHERE (id_city.username == id_city.city and id_user.username = :id)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    
        return !empty($result) ? true : false;
}

function search_match($db,$city,$sport,$date,$status){
    try {

        $id_city = get_id_city($db,$city,false);

        $request = "SELECT * FROM match WHERE (:city like id_city and :sport like sport and :date <= date_match and :status == (max_number_players == actual_number_players))";
        $statement = $db->prepare($request);
        $statement->bindParam(':city', $id_city);
        $statement->bindParam(':sport', $sport);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':status', $status);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    
        return $result;
}

function get_id_user($db,$mail){
    try {
        $request = "SELECT id_user FROM username WHERE (:mail = mail)";
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    
        return $result;
}

// $request = "azert, tyui";
// $request = explode(',', $request);
// $requestRessource = array_shift($request);

// echo $request[0];

?>