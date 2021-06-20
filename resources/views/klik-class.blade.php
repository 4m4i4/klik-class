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
@endsection

    <!-- Scripts -->
  <script>
    function sendRequest(){
      var xhr = new XMLHttpRequest();
      xhr.open('GET','http://127.0.0.1:8000/home/mostrarClase',true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
      xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      // var pinta_aula = '';
      xhr.onreadystatechange = function(){
        document.getElementById('respuesta').innerHTML = xhr.responseText;
        // console.log(xhr.responseText);
      } 
      xhr.send();
    }

  
    function sendMisClases(){
      var xxhr = new XMLHttpRequest();
      xxhr.open('GET','/clasesPorDia',true);
      xxhr.setRequestHeader('Content-Type','application/json');
     xxhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      xxhr.onload = function(){
        if(xxhr.status==200){
          var json = JSON.parse(xxhr.responseText);
          var template=``;
          // var date= new Date('2021/5/27 11:41:00');
          var date= new Date();
          var d= new Intl.DateTimeFormat('es-ES',{dateStyle:'short'}).format(date);
          // console.log("fecha= "+date);
          // console.log("fecha d= "+d);
          var dias = ["Domingo","Lunes", "Martes", "Miércoles","Jueves","Viernes","Sábado"];
          var weekdia = date.getDay();
          // console.log("dia= "+weekdia);
          var mes= date.getMonth();
          // console.log("mes= "+mes);
          var ahora =date.toLocaleTimeString('es-ES');
          var t_actual = timeStr2Millis(ahora);
          console.log("HORA= "+t_actual);
          console.log("DIA SEMANAL= "+dias[weekdia]);
          json.map(function(data){

            if(dias[weekdia]==data.dia 
              && t_actual >= timeStr2Millis(data.sesion.inicio) 
              && t_actual <= timeStr2Millis(data.sesion.fin))
              {     
              //  // OPCIÓN QUE FUNCIONA
               template="";
              template+=
              `<h2>${data.dia} </h2>
              <strong>${data.sesion.inicio}-${data.sesion.fin}</strong>
              <p>${data.materia.materia_name}</p>
              <p>Tienes clase en el AULA = ${data.materia.aula_id}</p>
              `
              return template;
              //  // fin de OPCIÓN QUE FUNCIONA

            //   // // OPCIÓN QUE NO ENTIENDO PORQUÉ NO FUNCIONA


            //   // template=`${data.materia.aula_id}`
            //   // return template;

            //  template= setTimeOut(function(){alertFunc(`${data.materia.aula_id}`);
            //    },5000); 
            //     return template;
            //   // // fin de OPCIÓN QUE NO ENTIENDO PORQUÉ NO FUNCIONA
            }
            function alertFunc(parametro){
              document.getElementById('lista').innerHTML=parametro;
            }
            // else if (template==''){
            //   template =`<p> No tienes clase </p>`}
                     if(dias[weekdia]!=data.dia ){
                            template+=
              `<h2>${data.dia} </h2>
              <strong>${data.sesion.inicio}-${data.sesion.fin}</strong>
              <p>${data.materia.materia_name}</p>
              <p>TAULA = ${data.materia.aula_id}</p>
              `
              // return template;
              return template;
            }
          });
          document.getElementById('lista').innerHTML=template;
        }
        else{
          console.log("existe un error de tipo: "+xxhr.status);
        }
      }


       // OPCIÓN QUE FUNCIONA
      xxhr.send();
       // fin de OPCIÓN QUE FUNCIONA

      // // // OPCIÓN QUE NO ENTIENDO PORQUÉ NO FUNCIONA
      // var aula_id= document.getElementById('lista');
      // var a=aula_id.innerHtml;
      // xxhr.send(location.href="/etapaUso/aulas/"+a+"/show");
      // // // fin de OPCIÓN QUE NO ENTIENDO PORQUÉ NO FUNCIONA
    }


    function timeStr2Millis(cadena){
      var arr_Time=cadena.split(":");
      var horas= arr_Time[0];
      var minutos= arr_Time[1];
      var segundos= arr_Time[2];
      return horas*3600000+minutos*60000+segundos*1000;
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






















//  function sendRequest(){
//       var xhr = new XMLHttpRequest();
//       xhr.open('GET','http://127.0.0.1:8000/home/mostrarClase',true);
//       // xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
//             xhr.setRequestHeader('Content-Type','application/json');

//      xhr.onload = function(){
//         if(xhr.status===200){
//           var json = JSON.parse(xhr.responseText);
//           // var datos= JSON.stringify(json);
         

//           // var template;
//           // console.log("mi log: "+datos);
//           for (let indice of ggg){
//              console.log("mi log: "+indice);
//           }
         
//           // var elAula_id = datos.elAulaId;
//           // console.log("elAula_id: "+elAula_id);
//           // document.getElementById('lista').innerHTML=template;
//         }else{
//           console.log("existe un error de tipo: "+xhr.status);
//         }
//       }
//       xhr.send();
//     }


  </script>
