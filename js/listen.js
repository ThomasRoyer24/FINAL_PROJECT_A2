$('#search_id').on('click', () => {

    let mail = document.getElementById('').value; // a remplacer par les id
    let password = document.getElementById('').value;// a remplacer par les id
    ajaxRequest('GET', `request.php/login/?mail=${mail}&password=${password}`, display_connexion);
})

$('#create_account_buttom').on('click', () => {
    let mail = document.getElementById('mail').value;
    let confirm_mail = document.getElementById('confirm_mail').value;

    let first_name = document.getElementById('first_name').value;
    let last_name = document.getElementById('last_name').value;

    let password = document.getElementById('password').value;

    let confirm_password = document.getElementById('confirm_password').value;

    let city = document.getElementById('city').value;

    if ((mail != confirm_mail) || (password != confirm_password) || city == "" || password == "" || first_name == "" || last_name == "" || mail == "") {
        document.getElementById("error_message").innerHTML = "<span class=\"alert alert-danger\" role=\"alert\">adresse mail deja utiliser ou information erroné</span>";
    } else {

        ajaxRequest('POST', "../php/request.php/register", register, `mail=${mail}&password=${password}&first_name=${first_name}&last_name=${last_name}&city=${city}`);
    }
})