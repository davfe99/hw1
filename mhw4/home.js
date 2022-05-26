function onResponse(response) {
    if (response.status == 200) {
        return response.json();
    }
}
function onError(error) {
    console.log('Error: ' + error);
}

// API CON KEY

let form = document.getElementById("myForm");
if (form){
    form.addEventListener('submit', handleForm);
}
function handleForm(event) {
    event.preventDefault();
    nasa()
}

function nasa () {

    const date = document.getElementById('date');
    console.log(date.value)

    const key = "U0PqJ5UprbVQExkXc7ZgsGVfIM7Z1O8Uiv7g2hOO";
    const url = `https://api.nasa.gov/planetary/apod?date=${date.value}&api_key=${key}`;
    console.log(url);

    fetch("fetch_api.php?url="+encodeURIComponent(url) + "&type="+encodeURIComponent('nasa'))
        .then(onResponse, onError)
        .then(onJson);

    function onJson(json) {
        console.log(json);
        document.getElementById("title_1").textContent = json.title;
        document.getElementById("pic").src = json.hdurl;
        document.getElementById("explanation").textContent = json.explanation;
    }
}

// UPLOAD POST

function up_onResponse(response) {
    if(!response.ok) {
        return null;
    }
    console.log(response);
}

function databaseResponse(json) {
    if (!json.ok) {
        return null;
    }
    console.log(json);
}

function up_post(){
    
    let comm = document.getElementById('comment').value;
    let img = document.getElementById('pic').src;

    let formData = new FormData();
    formData.append('comment', comm);
    formData.append('src', img);

    fetch("up_post.php", {method: 'post', body: formData}).then(up_onResponse);
}

document.getElementById('upload').addEventListener('click', up_post);


















//API CON KEY oAuth

const endpoint_gif = 'http://api.giphy.com/v1/gifs/search' ;
const k_gif = 'mAvCsm3x3r5UhimJjQvAbWmHVSf8Uomb';

const key_oauth = '7enQNVqjn3UjEq6n01Y4vqEkx6rnN2dPy2gCSbORSFp1DlzXFT';
const secret_oauth = 'ooIVyIMsx0g8KEMWO49rVwPRqPNwL9VaixniYJF6';
const endpoint_token = 'https://api.petfinder.com/v2/oauth2/token';
const endpoint_api = 'https://api.petfinder.com/v2/animals';

let token;
let gift_array = [];

fetch(endpoint_token,
    {
        method: 'POST',
        body: 'grant_type=client_credentials&client_id=' + key_oauth + '&client_secret=' + secret_oauth,
        headers:
            {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
    }
).then(onResponse).then(token_data);

function onResponse(response) {
    return response.json();
}

function token_data(json) {
    token = json;
}

const max_results = 50;

function print_gif(){
    my_gif = endpoint_gif + '?api_key='  + k_gif + '&q=' + 'space' + '&limit=' + max_results;
    fetch(my_gif).then(onResponse).then(gif_json);
}

function gif_json(json) {
    gift_array = json.data;
    console.log(gift_array[1])
    let num_array = [];

    for(let i = 0; i < 4; i++) {
        let gif_id = 'gif_' + i;
        let image = document.getElementById(gif_id);
        image.className='display_yes';

        for(let j = num_array ; j = 0; j--) {

        }
        let num = Math.round(Math.random() * gift_array.length);
        if(num != num_array[i - 1]) {
            num_array.push(num);
        }


        console.log(num_array);
        image.src = gift_array[num_array[i]].images.downsized_medium.url;
    }
    console.log(gift_array);
}