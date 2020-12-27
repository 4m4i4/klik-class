require('./bootstrap');
var myVar = setInterval(myTimer, 1000);
function myTimer() {
    var d = new Date();
    document.getElementById("khoraes").innerHTML = d.toLocaleTimeString();
}
