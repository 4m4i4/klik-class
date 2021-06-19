{{-- @section('estudiantes.create') MODAL --}}
{{-- @extends('layouts.app') --}}

{{-- @section('tablas') --}}


  @include('include.formBanner')

        <div class="px-6 caja-header text-center">
          <h3 class="form-title">Introducir grupo:<br><span id="ver_grupo"></span>
          </h3>
        </div>
        <form class="px-6" method="POST" action="{{ route('estudiantes.store') }}">
          @csrf
          
          <div class= "">
              <label for="create_materia_id"></label>
              <input type="hidden" id="create_materia_id" name="create_materia_id" value="" >
              <label for="user_id"></label>
              <input type="hidden" id="user_id" name="user_id" value="{{auth()->user()->id }}" >
              {{-- <label for="check"></label>
              <input type="hidden" id="check" name="check" value="1" > --}}
          </div>
          <div class="mt-4">
              <label for="lista_completa">Lista de estudiantes</label>
              <textarea class="d_block" placeholder="Picasso, Pablo; Garcia Lorca, Federico; De Cervantes Saavedra, Miguel" rows="4" required autofocus name="lista_completa"></textarea>
              <small class="ejemplo"><strong>Patrón:</strong> Apellido -coma-, Nombre -punto y Coma-;</small>
              @error('lista_completa')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror    
              {{-- <button onclick="checkeaLista()">check</button>         --}}
          </div>
          <div class= "mt-4">
            <details class="mt-2">
              <summary>Ayuda formato:</summary>
               <p class="mt-2">
                Usa solo <strong>Números </strong> y <strong>Letras</strong>
              </p>
              <div class="destacado py-2">
                <p class="py-2">Apellido <kbd>space</kbd> Apellido  <kbd>coma</kbd>,  Nombre <kbd> ;</kbd></p>
              </div>  
              <p class="mt-2">Apellidos a la izquierda de <kbd>coma</kbd>, Nombre a la derecha; <kbd>punto y coma</kbd> para añadir el siguiente</p>
            </details>
          </div>
          <div>
            <button type="submit" 
             title="Guardar grupo de estudiantes" 
             class="bt_xxl mt-6 enviar">Guardar</button>
          </div>
        </form>

        <div class="px-6 py-4 mt-6 light-grey">
          <button onclick="document.getElementById('crear_estudiantes').style.display='none'" 
          type="button" 
          title="Cancelar y volver al índice" 
          class="cancelar">Cancelar</button>
        </div>

      </div>

<script>
    // function checkeaLista(){
    //   var formulario=addEventListener('submit',function(e){
    //     e.preventDefault();
    //     console.log('has hecho click');
    //     var datos = new FormData(formulario);
    //     console.log(datos);

    //     var xxhr = new XMLHttpRequest();
    //     xxhr.open('POST','/configurar/estudiantes',true);
    //     xxhr.setRequestHeader('Content-Type','application/json');
    //     xxhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    //     xxhr.onload = function(){
    //       if(xxhr.status==200){
    //         var json = JSON.parse(xxhr.responseText);
    //         var checkLista = /^([\w+ ]*\w+(,).+(;).+)/;
    //         var textareaData = document.getElementById('lista_completa').value;
    //         if(!textareaData.match(checkLista)){
    //           alert ("Please write the usernames in the correct format (with a full stop between first and last name).");
    //           return false;
    //         }
    //       }
    //     }
    //   })        
    // }

  </script>