{{-- clases.edit --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Cambiar la materia de esta clase</h3>
    </div>
    
    <form class="px-6" action="{{route('clases.update', $clase) }}" method="POST" >
      @csrf
      @method('PUT')
        <div class="hidden"><!-- User_id -->
            <label for="user_id"></label>
            <input type="text" name="user_id" value="{{ auth()->user()->id }}" readonly />
        </div>  
        <p id="ver_id"></p>
          @php
            use App\Models\Materia;
            // $mat = Materia::where('user_id',auth()->user()->id )->get();
            // $n_mat= $mat->count();
            use App\Models\Aula;
            // $aula = Aula::where('user_id',auth()->user()->id )->get();
            // json_encode($aula);
            // $n_aula= $aula->count();
          @endphp 
        <div class="hidden grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="dia"></label>
            <input type="hidden" id="edit_dia" class="d_block" name="dia" readonly value="{{ $clase->dia }}">
            @error('dia')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  
          </div>
          <div class="ml-1">
            <label for="sesion_id"></label>
            <input type="hidden" id="edit_sesion_id" class="d_block" name="sesion_id" readonly value="{{ $clase->sesion_id}}">
            @error('sesion_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror   
          </div>
        </div>        
        
        <div class="pb-2">
          <label for="materia_id">Materia</label>
          <select id="materia_id" 
            name="materia_id" 
            value="{{$clase->materia_id}}" 
            class="d_block" 
            onchange="cambiarAulaId()">
            @foreach ($materias as $materia)
              <option value={{$materia->id}} {{$materia->id == $clase->materia_id? 'selected' : ''}}>
                {{$materia->materia_name}}
              </option>
            @endforeach
          </select>
          @error('materia_id')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror   
        </div>
        <div>
          <button type="submit" 
          title="Actualizar clase" 
          class="bt_xxl mt-6 enviar">Actualizar</button>
        </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('clases.index')}}" title="Cancelar y volver al índice" 
      class="cancelar">Cancelar</a>
    </div>

  </div>
</div>
@endsection

@section('script') 
    <script>

    function cambiarAulaId(){
      let x = document.getElementById("materia_id");
      let seleccionado = x.value;
      console.log("has seleccionado: "+seleccionado);

      console.log("nombre materia: "+x.children[seleccionado -1].innerHTML);
      let nombreMateria = x.children[seleccionado -1].innerHTML;

      let arr = nombreMateria.split(' ');
      let nombreAula = arr[1]+" "+arr[2];
     
      console.log("nombre aula: "+nombreAula);
      // se añade el valor al input
      // document.getElementById('new_aula_id').value = nombreAula;
      // document.getElementById('new_aula_id').innerHTML = nombreAula;
      // TRAMPAS: añado manualmente el id 5 que corresponde al aula 1D ESO
      // para ver si el post sigue arrojando el mismo error
      // let idAula1D = 5;
      // document.getElementById('new_aula_id').value = idAula1D;
      // console.log("id aula: "+idAula1D);
    }
  </script>
@endsection