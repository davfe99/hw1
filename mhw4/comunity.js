function onResponse(response) {
    if (response.status == 200) {
        return response.json();
    }
}
function onError(error) {
    console.log('Error: ' + error);
}

function onJson(json) {
    const box = document.querySelector('.box');

    for(let j of json){
        const post = document.createElement('div');
        post.classList.add('post');
        post.classList.add('post_com');

        const title_com = document.createElement('h3');
        title_com.classList.add('title_com');
        title_com.textContent = 'Upload by ' + j.username;

        const img = document.createElement("img");
        img.classList.add('pic_com');
        img.src = j.content.url;

        const p = document.createElement('p');
        p.classList.add('text_com');
        p.textContent = j.content.comment;

        const div = document.createElement('div');
        div.classList.add('like');

        const like = document.createElement('img');
        like.dataset.post_id = j.post_id;
        like.classList.add('like');
        like.src = 'image/unlike.png';
        like.addEventListener("click", like_post);

        let num = document.createElement("span");
        //num.classList.add('nlike');
        num.textContent = j.like;
        
        box.appendChild(post);

        post.appendChild(title_com);
        post.appendChild(img);
        post.appendChild(p);
        post.appendChild(div);
        
        div.appendChild(like);
        div.appendChild(num);
    }
}



function like_post(e){
    
    
    fetch("like.php?url="+encodeURIComponent(/*id del post*/))
            .then(onResponse, onError)
            .then(onJson);

}


fetch('fetch_posts.php').then(onResponse, onError).then(onJson);

let formData = new FormData();
formData.append('post_id', dataset.post_id);
fetch("fetch_like.php", {method: 'post', body: formData}).then(onResponse, onError);

document.querySelector('.like img').addEventListener('click', like_post);