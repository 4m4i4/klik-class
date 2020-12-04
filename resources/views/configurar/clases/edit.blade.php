@extends('layouts.app')

@section('content')
  <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
    <div class= "center p_y p_right">
      <a href="{{route('clases.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
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
    <form class="p_x15" action="{{route('clases.update', $b_clase->id) }}" method="POST" >
      @csrf
      @method('PUT')
        <div class="p_y15">
          <p id="ver_id"></p>
          @php
            use App\Models\Materia;
            $mat = Materia::get();
            $n_mat= $mat->count();
          @endphp 
        <div class="grid grid-cols-1 justify-between">
          <div class="mr-1">
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
          <div class="mr-1">  
            <label for="aula_id"><b>Aula</b></label>
            <input type="text" id="que_aula" value=""/>
            <p id= "pp"></p>
          </div>
        </div>
        <div class=" grid grid-cols-2 justify-between">
          <div class="mr-2">
            <label for="dia"><b>Día</b></label>
            <input type="text" id="dia" name="dia" required class="d_block">
          </div>
          <div class="ml-2">
            <label for="sesion_id"><b>Sesión</b></label>
            <input type="text"  name="sesion_id" class="d_block" >
          </div>
        </div>  
        <button type="submit" class=" m_t boton d_block blue" >Actualizar</button>
        
    </form>
  </div>  
    <div class=" p_x15 p_y light-grey">
      <a href="{{route('clases.index')}}"  title="Cancelar y volver al índice" class=" boton danger">Cancelar</a>
    </div>

  
  <script>
    function getSelected(){
      var x = document.getElementById("materia_id").value;
       document.getElementById('que_aula').value =x;
       document.getElementById('pp').innerHTML=x;
      
    }
     

   
    
  </script>

@endsection     
  
 