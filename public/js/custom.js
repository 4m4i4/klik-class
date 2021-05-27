

var screenWidth = screen.availWidth;
if (screenWidth >= 414) var semana = "'Horario','Lunes','Martes','Miercoles','Jueves','Viernes'";else var semana = "'Hora','Lun','Mar','Mie','Jue','Vie'"; // document.getElementById("semana").innerHTML=semana;

var myVar = setInterval(myTimer, 1000);
var ahora;

if (typeof ahora !== 'undefined') {
  ahora = document.getElementById("khora");
}

function myTimer() {
  var d = new Date();
  var options = {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false
  }; // console.log(new Intl.DateTimeFormat('es-ES', options).format(d).replace(/\//g,'-').replace(',',''));

  ahora.innerHTML = new Intl.DateTimeFormat('es-ES', options).format(d).replace(/\//g, '-').replace(',', ''); // ahora.innerHTML = d.toLocaleTimeString(); 

  var queDia = document.getElementById("kdiaes");
  var dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  var dia = d.getDay();
  var n = d.getDate();
  if (queDia !== null) // queDia.innerHTML = d.toLocaleDateString();
    queDia.innerHTML = n + " " + dias[dia];
}

function configuraFecha() {
  var x = document.getElementById("configFecha").value;
  fFecha(x);
}

function fFecha(x) {
  var fecha;
  var h = new Date();
  var local = h.toLocaleDateString();
  var d = h.getDate(); // día (número del mes)

  var m = h.getMonth(); // mes (número del 0 al 11)

  var y = h.getFullYear(); // myTimer();

  var dias = ["DOMINGO", "LUNES", "MARTES", "MIÉRCOLES", "JUEVES", "VIERNES", "SÁBADO"];
  var dia = h.getDay();
  var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

  switch (x) {
    case 0:
      fecha = d + " de " + meses[m]; // 29 de febrero

      break;

    case 1:
      fecha = d + " de " + meses[m] + " - " + dias[dia]; // 29 de febrero - Martes

      break;

    case 2:
      fecha = dias[dia] + " - " + d + " de " + meses[m]; // Martes - 29 de febrero

      break;

    case 3:
      fecha = d + " de " + meses[m] + " de " + y; // 29 de febrero de 1890

      break;

    case 4:
      fecha = d + " / " + m + " / " + y + "  ,  " + dias[dia]; //29 / 02 / 1890 Martes 

      break;

    case 5:
      fecha = local; //  29/02/1890 

      break;

    case 6:
      fecha = local + "  " + dias[dia]; //  29/02/1890 Martes 

      break;

    case 7:
      fecha = d + " " + dias[dia]; //   29 Martes 

      break;

    default:
      fecha = dias[dia] + ", " + d + " de " + meses[m] + " de " + y; // Martes, 29 de febrero de 1890

      break;
  }

  document.getElementById("kdiaes").innerHTML = fecha;
} // function verMesas(valor_id){
//   let ar_id = valor_id.split('_');
//   let bt_verMesas= "verMesasAula"+ar_id[1];
//   console.log(bt_verMesas);
//   var x = document.referrer; 
//   console.log(x);
//   // location.replace(x);
//   var element= document.getElementById(bt_verMesas);
//   element.classList.remove("hidden");
// }


function crearElemParent(parent, elem, attr, text) {
  var elemento = document.createElement(elem);
  elemento.setAttribute(attr, text);
  parent.appendChild(elemento);
}

function crearElemTexto(parent, elem, text) {
  var elemento = document.createElement(elem);
  var elem_t = document.createTextNode(text);
  elemento.appendChild(elem_t); // añadir el texto al elemento

  parent.appendChild(elemento);
}

function crearChildColection(parent, elem, attr, text, arr) {
  var lista = arr;

  for (var index = 0; index < lista.length; index++) {
    var elemento = document.createElement(elem);
    elemento.setAttribute(attr, text);
    var elem_t = document.createTextNode(lista[index]);
    elemento.appendChild(elem_t);
    parent.appendChild(elemento);
  }
}

var columnas;
var filas;

function crearMesas(columnas, filas) {
  var clase = document.getElementById("clase");
  clase.setAttribute("class", "grid grid-cols-" + columnas + "-auto");
  var index = 0;

  for (var i = 0; i < columnas; i++) {
    for (var ii = 0; ii < filas; ii++) {
      var mesa = document.createElement("DIV");
      mesa.setAttribute("class", "mesa mesa-" + columnas);
      var id = index + ""; // recoger el valor actual del index
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
  var x = document.createElement("BUTTON");
  var xt = document.createTextNode(text);
  x.appendChild(xt); // añadir el texto al botón

  var prop_a = document.createAttribute("class");
  prop_a.value = "propiedad_" + text;
  x.attributes.setNamedItem(prop_a);
  x.classList.add("bt_mesa"); // atribuir identificador a cada botón

  x.setAttribute('id', id + text); // añadir clase para visualizar los botones activados

  x.setAttribute("onclick", 'this.classList.add ("active")'); // añadir el botón al elemento antecesor

  parent.appendChild(x);
}

function desabilita(id) {
  var dni = id;
  console.log(dni);
  var m = document.getElementById(dni); // m.classList.add ("falta");

  m.setAttribute("disabled", "true");
  var A_bt = document.getElementById("bt_izq_" + dni);
  A_bt.setAttribute("disabled", "true");
  var B_bt = document.getElementById("bt_dcha_" + dni);
  B_bt.setAttribute("disabled", "true");
  var name = document.getElementById("name_" + dni);
  name.setAttribute("disabled", "true");
}

function suma(x) {
  var y = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  var res = x.innerHTML;
  res = parseInt(res) + y;
  x.innerHTML = res;
}

function sino(x) {
  var res = x.innerHTML;

  if (res == "Sí") {
    res = "No";
    x.classList.remove('bg-fucsia', 'text-white');
    x.classList.add('bg-amarillo', 'text-gray-900');
  } else if (res == "No") {
    res = "Sí";
    x.classList.remove('bg-amarillo', 'text-gray-900');
    x.classList.add('bg-fucsia', 'text-white');
  }

  x.innerHTML = res;
  console.log(res);
}

function lee(laid) {
  var valor = document.getElementById(laid).innerHTML;
  console.log("v: " + valor);

  if (parseInt(valor) < 50) {
    valor = parseInt(valor) + 10;
    document.getElementById(laid).innerHTML = valor;
    var colorGradual = parseInt(valor) % 60;
    console.log("color gradual: " + colorGradual);
    switchColor(colorGradual, laid);
  }
}

function switchColor(x, id) {
  var ele = document.getElementById(id);

  switch (x) {
    case 10:
      ele.classList.remove('bg-gradual1');
      ele.classList.add('bg-gradual2');
      break;

    case 20:
      ele.classList.remove('bg-gradual2');
      ele.classList.add('bg-gradual3');
      break;

    case 30:
      ele.classList.remove('bg-gradual3');
      ele.classList.add('bg-gradual4');
      break;

    case 40:
      ele.classList.remove('bg-gradual4');
      ele.classList.add('bg-gradual5');
      break;

    case 50:
      ele.classList.remove('bg-gradual5');
      ele.classList.add('bg-gradual6');
      break;

    case 50:
      ele.classList.remove('bg-gradual6');
      ele.classList.add('bg-gradual6');
      break;

    default:
      document.getElementById(id).classlist.toggle('bg-gradual1');
      break;
  }
}

function configurarHorario() {
  var weekDays = ["Horario", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
  var week = ["Hora", "Lun", "Mar", "Mie", "Jue", "Vie"];
  var minutos = document.getElementById("minutosSesion").value;
  var sesiones = document.getElementById("numeroSesiones").value;
  var aula = document.getElementById("clase"); // Crear tablaHorarios y caption

  crearElemParent(aula, "table", "id", "configurar_horario");
  var tablaHorarios = document.getElementById("configurar_horario");
  var caption_t = "Introducir el horario y las sesiones(Materia, grupo y aula)";
  crearElemTexto(tablaHorarios, "caption", caption_t); // Crear cabecera de la tabla (thead), añadir fila (tr) y diasSemana

  var cabecera = document.createElement("THEAD");
  tablaHorarios.appendChild(cabecera);
  var filaCabecera = document.createElement("TR");
  filaCabecera.setAttribute("id", "cabeceraDias");
  cabecera.appendChild(filaCabecera);
  var diasSemana = document.getElementById("cabeceraDias");
  crearChildColection(diasSemana, "th", "class", "dia", weekDays); // crear cuerpo de la tabla (tbody)

  var t_body = document.createElement("TBODY");
  t_body.setAttribute("id", "cuerpo");
  tablaHorarios.appendChild(t_body);
  var cuerpo = document.getElementById("cuerpo"); // crear un número de filas (tr) = número de sesiones

  for (var ix = 1; ix <= sesiones; ix++) {
    var fila = document.createElement("TR"); // declarar variables que se usarán como atributos id y class

    var id_fila = ix; //id de cabecera= número de fila

    var classFila = "sesion" + ix; //clases por fila

    fila.setAttribute("id", id_fila); // crear las celdas de cada cada fila  

    var _loop = function _loop(jx) {
      // declarar variables que se usarán como atributos id y class
      var classDia = week[jx];
      var idCelda = classDia + "_" + classFila;
      var bt_idCelda = "bt_" + idCelda;
      var id_Form = "form_" + idCelda;

      var formName = function nombrarForm() {
        var formulario = document.getElementsByTagName("form");
        formulario[0].setAttribute('id', id_Form);
      };

      var verModal = "document.getElementById('ver_modal').style.display='block', " + formName; // para la 1ª celda de cada fila añadir cabecera (th) de horario     

      if (jx == 0) {
        fila.classList.add("horas");
        var hs = document.createElement("TH");
        hs.setAttribute("class", "hora " + classFila);
        hs.setAttribute("id", classFila); // añadir boton en cada celda

        var botonHs = document.createElement("BUTTON");
        botonHs.setAttribute("class", "bt_horario hora");
        botonHs.setAttribute("id", bt_idCelda);
        botonHs.innerHTML = id_fila;
        hs.appendChild(botonHs);
        fila.appendChild(hs);
      } // para el resto añadir celdas elemento(td)
      else {
          var celda = document.createElement("TD");
          celda.setAttribute("class", classDia + " " + classFila);
          celda.setAttribute("id", idCelda); // añadir boton en cada celda        

          var botonCelda = document.createElement("BUTTON");
          botonCelda.setAttribute("class", "bt_horario");
          botonCelda.setAttribute("id", bt_idCelda);
          botonCelda.setAttribute("onclick", verModal, formName);
          botonCelda.innerHTML = "Set";
          celda.appendChild(botonCelda);
          fila.appendChild(celda);
        }
    };

    for (var jx = 0; jx < weekDays.length; jx++) {
      _loop(jx);
    }

    cuerpo.appendChild(fila);
    tablaHorarios.appendChild(cuerpo);
  }

  aula.appendChild(tablaHorarios);
}

var acaba = true;

function acabar() {
  var boton = document.getElementById('prueba');
  boton.style.backgroundColor = "red";
  boton.innerHTML = "Acabado";
  acaba = false;
  document.enviar.var_php.value = acaba;
  document.enviar.submit();
}
