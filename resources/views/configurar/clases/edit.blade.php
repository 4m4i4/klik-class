@extends('layouts.app')

@section('content')
  <div class="modal-content animate-zoom" style="max-width:320px">
    <div class= "center py-4">
      <a href="{{route('clases.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
    </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    <form class="px-4" action="{{route('clases.update', $b_clase->id) }}" method="POST" >
      @csrf
      @method('PUT')
        <div class="py-6">
          <p id="ver_id"></p>
          @php
            use App\Models\Materia;
            $mat = Materia::get();
            $n_mat= $mat->count();
          @endphp 
        <div class="grid grid-cols-1 justify-between">
          <div class="py-2">
            <label for="materia_id"><b>Materia</b></label>
            <select id="materia_id" name="materia_id" value="{{ $b_clase->materia_id }}" class="d_block" onchange="getSelected()">
            @for ($i = 1; $i < $n_mat; $i++)
              <option value={{$i}}{{$i ==$b_clase->materia_id? ' selected' : ''}}>{{$mat[$i-1]->materia_name}}
              </option>
            @endfor

              {{-- @foreach ($materias as $materia): --}}
                {{-- <option value={{$materia->id}}>{{$materia->materia_name}} --}}
                {{-- </option> --}}
                {{-- <option value={{$materia->id}}{{ $materia->id == $b_clase->materia_id? ' selected' : ''}}> {{$materias[$materia->id-1]->name}}
                </option>
              @endforeach --}}
            </select>
          </div>
          <div class="py-2">  
            <label for="aula_id"><b>Aula</b></label>
            <input type="text"  class="d_block" id="aula_id" value=""/>
            {{-- <p id= "pp"></p> --}}
          </div>
        </div>
        <div class=" grid grid-cols-2 py-3 justify-between">
          <div class="mr-1">
            <label for="dia"><b>Día</b></label>
            <input type="text" id="dia" class="d_block" name="dia" required value="" >
          </div>
          <div class="ml-1">
            <label for="sesion_id"><b>Sesión</b></label>
            <input type="text"  id="sesion_id" class="d_block" name="sesion_id"  required value=""  >
          </div>
        </div>
        <div class="py-4">
          <button type="submit" class="boton d_block blue" >Actualizar</button>
        </div>
        
    </form>
  </div>  
    <div class="px-4 py-4 light-grey">
      <a href="{{route('clases.index')}}"  title="Cancelar y volver al índice" class=" boton danger">Cancelar</a>
    </div>

  
  <script>
    function getSelected(){
      var x = document.getElementById("materia_id").value;
       document.getElementById('aula_id').value =x;
       document.getElementById('pp').innerHTML=x; 
    }

  </script>

@endsection     
  
 