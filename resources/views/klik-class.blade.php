{{-- http://127.0.0.1:8000/klik-class --}}
@extends('layouts.app')

  @section('etapaUso')
  <div class="container">

    <button class="mt-4 py-4 px-4 btn enviar" onclick="sendRequest()">
    Enviar petición Ajax
    </button>
    <button class="mt-4 py-4 px-4 btn enviar" onclick="sendMisClases()">
    Mis clases por día
    </button>
    <p id="respuesta"></p>
    <div id="lista"></div>
  </div>
    <!-- Scripts -->
  @endsection
  <script>
    function sendRequest(){
      var xhr = new XMLHttpRequest();
      xhr.open('GET','http://127.0.0.1:8000/home/mostrarClase',true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
      xhr.onreadystatechange = function(){
        document.getElementById('respuesta').innerHTML = xhr.responseText;
      }
      xhr.send();
    }
function formatDate(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  console.log(minutes);
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12 ;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  console.log(minutes);
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

var d = new Date();
var e = formatDate(d);

    function sendMisClases(){
      var xhr = new XMLHttpRequest();
      xhr.open('GET','/clasesPorDia',true);
      xhr.setRequestHeader('Content-Type','application/json');
      xhr.onload = function(){
        if(xhr.status===200){
          var json = JSON.parse(xhr.responseText);
          var template=``;
          json.map(function(data){
            template +=`
            <h2>${data.dia} </h2>
            <strong>${data.sesion.inicio}-${data.sesion.fin}</strong>
            <p>${data.materia.materia_name}</p>
            `
            return template;
          });
          console.log(template);
          document.getElementById('lista').innerHTML=template;
        }else{
          console.log("existe un error de tipo: "+xhr.status);
        }
      }
      xhr.send();
    }

    function suma(x, y=1){
      let res = x.innerHTML;
      res = parseInt(res) + y;
      x.innerHTML = res; 
    }
    function sino(x){
      let res = x.innerHTML;
      if(res == "Sí"){
        res = "No";
        x.classList.remove('bg-sobreB');
        x.classList.add('bg-sobreN');
      }else if(res == "No"){
        res = "Sí";
        x.classList.remove('bg-sobreN');
        x.classList.add('bg-sobreB');
      }
      x.innerHTML = res;
      console.log(res); 
      // x.classList.toggle('bg-sobreN');
    }

    function lee(x){
      let valor = document.getElementById(x).innerHTML;
      console.log("v: "+valor);
      let cero = parseInt(valor)%50;
      console.log("resto: "+cero);
      if(cero == 0){
        document.getElementById(x).classList.toggle('bg-blue');
      }
    }
    function desabilita(id){
      let dni = id;
      console.log(dni);
      let m = document.getElementById(dni);
      // m.classList.add ("falta");
      m.setAttribute("disabled","true");
      let A_bt = document.getElementById("A_bt_" +dni);
      A_bt.setAttribute("disabled","true");
      let B_bt = document.getElementById("B_bt_" +dni);
      B_bt.setAttribute("disabled","true");
      let name = document.getElementById("name_" +dni);
      name.setAttribute("disabled","true");
    }
  var mesa = {
    id:1,
    mesa_name:'1_1_4',
    columna:1,
    fila:4,
    aula_id:1,
    is_ocupada:true,
    estudiante_id:1,
    botonIzq:{
      // id: `A_bt_${mesa.id}`,
      nombre:'boolean',
      valor:0,
      estado:'activo',
      cantidad:2
    },
    botonDcha:{
      // id: `B_bt_${mesa.id}`,
      nombre:'gradual',
      valor:0,
      estado:'activo',
      cantidad:10,
      incremento:10
    }
  }                                                
 console.log(mesa);






  </script>
