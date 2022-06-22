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