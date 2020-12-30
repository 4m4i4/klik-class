


var myVar = setInterval(myTimer, 1000);
function myTimer() {
    var d = new Date();
    document.getElementById("khoraes").innerHTML = d.toLocaleTimeString();
}


function configuraFecha(){
var x= document.getElementById("configFecha").value;
fFecha(x);
}

function fFecha(x){
  var fecha;
  var h = new Date();
  var local = h.toLocaleDateString();
  var d = h.getDate();
  var m = h.getMonth();
  var y = h.getFullYear();
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
    default:
      fecha = dias[dia]+", "+d+" de "+meses[m]+" de "+y;  // Martes, 29 de febrero de 1890
      break;
  }
document.getElementById("kdiaes").innerHTML =fecha;

}


function crearElemParent(parent, elem, attr, text){
  let elemento = document.createElement(elem);
  elemento.setAttribute(attr, text);
  parent.appendChild(elemento);
}

function crearElemTexto(parent,elem,text){
  let elemento = document.createElement(elem);
  let elem_t = document.createTextNode(text);
  elemento.appendChild(elem_t);    // añadir el texto al elemento
  parent.appendChild(elemento);
}

function crearChildColection(parent,elem,attr,text,arr){

  let lista=arr;
  for (let index = 0; index < lista.length; index++) {
    let elemento = document.createElement(elem);
    elemento.setAttribute(attr, text);
    let elem_t =document.createTextNode(lista[index]);
    elemento.appendChild(elem_t);
    parent.appendChild(elemento);
  }
}
var columnas;
var filas;


function crearMesas(columnas, filas) {
let clase= document.getElementById("clase");
clase.setAttribute("class","grid grid-cols-"+columnas+"-auto");
  let index = 0;
  for (let i = 0; i < columnas; i++) {
    for (let ii = 0; ii < filas; ii++) {
      let mesa = document.createElement("DIV");
      mesa.setAttribute("class", "mesa mesa-"+columnas);
      let id = index + "";  // recoger el valor actual del index
      // atribuir identificador a cada elemento mesa
      mesa.setAttribute('id', id + "mesa");
      crearBoton(mesa, "A", index);
      crearBoton(mesa, "B", index);
      aula.appendChild(mesa);
      index++;
    }
  }
}


function crearBoton(parent, text, id) {
    // crear el botón con la propiedad "A" y la clase propiedad_A
    let x = document.createElement("BUTTON");
    let xt = document.createTextNode(text);
    x.appendChild(xt);    // añadir el texto al botón
    let prop_a = document.createAttribute("class");
    prop_a.value = "propiedad_" + text;
    x.attributes.setNamedItem(prop_a);
    x.classList.add("bt_mesa");
    // atribuir identificador a cada botón
    x.setAttribute('id', id + text);
    // añadir clase para visualizar los botones activados
    x.setAttribute("onclick", 'this.classList.add ("active")');
    // añadir el botón al elemento antecesor
    parent.appendChild(x);
}

function desabilita(id){
    let dni = id;
    console.log(dni);
    let m = document.getElementById(dni + "");
    // m.classList.add ("falta");
    m.setAttribute("disabled","true");
    let bt_A = document.getElementById(dni + "A");
    bt_A.setAttribute("disabled","true");
    let bt_B = document.getElementById(dni + "B");
    bt_B.setAttribute("disabled","true");
}




function configurarHorario(){
  let weekDays = ["Horario", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
  let week =["Hora", "Lun", "Mar", "Mie", "Jue", "Vie"];
  
 let minutos= document.getElementById("minutosSesion").value;
  let sesiones=document.getElementById("numeroSesiones").value;
  let aula= document.getElementById("clase");

  // Crear tablaHorarios y caption
  crearElemParent(aula,"table", "id", "configurar_horario");
  let tablaHorarios = document.getElementById("configurar_horario");
  let caption_t ="Introducir el horario y las sesiones(Materia, grupo y aula)";
  crearElemTexto(tablaHorarios, "caption", caption_t);

  // Crear cabecera de la tabla (thead), añadir fila (tr) y diasSemana
  let cabecera = document.createElement("THEAD");
  tablaHorarios.appendChild(cabecera);
  let filaCabecera = document.createElement("TR");
  filaCabecera.setAttribute("id", "cabeceraDias");
  cabecera.appendChild(filaCabecera);
  let diasSemana = document.getElementById("cabeceraDias");
  crearChildColection(diasSemana, "th", "class", "dia", weekDays);

  // crear cuerpo de la tabla (tbody)
  let t_body = document.createElement("TBODY");
  t_body.setAttribute("id","cuerpo");
  tablaHorarios.appendChild(t_body);
  let cuerpo = document.getElementById("cuerpo");
  
  // crear un número de filas (tr) = número de sesiones
  for (let ix = 1; ix <= sesiones; ix++) {
      let fila = document.createElement("TR");
      // declarar variables que se usarán como atributos id y class
      let id_fila = ix; //id de cabecera= número de fila
      let classFila = "sesion"+ix; //clases por fila
      fila.setAttribute("id", id_fila);

    // crear las celdas de cada cada fila  
    for (let jx = 0; jx < weekDays.length; jx++) {
      
      // declarar variables que se usarán como atributos id y class
      let classDia = week[jx];
      let idCelda = classDia+"_"+classFila;
      let bt_idCelda = "bt_"+idCelda;
      let id_Form = "form_"+idCelda;
     
      let formName=function nombrarForm (){
        let formulario = document.getElementsByTagName("form");
        formulario[0].setAttribute('id', id_Form);
      }
       let verModal = "document.getElementById('ver_modal').style.display='block', "+formName;
      // para la 1ª celda de cada fila añadir cabecera (th) de horario     
      if(jx == 0) {
        fila.classList.add("horas");
        let hs = document. createElement("TH");
        hs.setAttribute("class", "hora "+classFila);
        hs.setAttribute("id", classFila);
        
        // añadir boton en cada celda
        let botonHs = document.createElement("BUTTON");
        botonHs.setAttribute("class", "bt_horario hora");
        botonHs.setAttribute("id", bt_idCelda);
        botonHs.innerHTML = id_fila;

        hs.appendChild(botonHs);
        fila.appendChild(hs);
      }
      // para el resto añadir celdas elemento(td)
      else{
        let celda = document.createElement("TD");
        celda.setAttribute("class", classDia+" "+classFila);
        celda.setAttribute("id", idCelda);

        // añadir boton en cada celda        
        let botonCelda = document.createElement("BUTTON");
        botonCelda.setAttribute("class", "bt_horario");
        botonCelda.setAttribute("id", bt_idCelda);
        botonCelda.setAttribute("onclick", verModal, formName);
        
        botonCelda.innerHTML = "Set";
        celda.appendChild(botonCelda);
        fila.appendChild(celda);
      }
    }
    cuerpo.appendChild(fila);
    tablaHorarios.appendChild(cuerpo);
  }
  aula.appendChild(tablaHorarios);
 }        



        var acaba=true;        
        function acabar(){
            var boton=document.getElementById('prueba');
            boton.style.backgroundColor="red";
            boton.innerHTML="Acabado";
            acaba = false;
            document.enviar.var_php.value=acaba;
            document.enviar.submit();
            
        }