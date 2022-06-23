//------------------------------------------------------------------------------
//--- ajaxRequest --------------------------------------------------------------
//------------------------------------------------------------------------------
// Perform an Ajax request.
// \param type The type of the request (GET, DELETE, POST, PUT).
// \param url The url with the data.
// \param callback The callback to call where the request is successful.
// \param data The data associated with the request.
function ajaxRequest(type, url, callback, data = null) {
    // console.log(url);
    let xhr;
    // Create XML HTTP request.
    xhr = new XMLHttpRequest();
    xhr.open(type, url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Add the onload function.
    xhr.onload = () => {
        switch (xhr.status) {
            case 200:
            case 201:
                if (callback != undefined) {
                    callback(JSON.parse(xhr.responseText));
                }
                break;
            default:
                httpErrors(xhr.status);
        }
    };

    // Send XML HTTP request.
    xhr.send(data);
}

//------------------------------------------------------------------------------
//--- httpErrors ---------------------------------------------------------------
//------------------------------------------------------------------------------
// Display an error message accordingly to an error code.
// \param errorCode The error code (HTTP status for example).
function httpErrors(errorCode) {
    let messages = {
        400: 'Requête incorrecte',
        401: 'Authentifiez vous',
        403: 'Accès refusé',
        404: 'Page non trouvée',
        500: 'Erreur interne du serveur',
        503: 'Service indisponible'
    };

    // Display error.
    if (errorCode in messages) {
        $('#errors').html('<strong>' + messages[errorCode] + '</strong>');
        $('#errors').show();
        setTimeout(() => {
            $('#errors').hide();
        }, 5000);
    }
}

function register(output) {
    if (output['isSuccess'] == true) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-success\" role=\"alert\">" + output['message'] + "</span>";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">" + output['message'] + "</span>";
    }
}

function display_connexion(output) {
    if (output['isSuccess'] == true) {
        document.location.href = "../html/choix.php";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">" + output['error_message'] + "</span>";
    }
}


function create_match(output) {
    if (output['isSuccess'] == true) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-success\" role=\"alert\">" + output['message'] + "</span>";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">" + output['message'] + "</span>";
    }
}


function generate_input_date(bool) {
    var date = new Date();
    if (bool == true) {

        if (date.getDate() + 2 > 30) {
            var plus_time = -date.getDate() + 1;
            var plus_month = 1;
        } else {
            var plus_time = 2;
            var plus_month = 0;
        }


        $output_date = document.getElementById('date_hours');

        var dateStr = date.getFullYear() + "-" + ("00" + (date.getMonth() + 1 + plus_month)).slice(-2) + "-" + ("00" + (date.getDate() + plus_time)).slice(-2) + "T" + ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00");
        $output_date.value = dateStr;
        $output_date.min = dateStr;
    } else {
        let text = 'plus_';



        let tab = [7, 15, 30];

        tab.forEach(element => {
            let new_text = text + element.toString();
            if (date.getDate() + element > 30) {
                var plus_time = element - 30;
                var plus_month = 1;
            } else {
                var plus_time = element;
                var plus_month = 0;
            }
            var dateStr = date.getFullYear() + "-" + ("00" + (date.getMonth() + 1 + plus_month)).slice(-2) + "-" + ("00" + (date.getDate() + plus_time)).slice(-2) + "T" + ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00");
            document.getElementById(new_text).value = dateStr;
        });



    }
}


function viewinfos() {
    document.location.href = "../html/infos.php";
}

function displaySearch(output) {

    $table = document.getElementById('tableau_match');
    $table.innerHTML = "<tr><th>Sport</th><th>Ville</th><th>Joueurs Max</th><th>Inscrits</th><th>Date</th><th></th></tr>";
    output.forEach(element => {

        let redirection_btn = document.createElement('button');
        redirection_btn.innerHTML = "+";
        redirection_btn.style = "color:white;background: #FFA800; border-radius: 10px";

        redirection_btn.className = "btn mx-1";
        redirection_btn.setAttribute('onclick', 'redirection(' + element['id_match'] + ')');



        $table.innerHTML += "<tr><td>" + element['sport'] + "</td><td>" + element['city'] + "</td><td>" + element['max_number_players'] + "</td><td>" + element['actual_number_players'] + "</td><td>" + element['date_match'] + "</td><td>" + redirection_btn.outerHTML + "</td></tr>";


    });

}

function redirection(id) {

    ajaxRequest('GET', `../php/request.php/infos_match/?id_match=${id}`, viewinfos);
}

function display_info_match(output) {
    document.getElementById('sport').innerHTML += output['sport'];
    document.getElementById('ville').innerHTML += output['city'];
    document.getElementById('date').innerHTML += output['date_match'];
    document.getElementById('adresse').innerHTML += output['adresse'];
    document.getElementById('prix').innerHTML += " " + output['price'] + " €";
    document.getElementById('admin').innerHTML += output['first_name'] + " " + output['last_name'];
}

function inscription_match(output) {
    if (output['isSuccess'] == true) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-success\" role=\"alert\">" + output['message'] + "</span>";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">" + output['message'] + "</span>";
    }
}

function display_notification(output) {
    $table = document.getElementById('tableau');
    $table.innerHTML = "<tr><th>Prénom</th><th>Nom</th><th>Horaire</th><th>Lieu</th><th></th><th></th></tr>";
    output.forEach(element => {

        let add_btn = document.createElement('button');
        add_btn.innerHTML = "+";
        add_btn.style = "color:white;background: #FFA800; border-radius: 10px";

        add_btn.className = "btn mx-1";
        add_btn.setAttribute('onclick', 'add(' + element['id_user'] + "," + element['id_match'] + ')');

        let delete_btn = document.createElement('button');
        delete_btn.innerHTML = " - ";
        delete_btn.style = "color:white;background: #FFA800; border-radius: 10px";

        delete_btn.className = "btn mx-1";
        delete_btn.setAttribute('onclick', 'dont_add(' + element['id_user'] + "," + element['id_match'] + ')');

        $table.innerHTML += "<tr><td>" + element['first_name'] + "</td><td>" + element['last_name'] + "</td><td>" + element['date_match'] + "</td><td>" + element['city'] + ", " + element['adresse'] + "</td><td>" + add_btn.outerHTML + "</td><td>" + delete_btn.outerHTML + "</td></tr>";


    });
}

function add(id_user, id_match) {
    ajaxRequest('PUT', '../php/request.php/add', undefined, `id_user=${id_user}&id_match=${id_match}`);
    ajaxRequest('GET', "../php/request.php/notification_validation", display_notification);
}

function dont_add(id_user, id_match) {
    ajaxRequest('PUT', '../php/request.php/dont_add', undefined, `id_user=${id_user}&id_match=${id_match}`);
    ajaxRequest('GET', "../php/request.php/notification_validation", display_notification);
}

function display_futur_match(output) {
    console.log(output);
    $table = document.getElementById('table_futur');
    $table.innerHTML = "<tr><th>Sport</th><th>Lieu</th><th>Date</th><th>Organisateur ?</th><th>Joueur ?</th></tr>";
    output.forEach(element => {
        if (element['id_admin'] == element['id_actual_user']) {
            var organisateur = "Oui";
        } else {
            var organisateur = "Non";
        }
        if (element['id_user'] == element['id_actual_user']) {
            var joueur = "Oui";
        }
        else {
            var joueur = "Non";
        }
        $table.innerHTML += "<tr><td>" + element['sport'] + "</td><td>" + element['city'] + ", " + element['adresse'] + "</td><td>" + element['date_match'] + "</td><td>" + organisateur + "</td><td>" + joueur + "</td></tr>";


    });
}


function display_past_match(output) {
    $table = document.getElementById('table_past');
    $table.innerHTML = "<tr><th>Sport</th><th>Score</th><th>Meilleur joueur</th><th>Lieu</th><th>Date</th><th>Organisateur ?</th><th>Joueur ?</th></tr>";
    output.forEach(element => {
        $table.innerHTML += "";
    });
}

function display_info_profil(output) {
    document.getElementById('match_profil').innerHTML = output['statistics'];
    document.getElementById('nom_profil').innerHTML = output['last_name'];
    document.getElementById('prenom_profil').innerHTML = output['first_name'];
    document.getElementById('age_profil').innerHTML = output['birth_date'];
    document.getElementById('ville_profil').innerHTML = output['city'];
    document.getElementById('forme_profil').innerHTML = output['sports_form'];
    document.getElementById('note_profil').innerHTML = output['rating'];
}

function modif_mdp(output) {
    if (output['isSuccess'] == true) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-success\" role=\"alert\">" + output['message'] + "</span>";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">" + output['message'] + "</span>";
    }
}