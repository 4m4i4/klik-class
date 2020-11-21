@extends('layouts.app')

@section('content')

  <div class="container">
    <div class = "center">
      @if(session()->get('success'))
        <div class = "alert alert-info">
          {{ session()->get('success') }}  
        </div>
      @endif
     
    </div>
    <div class = "row">

      <div class = "">
        <div class = "caja">
          <div class = "caja-header grid grid-cols-2 justify-between">
            <h2>Mis Materias</h2>
            
              @php
                $user = auth()->user();  
              @endphp
              <form method="POST" action="{{ route('paso', $user->id) }}">
                @csrf
                @method('PUT')
                <div class= "grid  grid-cols-2">
                @if($user->paso == 1)
                  <a href="#"  class="btn warning-reves" onclick="document.getElementById('crear_materia').style.display='block'">Añadir otra ✚</a>
                  <button type="submit" name="paso" title= "pasar a paso2:Lista de materias completada" id = "paso2" value = 2 class = "btn secondary">✅ ¡He acabado! </button>

                @elseif($user->paso == '2')
                  
                  <button type="submit" name="paso"  id = "paso1" value =1 title = "Volver al primer paso" class ="boton fucsia">Volver al paso 1 </button>
                  <a href="{{ route('home') }}" class="btn secondary">Adelante!! ⏩</a>
                @endif
                </div>
              </form>
            </div>
          </div>

          <div class = "caja-body">
            <table class = "tabla table-responsive-sm">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Materia</th>
                 
                  <th>Grupo</th>
                  <th>Aula</th>
                  @if($user->paso == '1')
                    <th class="bts_handleAction" colspan = "2">Acción</th>
                  @endif
                </tr>
              </thead>
              <tbody>

                @foreach ( $materias as $materia)
                  <tr>
                    <td><!-- Materia-id -->
                        {{ $materia->id }}
                    </td>
                    <td><!-- Materia-nombre -->
                        {{ $materia->materia_name }}
                    </td>
                    <td>
                        {{ $materia->grupo }}
                    </td>
                    <td>
                      {{ $materia->grupo}}
                    </td>
                    @if($user->paso == '1')
                      <td>
                        <a href = "{{ route('materias.edit', $materia->id) }}" title = "Editar materia id= {{ $materia->id }}" class = "btn naranja">📝 Editar </a>
                      </td>
                      <td>
                        <form action="{{ route('materias.destroy', $materia->id) }}" method="POST">
                          @csrf
                          @method('delete')
                            <button type="submit" class="btn fucsia" title = "Borrar materia id= {{ $materia->id }}" >❌ Borrar</button>
                        </form>
                      </td>
                    @endif

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div id="crear_materia" class="modal">
        @include('configurar/materias/create')
      </div>
    </div>
  </div>
        
@endsection