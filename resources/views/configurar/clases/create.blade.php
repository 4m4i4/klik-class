@extends('layouts.app')
@section('content')
  <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
    <div class= "center p_y p_right">
      <a href="{{route('clases.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
    </div>
    <form class="p_x15" method="POST" action="{{ route('clases.store') }}">
      @csrf
                   
      <div class="p_y15">
        <p id="verid"></p>
        <div class=" grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="materia_id"><b>Materia</b></label>
            <select  class="d_block" name="materia_id" value="{{ old('materia_id') }}" id="materia_id">
              @foreach ($materias as $materia)
                <option value={{$materia->id}}>{{$materia->materia_name}}
                </option>
              @endforeach
            </select>
          </div>
          <div class="ml-1">
            <label for="aula_id"><b>Aula</b></label>
            <select class="d_block"  id="aula_id" name="aula_id" value="{{ old('aula_id') }}">
              @foreach ($aulas as $aula)
                <option value={{$aula->id}}>{{$aula->aula_name}}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="d_block m_y">
          <label for="dia"><b>Día de la semana</b></label>
          <input type="text" id="dia" name="dia" required class="d_block">
        </div>
            
        <div class=" m_b grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="sesion_id"><b>Sesión</b></label>
            <input type="text"  name="sesion_id" class="d_block" >
          </div>
          <div class="ml-1">
            <label for="hora_fin"><b>Acaba</b></label>
            <input type="time" id="hora_fin" name="hora_fin" class="d_block" >
          </div>
        </div>

 
       
        <button class="boton d_block blue" type="submit">Guardar</button>
      </div>
    </form>

    <div class=" p_x15 p_y light-grey">
      <a href="{{route('clases.index')}}" type="button" class=" boton danger">Cancelar</a>
    </div>
  </div>
    {{-- <div class= "center p_y p_right">
      <span onclick="document.getElementById('ver_modal').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
    </div>
    <form class="p_x15" method="POST" action="{{ route('store_clasesHorario', $materia->id) }}">
      @csrf
                   @method('PUT')
      <div class="p_y15">
        <p id="verid"></p>
          <select id="mis_materias">
            @foreach ($materias as $materia)
              <option value={{$materia->id}}>{{$materia->materia_name}} {{$materia->grupo}}</option>
            @endforeach
          </select>
          <label for="dia"><b>Día de la semana</b></label>
          <input  type="text" id="dia" name="dia" required class="d_block m_b">
          <label for="hora_inicio"><b>Hora de Inicio</b></label>
          <input type="time" id="hora_inicio" name="hora_inicio"  required class="d_block m_b" >
          <label for="hora_fin"><b>Hora Final</b></label>
          <input type="time" id="hora_fin" name="hora_fin" required class="d_block m_b" >
          <button class="boton d_block blue" type="submit">Guardar</button>
        </div>
      </form>

      <div class=" p_x15 p_y light-grey">
        <button onclick="document.getElementById('ver_modal').style.display='none'" type="button" class=" boton danger">Cancel</button>
      </div>
    </div> --}}

    {{-- <div>
      <label name="sesiones">Nº de sesiones</label>
      <input type="number" name="sesiones" id="numeroSesiones" max="10" value="7">
    </div>
     <button class="p_x2 f_right" onclick="configurarHorario()">horario</button> --}}
@endsection