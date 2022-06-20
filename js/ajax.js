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
function displaySearch(output) {
    console.log(output)
}

function create_match(output) {
    if (output['isSuccess'] == true) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-success\" role=\"alert\">" + output['message'] + "</span>";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">" + output['message'] + "</span>";
    }
}

function generate_input_date() {

    $div = document.getElementById('date_hours');
    var date = new Date();
    var dateStr = date.getFullYear() + "-" + ("00" + (date.getMonth() + 1)).slice(-2) + "-" + ("00" + (date.getDate() + 1)).slice(-2) + "T" + ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00");
    $div.value = dateStr;
    $div.min = dateStr;
}


function viewinfos() {
    document.location.href = "../html/infos.php";
}