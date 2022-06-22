$('#connexion_buttom').on('click', () => {

    let mail = document.getElementById('mail').value; // a remplacer par les id
    let password = document.getElementById('password').value;// a remplacer par les id
    ajaxRequest('GET', `../php/request.php/login/?mail=${mail}&password=${password}`, display_connexion);
})

$('#create_account_buttom').on('click', () => {

    //recuperation des valeur d'input
    let mail = document.getElementById('mail').value;
    let confirm_mail = document.getElementById('confirm_mail').value;
    let first_name = document.getElementById('first_name').value;
    let last_name = document.getElementById('last_name').value;
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;
    let city = document.getElementById('city_inscription').value;

    // recherche d'erreur et sinon requette ajax POST avec de la data 
    if ((mail != confirm_mail)) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">Votre adresse mail mal écrite</span>";
    } else if (password != confirm_password) {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">Les mots de passe ne correspondent pas</span>";
    } else if ((mail != confirm_mail) || (password != confirm_password) || city == "" || password == "" || first_name == "" || last_name == "" || mail == "") {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">Votre adresse mail deja utilisée ou information erronée</span>";
    } else {
        ajaxRequest('POST', "../php/request.php/register", register, `mail=${mail}&password=${password}&first_name=${first_name}&last_name=${last_name}&city=${city}`);
    }
})


// create match listen on buttom

$('#create_match').on('click', () => {
    let localisation = document.getElementById('city').value;
    let min_number_players = document.getElementById('min_number_players').value;
    let max_number_players = document.getElementById('max_number_players').value;
    let date_hours = document.getElementById('date_hours').value;
    let duration = document.getElementById('duration').value;
    let price = document.getElementById('price').value;
    let sport = document.getElementById('sport').value;
    ajaxRequest('POST', "../php/request.php/create_match", create_match, `sport=${sport}&localisation=${localisation}&min_number_players=${min_number_players}&max_number_players=${max_number_players}&date_hours=${date_hours}&duration=${duration}&price=${price}`);
})



