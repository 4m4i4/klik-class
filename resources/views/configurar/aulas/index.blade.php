{{-- @extends('layouts.app')

@section('content')

  <div class="container">
    <div class = "col-sm-12">
      @if(session()->get('success'))
        <div class = "alert alert-success">
          {{ session()->get('success') }}  
        </div>
      @endif
    </div>
    <div class = "row">

      <div class = "col-md-12">
        <div class = "caja">
          <div class = "caja-header d-flex justify-content-between">
            <h2>Mis Aulas</h2>
            <div>
              @php
                $user = auth()->user();  
              @endphp
              <form method="POST" action="{{ route('paso3') }}">
                @csrf
                @method('PUT')
                  @if($user->paso1 == '0')
                    <a href="#" id="datos1" class="btn warnierse" onclick="document.getElementById('crear_materia').style.display='block'">Añadir otra ✚</a>
                    <button type="submit" name="paso1" value = "1" title = "Lista de materias completada" class = "btn secondary">✅ ¡He acabado! </button>
                  @elseif($user->paso1 == '1')
                    
                    <button type="submit" name="paso1" value = "0" title = "Volver al primer paso" class = "boton fucsia">Volver al paso 1 </button>
                    <a href="{{url()->previous()}}" class="boton default">secondary ⏩</a>
                  @endif
              </form>
            </div>
          </div>

          <div class = "caja-body">
            <table class = "tabla table-responsive-lg">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Materia</th>
                 
                  <th>Grupo</th>

                  <th class="bts_handleAction" colspan = "2">Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $materias as $materia)
                  <tr>
                    <td><!-- Materia-id -->
                        {{ $materia->id }}
                    </td>
                    <td>
                        {{ $materia->nombre }}
                    </td>
                    <td>
                        {{ $materia->grupo }}
                    </td>
                    <td>
                      <a onclick="document.getElementById('editar_materia').style.display='block'" href = "#" title = "Editar" class = "btn naranja">📝 Editar </a>
                    </td>
                    <td>
                      <a href = "{{ route('borrar_materias', $materia->id) }}" title="Borrar" method='DELETE' data-token="{{ csrf_token() }}" class="btn fucsia">❌ Borrar</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div id="editar_materia" class="modal">
            @include('configurar/_materiasEditar',['id'=>$materia->id])

          </div>
        </div>
      </div>
      <div id="crear_materia" class="modal">
        @include('configurar/_materiasCrear')
      </div>
    </div>
  </div>
        
@endsection --}}