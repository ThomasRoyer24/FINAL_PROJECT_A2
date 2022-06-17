
$('#city').on('keyup', () => {

    sport_query = document.getElementById('sport').value;
    city_query = document.getElementById('city').value;
    time_query = document.getElementById('time').value;
    match_status_query = document.getElementById('match_status').value;
    if (sport_query == '' && city_query == '') {
        // document.getElementById('search_result_status').remove()
    } else {
        ajaxRequest('GET', `../php/request.php/search/?sport=${sport_query}&city=${city_query}&time=${time_query}&match_status=${match_status_query}`, displaySearch);
    }
})

$('#sport').on('keyup', () => {
    sport_query = document.getElementById('sport').value;
    city_query = document.getElementById('city').value;
    time_query = document.getElementById('time').value;
    match_status_query = document.getElementById('match_status').value;

    if (sport_query == '' && city_query == '') {
        // document.getElementById('search_result_status').remove()
    } else {
        ajaxRequest('GET', `../php/request.php/search/?sport=${sport_query}&city=${city_query}&time=${time_query}&match_status=${match_status_query}`, displaySearch);
    }
})

$('#match_status').on('change', () => {
    sport_query = document.getElementById('sport').value;
    city_query = document.getElementById('city').value;
    time_query = document.getElementById('time').value;
    match_status_query = document.getElementById('match_status').value;

    if (sport_query == '' && city_query == '') {
        // document.getElementById('search_result_status').remove()
    } else {
        ajaxRequest('GET', `../php/request.php/search/?sport=${sport_query}&city=${city_query}&time=${time_query}&match_status=${match_status_query}`, displaySearch);
    }
})

$('#time').on('change', () => {
    sport_query = document.getElementById('sport').value;
    city_query = document.getElementById('city').value;
    time_query = document.getElementById('time').value;
    match_status_query = document.getElementById('match_status').value;

    if (sport_query == '' && city_query == '') {
        // document.getElementById('search_result_status').remove()
    } else {
        ajaxRequest('GET', `../php/request.php/search/?sport=${sport_query}&city=${city_query}&time=${time_query}&match_status=${match_status_query}`, displaySearch);
    }
})
