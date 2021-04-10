require('./bootstrap');

var myVar = setInterval(myTimer, 1000);
var queHora = document.getElementById("khora");



function myTimer() {
  var d = new Date();
  queHora.innerHTML = d.toLocaleTimeString(); 
  var queDia = document.getElementById("kdiaes");
  var dias = ["Domingo","Lunes", "Martes", "Miércoles","Jueves","Viernes","Sábado"];
  var dia = d.getDay();
  var n = d.getDate();
  
  if(queDia!==null)
  // queDia.innerHTML = d.toLocaleDateString();
  queDia.innerHTML = n+", "+ dias[dia];
} 



function fFecha(x){
  var fecha;
  var h = new Date();
  var local = h.toLocaleDateString();
  var d = h.getDate();
  var m = h.getMonth();
  var y = h.getFullYear();
  myTimer();
  var dias = ["DOMINGO","LUNES", "MARTES", "MIÉRCOLES","JUEVES","VIERNES","SÁBADO"];
  var dia = h.getDay();
  var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

  switch (x) {
    case 0:
      fecha = d+" de "+meses[m];  // 29 de febrero
      break;
    case 1:
      fecha = d+" de "+meses[m]+" - "+dias[dia];  // 29 de febrero - Martes
      break;
    case 2:
      fecha = dias[dia]+" - "+d+" de "+meses[m];  // Martes - 29 de febrero
      break;
    case 3:
      fecha =  d+" de "+meses[m]+" de "+y;  // 29 de febrero de 1890
      break;
    case 4:
      fecha = d+" / "+m+" / "+y+"  ,  "+dias[dia];  //29 / 02 / 1890 Martes 
      break;
    case 5:
      fecha = local; //  29/02/1890 
      break;
    case 6:
      fecha = local+"  "+dias[dia]; //  29/02/1890 Martes 
      break;
    case 7:
      fecha = d+", "+dias[dia]//   29, Martes 
      break;
    default:
      fecha = dias[dia]+", "+d+" de "+meses[m]+" de "+y;  // Martes, 29 de febrero de 1890
      break;
  }
  document.getElementById("kdiaes").innerHTML =fecha;

}

