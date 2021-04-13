{{-- http://127.0.0.1:8000/klik-class --}}
@extends('layouts.app')

  @section('etapaUso')
  <div class="container">

    <button class="mt-4 py-4 px-4 btn enviar" onclick="sendRequest()">
    Enviar petición Ajax
    </button>
    <p id="respuesta"></p>
  </div>
    <!-- Scripts -->
  @endsection
  <script>
    function sendRequest(){

      var theObject = new XMLHttpRequest();
      theObject.open('GET','http://127.0.0.1:8000/home/mostrarClase',true);
      theObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
      theObject.onreadystatechange = function(){
        document.getElementById('respuesta').innerHTML = theObject.responseText;
        // console.log(theObject.responseText);
      }
      theObject.send();
    }



    </script>
