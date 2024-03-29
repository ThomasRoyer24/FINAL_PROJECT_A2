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

function add_user($db,$mail,$last_name,$first_name,$city,$password,$path){
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
            
            $request = "INSERT INTO username (mail, last_name, first_name, id_localisation,password,statistics,paths) VALUES (:mail,:last_name, :first_name,:id_localisation,:password,0,:path)";
            $statement = $db->prepare($request);

            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':last_name', $last_name);
            $statement->bindParam(':first_name', $first_name);
            $statement->bindParam(':id_localisation',$id_localisation);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':path', $path);
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

function get_informations_match($db,$id){
    try {
        $request = "SELECT match.sport, match.date_match, match.price, localisation.city, localisation.adresse, username.first_name, username.last_name FROM match, localisation, username WHERE ( match.id_localisation = localisation.id_localisation and match.id_user = username.id_user and id_match = :id)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }

        return $result;
}


function inscription_match($db,$id){
    $id_user = $_SESSION['id_user'];
    try {
        $request = "SELECT max_number_players, actual_number_players FROM match WHERE (id_match = :id_match)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_match', $id);
        $statement->execute();
        $resulte = $statement->fetch(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        try {
            $request = "SELECT * FROM participer WHERE (id_match = :id_match and id_user = :id_user)";
            $statement = $db->prepare($request);
            $statement->bindParam(':id_match', $id);
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $resp = $statement->fetch(PDO::FETCH_ASSOC);
        
            }
            catch (PDOException $exception){
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            if ($resp != NULL) {
                $result['isSuccess'] = false;
                $result['message'] = "Vous ete déjà inscrit à ce match";
                return $result;
            }

        if (($resulte['max_number_players'] != $resulte['actual_number_players'])&& $resp == NULL) {
            try {
                    
                    $request = "INSERT INTO participer VALUES (:id_match,:id_user,false,false,0)";
                    $statement = $db->prepare($request);
                    $statement->bindParam(':id_match', $id);
                    $statement->bindParam(':id_user', $id_user);
                    $statement->execute();

                    }
                    catch (PDOException $exception){
                        error_log('Request error: '.$exception->getMessage());
                        return false;
                    }
                    $result['isSuccess'] = true;
                    $result['message'] = "Votre demande d'inscription a bien été prise en compte";
                    
                }else{
                    $result['isSuccess'] = false;
                    $result['message'] = "il n'y a plus de place disponible pour ce match";
                }

    
        return $result;
}

function get_id_user_from_match($db,$id_match){
    try {
        $request = "SELECT id_user FROM match WHERE (id_match = :id_match)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_match', $id_match);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    
        return $result;
}


function get_notification($db,$id_user){
    try {
        $request = "SELECT m.id_match, u.id_user, u.first_name , u.last_name, m.date_match,l.city,l.adresse FROM participer p LEFT JOIN match m ON m.id_match = p.id_match LEFT JOIN username u ON p.id_user = u.id_user LEFT JOIN localisation l ON l.id_localisation = m.id_localisation  WHERE (m.id_user = :id_user and p.ischeck = false)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    
        return $result;
}

function add_user_match($db,$id_user,$id_match){
    try {
        $request = "UPDATE participer SET ischeck = true,confirmation = true WHERE (id_user = :id_user AND id_match = :id_match) ";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':id_match', $id_match);
        $statement->execute();
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
}

function dont_add_user_match($db,$id_user,$id_match){
    try {
    $request = "UPDATE participer SET ischeck = true,confirmation = false WHERE (id_user = :id_user AND id_match = :id_match) ";
    $statement = $db->prepare($request);
    $statement->bindParam(':id_user', $id_user);
    $statement->bindParam(':id_match', $id_match);
    $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
}

function update_statistique($db,$id_user){
    try {
        $request = "UPDATE username SET statistics = statistics + 1  WHERE (id_user = :id_user) ";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
}

function get_future_match($db,$id_user){
    $time_now = time();
    $date_now = date('Y-m-d H:i:s', $time_now);

    try {
        $request = "SELECT *, m.id_user as id_admin ,p.id_user as id_actual_user FROM match m LEFT JOIN participer p  ON m.id_match = p.id_match LEFT JOIN localisation l ON l.id_localisation = m.id_localisation  WHERE (p.id_user = :id_user AND p.confirmation = true AND m.date_match >  :date_now)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':date_now', $date_now);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        return $result;
}

function get_past_match($db,$id_user){
    $time_now = time();
    $date_now = date('Y-m-d H:i:s', $time_now);

    try {
        $request = "SELECT *, m.id_user as id_admin ,p.id_user as id_actual_user FROM match m LEFT JOIN participer p ON m.id_match = p.id_match LEFT JOIN localisation l ON l.id_localisation = m.id_localisation  WHERE (p.id_user = :id_user AND p.confirmation = true AND m.date_match <  :date_now)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':date_now', $date_now);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        return $result;
}

function get_informations_profil($db,$id){
    try {
        $request = "SELECT username.paths, username.statistics, username.last_name, username.first_name, username.birth_date, localisation.city, username.sports_form, username.rating FROM username, localisation WHERE (username.id_user=:id and username.id_localisation=localisation.id_localisation)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }

        return $result;
}



//Fonctions de modifications, appelés indépendament selon les infos qui sont complétés
//Age
function modif_age($db,$id,$birthdate){
    try {
        $request = "UPDATE username SET birth_date = :birth_date WHERE id_user = :id";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':birth_date', $birthdate);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

}

//Ville
function modif_city($db,$id,$ville){
    try {
        $request = "UPDATE localisation AS loc SET city =:city FROM username AS use WHERE loc.id_localisation = use.id_localisation and use.id_user=:id";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':city', $ville);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

}

//Forme sportive
function modif_sportsform($db,$id,$sportsform){ 
    try {
    $request = "UPDATE username SET sports_form=:sports_form WHERE id_user = :id";
    $statement = $db->prepare($request);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':sports_form', $sportsform);
    $statement->execute();
}
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

}

//Note de l'app
function modif_rating($db,$id,$note){
    try {
    $request = "UPDATE username SET rating = :rating WHERE id_user = :id";
    $statement = $db->prepare($request);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':rating', $note);
    $statement->execute();

}
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

}

//MDP
function modif_mdp($db,$id,$newmdp,$confirm_newmdp){
    if ($confirm_newmdp != $newmdp) {
        $result['isSuccess'] = false;
        $result['message'] = "Mots de passe différents";
        return $result;
    }
    try {

    $request = "UPDATE username SET password= :password WHERE id_user = :id";
    $statement = $db->prepare($request);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':password', $newmdp);
    $statement->execute();

    $result['isSuccess'] = true;
    $result['message'] = "Votre mot de passe a bien été modifié";
}
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

    return $result;
}


function get_inscriptions($db,$id){
    try {
        $request = "SELECT match.sport, localisation.city, match.date_match,  participer.confirmation, participer.ischeck FROM match, localisation, participer WHERE (match.id_user=:id and match.id_localisation=localisation.id_localisation and participer.id_match = match.id_match)";
        $statement = $db->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }

        return $result;
}

?>
