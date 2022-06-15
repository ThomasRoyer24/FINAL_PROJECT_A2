$('#search_id').on('click', () => {

    let mail = document.getElementById('').value; // a remplacer par les id
    let password = document.getElementById('').value;// a remplacer par les id
    ajaxRequest('GET', `request.php/login/?mail=${mail}&password=${password}`, display_connexion);
})