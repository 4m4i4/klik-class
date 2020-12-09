@extends('layouts.app')
@section('content')
  <div class="modal-content animate-zoom" style="max-width:320px">
    <div class= "center py-4">
      <a href="{{route('clases.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
    </div>
    <div class="px-6 caja-header"><h3>Introducir clase</h3></div>
    <form class="px-6" method="POST" action="{{ route('clases.store') }}">
      @csrf
      @php
        use App\Models\Materia;
        $mat = Materia::get();
        $n_mat= $mat->count();
      @endphp        
      <div class="py-6">
        <p id="ver_id"></p>
        <div class="grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="materia_id">
              <b>Materia</b>
            </label>
            <select class="d_block" name="materia_id" value="{{ $clase->materia_id }}" id="materia_id">
              @for ($i = 1; $i < $n_mat; $i++)
                <option value={{$i}}>{{$mat[$i-1]->materia_name}}</option>
              @endfor
                {{-- @foreach ($materias as $materia)
                <option value={{$materia->id}}>{{$materia->materia_name}}
                </option>
                @endforeach --}}
            </select>
          </div>
          <div class="ml-1">
            <label for="aula_id"><b>Aula</b></label>
            <select class="d_block" id="aula_id" name="aula_id" value="{{ old('aula_id') }}">
              @foreach ($aulas as $aula)
                <option value={{$aula->id}}>{{$aula->aula_name}}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class=" grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="dia"><b>Día de la semana</b></label>
            <input type="text" id="dia" name="dia" value="{{ old('dia') }}" required class="d_block">
          </div>
            

          <div class="mr-1">
            <label for="sesion_id"><b>Sesión</b></label>
            <input type="text"  name="sesion_id" value="{{ old('sesion_id') }}" class="d_block" >
          </div>

        </div>
        <div class="py-6 my-4">
          <button class="boton d_block blue" type="submit">Guardar</button>
        </div>
      </div>
    </form>

      <div class="px-6 py-4 mt-4 light-grey">
      <a href="{{route('clases.index')}}" type="button" class=" boton danger">Cancelar</a>
    </div>
  </div>
  
@endsection