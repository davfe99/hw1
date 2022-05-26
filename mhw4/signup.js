// VALIDAZIONE CREDENZIALI FORM Sign-up

function onResponse(response){
    if (!response.ok)  return null;
    return response.json();
}

function v_username_json(json){
    const span = document.querySelector('#input_username span');

    if (json.exists){
        span.textContent = 'username INUTILIZZABILE';
        span.classList.add('text_error');
    }else {
        span.textContent = '';
        span.classList.remove('text_error');
    }
    v_form();
}

function v_username (e) {
    let username = document.querySelector('#input_username input').value;
    const span = document.querySelector('#input_username span');
    
    if(!/^[a-zA-Z0-9_]{4,16}$/.test(username)) {
        span.classList.add('text_error');
        span.textContent = 'username INUTILIZZABILE';
    } else {
        fetch("v_username.php?q="+encodeURIComponent(username)).then(onResponse).then(v_username_json);
    }
    v_form();
}

function v_email_json(json){
    const span = document.querySelector('#input_email span');
    
    if (json.exists){
        span.textContent = 'email INUTILIZZABILE';
        span.classList.add('text_error');
    }else {
        span.textContent = '';
        span.classList.remove('text_error');
    }  
    v_form(); 
}

function v_email(e){
    let email = document.querySelector('#input_email input').value;
    const span = document.querySelector('#input_email span');  

    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)) {
        span.classList.add('text_error');
        span.textContent = 'email INUTILIZZABILE';
    } else {
        fetch("v_email.php?q="+encodeURIComponent(email)).then(onResponse).then(v_email_json);
    }
    v_form();
}

function v_password(e){
    const span = document.querySelector('#input_password_1 span');
    let pass = document.querySelector('#input_password_1 input').value.length;

    if (pass <= 7){
        span.textContent = 'password debole';
        span.classList.add('text_error');
    }else {
        span.textContent = '';
        span.classList.remove('text_error');
    }
    v_confirm_pass();
    v_form();
}
function v_confirm_pass(e){
    let pass = document.querySelector('#input_password_2 input').value;
    const span = document.querySelector('#input_password_2 span');
    
    if (document.querySelector('#input_password_1 input').value !== pass){
        span.textContent = 'password diverse';
        span.classList.add('text_error');
    }else {
        span.textContent = '';
        span.classList.remove('text_error');
    }
    v_form();
}

function v_form(){
    if (document.querySelector('.text_error') === null){
        document.getElementById('registrati').disabled = false;
    }else{
        document.getElementById('registrati').disabled = true;
    }
}


document.querySelector('#input_username input').addEventListener('blur', v_username);
document.querySelector('#input_email input').addEventListener('blur', v_email);
document.querySelector('#input_password_1 input').addEventListener('blur', v_password);
document.querySelector('#input_password_2 input').addEventListener('blur', v_confirm_pass);