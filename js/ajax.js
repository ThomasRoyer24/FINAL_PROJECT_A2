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

function display_connexion(output) {
    console.log(output);
    // let mail = document.getElementById('form3Example3cg').value;
    // if (output == false) {
    //     document.getElementById('login_failed').innerHTML = "Failed at login..."
    // } else {
    //     // document.location.href = "";
    // }

}

function register(output) {
    if (output == true) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-success\" role=\"alert\">Votre compte à bien été crée</span>";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">L'adresse mail est déjà utilisée</span>";
    }
}

function display_connexion(output) {
    if (output == true) {
        document.location.href = "../html/choix.html";
    } else {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">L'adresse mail ou le mot de passe est incorrect</span>";
    }
}