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
    console.log(response.text);
}

function databaseResponse(json) {
    const r = document.getElementById(descr);
    const res = document.createElement('div');
    r.appendChild(res);

    if (!json.ok) {
        res.textContent = 'non fatto';
        return null;
    }
    console.log(r);
    res.textContent = 'fatto';
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





