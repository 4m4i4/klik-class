{{-- clases.create --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Introducir clase
      </h3>
    </div>
    <form class="px-6" method="POST" action="{{ route('clases.store') }}">
      @csrf
      @php
        use App\Models\Materia;
        $mat = Materia::get();
        $n_mat= $mat->count();
      @endphp    
      <div class="hidden"><!-- User_name -->
        <label for="user_id">user</label>
        <input type="text" name="user_id" 
            value={{ auth()->user()->id }} readonly />
      </div>
      <div class="pb-6">
        <p id="ver_id"></p>
        <div class="grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="materia_id">
              Materia
            </label>
            <select class="d_block" name="materia_id" value="{{ $clase->materia_id }}" id="materia_id">
              @for ($i = 1; $i < $n_mat; $i++)
                <option value={{$i}}>{{$mat[$i-1]->materia_name}}</option>
              @endfor

            </select>
            @error('materia_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  
          </div>
          <div class="ml-1">
            <label for="aula_id">Aula</label>
            <select class="d_block" id="aula_id" name="aula_id" value="{{ old('aula_id') }}">
              @foreach ($aulas as $aula)
                <option value={{$aula->id}}>{{$aula->aula_name}}
                </option>
              @endforeach
            </select>
          </div>
            @error('aula_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror 
        </div>
        <div class=" grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="dia">Día de la semana</label>
            <input type="text" id="dia" name="dia" value="{{ old('dia') }}" required class="d_block">
          </div>
            @error('dia')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  

          <div class="mr-1">
            <label for="sesion_id">Sesión</label>
            <input type="text"  name="sesion_id" value="{{ old('sesion_id') }}" class="d_block" >
          </div>
            @error('sesion_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror   
        </div>
        <div>
          <button type="submit" 
          title="Guardar clase"  
          class="bt_xxl mt-6 enviar" >Guardar</button>
        </div>
      </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('clases.index')}}"  title="Cancelar y volver al índice"
      class="cancelar">Cancelar</a>
    </div>
</div>
  
@endsection