let modal = document.getElementById('myModal');
let btn = document.getElementById('myBtn');
let span = document.getElementsByClassName('close')[0];
let logout = document.getElementsByClassName('logout')[0];

btn.onclick = function() {
    modal.style.display = 'block';
}

span.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

logout.onclick = function() {
    document.cookie = "todo-cookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.replace("http://localhost:3000/login.php");
}