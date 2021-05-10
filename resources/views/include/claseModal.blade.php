        <div id="ver_modal" class="modal">

          @include('include.formBanner')
            
              <div class="px-6 caja-header text-center">
                <h3>Introducir clase:<br><span id="ver_id"></span></h3>
              </div>
              <form class="px-6" method="POST" action="{{ route('clases.store') }}">
                @csrf 
                    <!--*MOdal: La función claseModal(this.id) recoge la id del botón que hace la llamada (formada por los valores 'dia'_'sesion_id'), hace un innerHTML a los input y quita el display:none de la ventana modal-->
                  <div class="hidden grid grid-cols-3-auto">
                    <div class="d_inline w-5"><!-- $clase->user_id  -->
                      <label class="d_inline" for="user_id"></label>
                      <input type="hidden" name="user_id" value={{ auth()->user()->id }} readonly class="w-5" />
                    </div>
                    <div class="d_inline w-5"><!-- $clase->sesion_id (*MOdal) -->
                      <label  class="d_inline" for="sesion_id"></label>
                      <input type="hidden" id="sesion_id" name="sesion_id" readonly class="w-5" value="{{ old('sesion_id') }}" >
                    </div>
                    <div class="d_inline w-5"><!-- $clase->dia (*MOdal) -->
                      <label  class="d_inline" for="dia"></label>
                      <input type="hidden" id="dia" name="dia" readonly class="w-5" value="{{ old('dia') }}" >
                    </div>
                  </div>
                  <div class=""><!-- $clase->materia_id -->
                      <label for="materia_id">Materia</label>
                      <select  class="d_block" name="materia_id" value="{{ old('materia_id') }}" id="materia_id" >
                          @foreach ($materias as $materia)
                            <option value={{$materia->id}}>{{$materia->materia_name}}</option>
                          @endforeach
                      </select>
                  </div>
                  {{-- <div class="mt-4"><!-- $clase->aula_id -->
                      <label for="aula_id">Aula</label> 
                      <select  class="d_block" name="aula_id" value="{{ old('aula_id') }}" id="aula_id">

                          @foreach ($aulas as $aula)
                            <option value={{$aula->id}}>{{$aula->aula_name}}</option>
                          @endforeach
                      </select>
                  </div> --}}
                
                  <div>
                    <button type="submit" 
                     title="Guardar clase" 
                     class="bt_xxl mt-6 enviar">Guardar</button>
                  </div>
              </form>
              
              <div class="px-6 py-4 mt-6 light-grey">
                <button onclick="document.getElementById('ver_modal').style.display='none'" 
                type="button" 
                title="Cancelar y volver al índice" 
                 class="boton d_inline cancelar">Cancelar</button>
              </div>
          </div>  {{--  fin modal-content --}}
        </div> {{--  fin modal --}}