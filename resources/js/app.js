require('./bootstrap');

var myVar = setInterval(myTimer, 1000);
var queHora = document.getElementById("khora");



function myTimer() {
  var d = new Date();
  queHora.innerHTML = d.toLocaleTimeString(); 
  var queDia = document.getElementById("kdiaes");
  if(queDia!==null)
  queDia.innerHTML = d.toLocaleDateString();
} 



function fFecha(x){
  var fecha;
  var h = new Date();
  var local = h.toLocaleDateString();
  var d = h.getDate();
  var m = h.getMonth();
  var y = h.getFullYear();
  var dias = ["Domingo","Lunes", "Martes", "Miércoles","Jueves","Viernes","Sábado"];
  var dia = h.getDay();
  var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

  switch (x) {
    case 0:
      fecha = d+" de "+meses[m];
      break;
    case 1:
      fecha = d+" de "+meses[m]+" de "+y;
      break;
    case 2:
      fecha = dias[dia]+"; "+d+" de "+meses[m];
      break;
    case 3:
      fecha = dias[dia]+"; "+d+" de "+meses[m]+" de "+y;
      break;
    case 4:
      fecha = local;
      break;
    case 5:
      fecha = dias[dia]+"; "+local;
      break;
    default:
      fecha = dias[dia]+"; "+d+" de "+meses[m]+" de "+y;
      break;
  }
document.getElementById("kdiaes").innerHTML =fecha;

}

