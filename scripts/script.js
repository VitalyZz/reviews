const signIn = document.querySelector('.sign_in');
const signUp = document.querySelector('.sign_up');

const closeModal = document.querySelector('.closeModal');

const realFileBtn = document.querySelector(".real-file");
const customBtn = document.querySelector(".custom-button");
const customTxt = document.querySelector(".custom-text");

let loginForm = document.querySelector('#login');
let registerForm = document.querySelector('#register');
let btnForm = document.querySelector('#btn');

let loginBtn = document.querySelector('.loginBtn');
let registerBtn = document.querySelector('.registerBtn');

signIn.addEventListener('click', openModalWindow);
signUp.addEventListener('click', openModalWindow);
signUp.addEventListener('click', openSignUp);
signIn.addEventListener('click', openSignIn);

closeModal.addEventListener('click', closeModalWindow);

loginBtn.addEventListener('click', login);
registerBtn.addEventListener('click', register);

customBtn.addEventListener("click", function() {
    realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
    if (realFileBtn.value) {
        customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        customTxt.style.color = '#07D846';
    } else {
        customTxt.innerHTML = "Постер не выбран";
    }
});

function register() {
    loginForm.style.left = '-400px';
    registerForm.style.left = 'calc(50% - 135px)';
    btnForm.style.left = '170px';
    document.querySelector('.form-box').style.height = 630 + 'px';
}

function login() {
    loginForm.style.left = 'calc(50% - 135px)';
    registerForm.style.left = '450px';
    btnForm.style.left = '0px';
    document.querySelector('.form-box').style.height = 500 + 'px';
}

function openModalWindow() {
    document.body.style.overflow = 'hidden';
    document.querySelector('.layer').style.display = 'block';
    document.querySelector('.blackLayer').style.display = 'block';
}

function closeModalWindow() {
    document.body.style.overflow = 'visible';
    document.querySelector('.layer').style.display = 'none';
    document.querySelector('.blackLayer').style.display = 'none';
}

function openSignUp() {
    loginForm.style.left = '-400px';
    registerForm.style.left = 'calc(50% - 135px)';
    btnForm.style.left = '170px';
    document.querySelector('.form-box').style.height = 630 + 'px';
}

function openSignIn() {
    loginForm.style.left = 'calc(50% - 135px)';
    registerForm.style.left = '450px';
    btnForm.style.left = '0px';
    document.querySelector('.form-box').style.height = 500 + 'px';
}