// Show/hide password onClick of button using Javascript only
// https://stackoverflow.com/questions/31224651/show-hide-password-onclick-of-button-using-javascript-only
const usernameNode = document.querySelector('#username')
const passwordNode = document.querySelector('#password')

const loginBtn = document.querySelector('.log-in');

function show() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'password');
}

let pwShown = false;

document.getElementById("eye").addEventListener("click", function () {
    if (!pwShown) {
        pwShown = true;
        show();
    } else {
        pwShown = false;
        hide();
    }
});


loginBtn.addEventListener('click', async (e) => {
    e.preventDefault()
    console.log('clicked')


    const username = usernameNode.value
    const password = passwordNode.value
    e.preventDefault();

    const result = await fetch('http://localhost:3001/login', { // sending data to the server
        method: 'POST',
        body: JSON.stringify({ username, password }),
        headers: { 'Content-type': 'application/json' }
    }) // getting the data from server

    const data = await result.json();

    if (data.message) {
        return window.alert('Invalid credentials')
    }
    window.localStorage.setItem('token', data)
    window.location.assign('123.html')
})