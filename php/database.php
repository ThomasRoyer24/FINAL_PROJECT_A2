<?php
 include 'constants.php';
 session_start();

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
    
    $id_localisation = get_id_city($db,$city,true,NULL)['id_localisation'];

    if (!$is_registered) {
        try {
            
            $request = "INSERT INTO username (mail, last_name, first_name, id_localisation,password,statistics) VALUES (:mail,:last_name, :first_name,:id_localisation,:password,0)";
            $statement = $db->prepare($request);

            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':last_name', $last_name);
            $statement->bindParam(':first_name', $first_name);
            $statement->bindParam(':id_localisation',$id_localisation);
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

function get_id_city($db,$city,$bool,$adresse){
        try {
            if ($adresse == NULL) {
                $request = "SELECT id_localisation from localisation where city = :city and adresse is null";
                $statement = $db->prepare($request);
            }else{
                $request = "SELECT id_localisation from localisation where city = :city and adresse = :adresse";
                $statement = $db->prepare($request);
                $statement->bindParam(':adresse', $adresse);
            }
            
            $statement->bindParam(':city', $city);
            $statement->execute();  
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            }
            catch (PDOException $exception){
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
    
            if (empty($result) && $bool == true) {
                set_localisation($db,$city,$adresse);
                $result = get_id_city($db,$city,false,$adresse);
            }else if(empty($result) && $bool == false){
                return NULL;
            }
            return $result;
}



function create_match($db,$localisation,$sport,$max_number_players,$min_number_players,$duration,$price,$date_match){
    
    if ($localisation != NULL && $sport!= NULL && $max_number_players!= NULL && $min_number_players != NULL && $duration != NULL && $price != NULL && $date_match != NULL ) {
       
        try {
            $localisation = explode(',', $localisation);
            $city = $localisation[0];
            $adresse = $localisation[1];

            $id_localisation = get_id_city($db,$city,true,$adresse);
            $id_user = 1;
            $request = "INSERT INTO match (id_user,id_localisation,sport,max_number_players,actual_number_players,min_number_players,duration,price,date_match) VALUES(:id_user,:id_localisation,:sport,:max_number_players,0,:min_number_players,:duration,:price,:date_match)";
            $statement = $db->prepare($request);
            $statement->bindParam(':id_localisation', $id_localisation["id_localisation"]);
            $statement->bindParam(':id_user', $id_user);
            $statement->bindParam(':sport', $sport);
            $statement->bindParam(':max_number_players', $max_number_players);
            $statement->bindParam(':min_number_players', $min_number_players);
            $statement->bindParam(':duration', $duration);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':date_match', $date_match);
            $statement->execute();
            


            $response['date'] = $date_match;


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

        // $id_city = get_id_city($db,$city,false,NULL);

        $pourcentage= "%";
        $sport_pourcentage = $sport.$pourcentage;
        $city_pourcentage = $city.$pourcentage;
 
        
        $time_now = time();
        $date_now = date('Y-m-d H:i:s', $time_now);

        $request = "SELECT * FROM match m 
                        LEFT JOIN localisation l ON m.id_localisation = l.id_localisation 
                        WHERE (m.sport like :sport)
                        AND (l.city like :city)
                        AND (:status = (m.max_number_players != m.actual_number_players))
                        AND (:date > m.date_match)
                        AND  (:date_now < m.date_match)";
                        
        $statement = $db->prepare($request);
        $statement->bindParam(':city', $city_pourcentage);
        $statement->bindParam(':sport', $sport_pourcentage);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':date_now',$date_now);
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
        $request = "SELECT id_user FROM username WHERE (mail = :mail)";
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


function set_localisation($db,$city,$adresse){

    try {
        if($adresse != NULL){
            $request = "INSERT INTO localisation (city,adresse) VALUES (:city, :adresse)";
            $statement = $db->prepare($request);
            $statement->bindParam(':adresse', $adresse);
        }
        else{
            $request = "INSERT INTO localisation (city) VALUES (:city)";
            $statement = $db->prepare($request);
        }

        $statement->bindParam(':city', $city);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        // return get_id_city($db,$city,false,$adresse);

}
?>