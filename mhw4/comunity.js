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
    box.classList.add('log1');

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
        like.dataset.ppost_id = j.post_id;
        like.classList.add('like');

        let num = document.createElement("span");
        num.classList.add('num');
        num.dataset.post_id = j.post_id;

        if (j.verify){
            like.src = 'image/heart.png';
            //num.classList.add('nlike');
            num.textContent = j.like;
            div.appendChild(like);
            div.appendChild(num);
            like.addEventListener("click", like_post);
        }else{
            like.src = 'image/heart-.png';
            //num.classList.add('nlike');
            num.textContent = j.like;
            div.appendChild(like);
            div.appendChild(num);
            like.addEventListener("click", like_post);
        }

        console.log(j.verify)

        post.appendChild(title_com);
        post.appendChild(img);
        post.appendChild(p);
        post.appendChild(div);
        
        box.appendChild(post);
    }
}

function json_num(json){
    console.log(json);

    for(j of json){
        if (j.var){
            span = document.querySelectorAll('span');
            for (i of span.values()){
                console.log(i.dataset);
                if (i.dataset === j.post_id){
                    i.textContent = j.likes;
                }
            }
        }else {
            span = document.querySelectorAll('span');
            for (i of span.values()){
                console.log(i.dataset);
                if (i.dataset === j.post_id){
                    i.textContent = j.likes;
                }
            }
        }
    }
}

function like_post(e){
    like = e.currentTarget;
    post_id = like.dataset.ppost_id;
    src = like.src;

    console.log(post_id);
    console.log(src);

    if (src === 'image/heart.png'){
        like.src = 'image/heart-.png';
        fetch("unlike.php?post_id="+encodeURIComponent(post_id))
            .then(onResponse, onError)
            .then(json_num);
    }else{
        like.src = 'image/heart.png';
        fetch("like.php?post_id="+encodeURIComponent(post_id))
            .then(onResponse, onError)
            .then(json_num);
    }
}


fetch('fetch_posts.php').then(onResponse, onError).then(onJson);
//fetch('fetch_like.php?post_id=' + encodeURIComponent(j.post_id)).then(onResponse).then(like_json);

/* 
let formData = new FormData();
formData.append('post_id', dataset.post_id);
fetch("fetch_like.php", {method: 'post', body: formData}).then(onResponse, onError);

document.querySelector('.like img').addEventListener('click', like_post); */