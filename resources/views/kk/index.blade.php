@extends('layouts.app')

@section('content')

  <div class="container">
    <div class = "col-sm-12">
      @if(session()->get('info'))
        <div class = "alert alert-info">
          {{ session()->get('info') }}  
        </div>
      @endif
    </div>
    <div class = "row">

      <div class = "col-md-12">
        <div class = "caja">
          <div class = "caja-header d-flex justify-content-between">
            <h2>Mi horario de Clases </h2>
          </div>
          <div class = "caja-body">
            <table  class = "tabla table-responsive-sm" id="configurar_horario">
              <caption>Introducir el horario y las sesiones(Materia, grupo y aula)</caption>
              <thead>
                <tr id="cabeceraDias">
                  <th id="hora_sesion">Horario</th>
                  <th class="dia">Lunes</th>
                  <th class="dia">Martes</th>
                  <th class="dia">Miércoles</th>
                  <th class="dia">Jueves</th>
                  <th class="dia">Viernes</th>
                </tr>
              </thead>
              <tbody id="cuerpo">
                <tr id="1" class="horas">
                  <th class="hora_sesion sesion1 grid timegrid-cols-3" id="sesion1">
                    <button onclick="horarioModal(this.innerHTML)" class="bt_time hora" id="bt_Hora_sesion1">1</button>
                    <input type="time" id="hIni1"required  name="hIni1" class="" >
                    <input type="time" id="hFin1"required  name="hFin1" class="" >
                  </th>
                  <td class="Lun sesion1" id="Lun_sesion1">
                    <button class="bt_horario" id="lunes_1" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mar sesion1" id="Mar_sesion1">
                    <button class="bt_horario" id="martes_1" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mie sesion1" id="Mie_sesion1">
                    <button class="bt_horario" id="miercoles_1" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Jue sesion1" id="Jue_sesion1">
                    <button class="bt_horario" id="jueves_1" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Vie sesion1" id="Vie_sesion1">
                    <button class="bt_horario" id="viernes_1" onclick="claseModal(this.id)">Set</button>
                  </td>
                </tr>
                <tr id="2" class="horas">
                  <th class="hora_sesion sesion2 grid timegrid-cols-3" id="sesion2">
                    <button onclick="horarioModal(this.innerHTML)" class="bt_time hora" id="bt_Hora_sesion2">2</button>
                    <input type="time" id="hIni2"required  name="hIni2" class="" >
                    <input type="time" id="hFin2"required  name="hFin2" class="" >                    
                  </th>
                  <td class="Lun sesion2" id="Lun_sesion2">
                    <button class="bt_horario" id="lunes_2" onclick="claseModal(this.id)">Set</button>

                  </td>
                  <td class="Mar sesion2" id="Mar_sesion2">
                    <button class="bt_horario" id="martes_2" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mie sesion2" id="Mie_sesion2">
                    <button class="bt_horario" id="miercoles_2" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Jue sesion2" id="Jue_sesion2">
                    <button class="bt_horario" id="jueves_2" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Vie sesion2" id="Vie_sesion2">
                    <button class="bt_horario" id="viernes_2" onclick="claseModal(this.id)">Set</button>
                  </td>
                </tr>
                <tr id="3" class="horas">
                  <th class="hora_sesion sesion3 grid timegrid-cols-3" id="sesion3">
                    <button onclick="horarioModal(this.innerHTML)" class="bt_time hora" id="bt_Hora_sesion3">3</button>
                    <input type="time" id="hIni3"required  name="hIni3" class="" >
                    <input type="time" id="hFin3"required  name="hFin3" class="" >
                  </th>
                  <td class="Lun sesion3" id="Lun_sesion3">
                    <button class="bt_horario" id="lunes_3" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mar sesion3" id="Mar_sesion3">
                    <button class="bt_horario" id="martes_3" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mie sesion3" id="Mie_sesion3">
                    <button class="bt_horario" id="miercoles_3" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Jue sesion3" id="Jue_sesion3">
                    <button class="bt_horario" id="jueves_3" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Vie sesion3" id="Vie_sesion3">
                    <button class="bt_horario" id="viernes_3" onclick="claseModal(this.id)">Set</button>
                  </td>
                </tr>
                <tr id="4" class="horas">
                  <th class="hora_sesion sesion4 grid timegrid-cols-3" id="sesion4">
                    <button onclick="horarioModal(this.innerHTML)" class="bt_time hora" id="bt_Hora_sesion4">4</button>
                    <input type="time" id="hIni4"required  name="hIni4" class="" >
                    <input type="time" id="hFin4"required  name="hFin4" class="" >
                  </th>
                  <td class="Lun sesion4" id="Lun_sesion4">
                    <button class="bt_horario" id="lunes_4" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mar sesion4" id="Mar_sesion4">
                    <button class="bt_horario" id="martes_4" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mie sesion4" id="Mie_sesion4">
                    <button class="bt_horario" id="miercoles_4" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Jue sesion4" id="Jue_sesion4">
                    <button class="bt_horario" id="jueves_4" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Vie sesion4" id="Vie_sesion4">
                    <button class="bt_horario" id="viernes_4" onclick="claseModal(this.id)">Set</button>
                  </td>
                </tr>
                <tr id="5" class="horas">
                  <th class="hora_sesion sesion5 grid timegrid-cols-3" id="sesion5">
                    <button onclick="horarioModal(this.innerHTML)" class="bt_time hora" id="bt_Hora_sesion5">5</button>
                    <input type="time" id="hIni5"required  name="hIni5" class="" >
                    <input type="time" id="hFin5"required  name="hFin5" class="" >
                  </th>
                  <td class="Lun sesion5" id="Lun_sesion5">
                    <button class="bt_horario" id="lunes_5" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mar sesion5" id="Mar_sesion5">
                    <button class="bt_horario" id="martes_5" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mie sesion5" id="Mie_sesion5">
                    <button class="bt_horario" id="miercoles_5" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Jue sesion5" id="Jue_sesion5">
                    <button class="bt_horario" id="jueves_5" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Vie sesion5" id="Vie_sesion5">
                    <button class="bt_horario" id="viernes_5" onclick="claseModal(this.id)">Set</button>
                  </td>
                </tr>
                <tr id="6" class="horas">
                  <th class="hora_sesion sesion6 grid timegrid-cols-3" id="sesion6">
                    <button onclick="horarioModal(this.innerHTML)" class="bt_time hora" id="bt_Hora_sesion6">6</button>                    
                    <input type="time" id="hIni6"required  name="hIni6" class="" >
                    <input type="time" id="hFin6"required  name="hFin6" class="" >
                  </th>
                  <td class="Lun sesion6" id="Lun_sesion6">
                    <button class="bt_horario" id="lunes_6" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mar sesion6" id="Mar_sesion6">
                    <button class="bt_horario" id="martes_6" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Mie sesion6" id="Mie_sesion6">
                    <button class="bt_horario" id="miercoles_6" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Jue sesion6" id="Jue_sesion6">
                    <button class="bt_horario" id="jueves_6" onclick="claseModal(this.id)">Set</button>
                  </td>
                  <td class="Vie sesion6" id="Vie_sesion6">
                    <button class="bt_horario" id="viernes_6" onclick="claseModal(this.id)">Set</button>
                  </td>
                </tr>
              </tbody>
            </table>

            <script>
            var hsInicio =['00:00'];
            var hsFin =['00:00'];
            // var fin = push(function(){
            //   var yy=document.getElementById("hFin").value;
            //   return yy;
            //  });
            var ini= [];
            var fin=[];

            function horarioModal(valor){
              document.getElementById("id_sesion").innerHTML="La sesión "+valor;
              var parent_id = document.getElementById(valor).parentElement.id; 
              document.getElementById('introducir_horario_modal').style.display='block';
            }
            
            function sesion_ini_fin(){
              
             var inicio= (document.getElementById("hInicio").value);
             var final= (document.getElementById("hFin").value);
              document.getElementById("hIni"+valor).innerHTML=inicio;
              document.getElementById("hFin"+valor).innerHTML=final;
              // var yy=document.getElementById("hFin").value;
              // console.log(y);
              // console.log(yy);
              // hsInicio.push(y);
              // hsFin.push(yy);
              console.log(inicio);
              console.log(final);
            }
            
            function claseModal(valor_id){
              let ar_id = valor_id.split('_');
              let dia_semana = ar_id[0];
              let num_sesion = ar_id[1];
              document.getElementById("verid").innerHTML=dia_semana+", sesión "+num_sesion ;
              document.getElementById("dia").value=dia_semana;
              document.getElementById("sesion_id").value= num_sesion;
              document.getElementById('ver_modal').style.display='block';
            }
            </script>

            <div id="introducir_horario_modal" class="modal">
              <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
                <div class= "center p_y p_right">
                  <span onclick="document.getElementById('introducir_horario_modal').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
                  <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
                </div>


                <form class="p_x15 p_y15" method="get" >
                    {{-- action="{{ route('store_clasesHorario', $materia->id) }}"> --}}
                  @csrf
                   {{-- @method('PUT') --}}
                  
                    <p id="id_sesion"><p>
                    <div class="p_y  grid grid-cols-2 justify-between">
                      <div class="hora">

                        <label for="hInicio"><b>Empieza:</b></label>
                        <input type="time" id="hInicio"required  name="hInicio" class="d_block m_b" >
                      </div>
                      <div class="hora">
                        <label for="hFin"><b>Acaba: </b></label>
                        <input type="time" id="hFin"required  name="hFin" class="d_block m_b" >
                      </div>
                    </div>
                    <button onclick="sesion_ini_fin()" class="boton d_block m_b15 blue" type="submit">Guardar</button>
                  {{-- </div> --}}
                </form>

                <div class=" p_x15 p_y light-grey">
                  <button onclick="document.getElementById('introducir_horario_modal').style.display='none'" type="button" class=" boton danger">Cancel</button>
                </div>
              </div>
            </div>



            <div id="ver_modal" class="modal">
             
              <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
                <div class= "center p_y p_right">
                  <span onclick="document.getElementById('ver_modal').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
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
                        <select class="d_block" name="aula_id" value="{{ old('aula_id') }}" id="aula_id" >
                          @foreach ($aulas as $aula)
                            <option value={{$aula->id}}>{{$aula->aula_name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    {{-- <div class="d_block m_y">

                    </div> --}}

                    <div class=" m_y grid grid-cols-2 justify-between">
                      <div class="mr-1">
                      <label for="dia"><b>Día</b></label>
                      <input type="text" id="dia" name="dia" required class="d_block">
                      </div>
                      <div class="ml-1">
                        <label for="sesion_id"><b>Sesión</b></label>
                        <input type="text" id="sesion_id" name="sesion_id" class="d_block" >



                      </div>
                    </div>
                    <button class="boton d_block blue" type="submit">Guardar</button>
                  </div>
                </form>

                {{-- <form class="p_x15" method="POST" action="{{ route('store_clasesHorario') }}">
                  @csrf
                   
                  <div class="p_y15">
                    <p id="verid"></p>
                    <label for="materia_id"><b>Selecciona la materia</b></label>
                    <select id="materia_id">
                      @foreach ($materias as $materia)
                        <option value={{$materia->id}}>{{$materia->materia_name}}
                        </option>
                          
                      @endforeach
                    </select>
                  </div>
                  <div class="p_y">
                    <label for="dia"><b>Día de la semana</b></label>
                    <input type="text" id="dia" name="dia" required class="d_block m_b">
                    <label for="hora_inicio"><b>Hora de Inicio</b></label>
                    <input type="time" id="hora_inicio" name="hora_inicio"  required class="d_block m_b" >
                    <label for="hora_fin"><b>Hora Final</b></label>
                    <input type="time" id="hora_fin" name="hora_fin" required class="d_block m_b" >
            
                    <button class="boton d_block blue" type="submit">Guardar</button>
                  </div>
                </form> --}}

                <div class=" p_x15 p_y light-grey">
                  <button onclick="document.getElementById('ver_modal').style.display='none'" type="button" class=" boton danger">Cancel</button>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>





@endsection

            