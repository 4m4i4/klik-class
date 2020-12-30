{{-- estudiantes.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">

    @if(session()->get('success'))
        <div class = "text-center alert alert-info">
          {{ session()->get('success') }}  
        </div>
    @endif
    <div class = "">

      <div class="caja">  <!-- CABECERA estudiantes -->
        <div class = "caja-header">
          <div class = "grid grid-cols-3-fr items-center">
                @php
                  $user = auth()->user();  
                @endphp
            <h2>{{ __('My')}} {{ __('Students')}}</h2>
            <a href="{{route('materias.index')}}" class="btn secondary">
            <span class="ico-shadow"> 👈 </span>Atrás</a>
            {{-- <div>
              <label for="materia_id"></label>
              <select  class="d_block" name="materia_id" value="{{ old('materia_id') }}" id="materia_id">
                <option value=0>" materia"</option>
                  @foreach ($materias as $materia)
                            <option value={{$materia->id}}>{{$materia->materia_name}}</option>
                  @endforeach 
              </select>
            </div> --}}
                  

          </div>
        </div>
      </div>       <!-- fin de CABECERA estudiantes -->
      <div class="caja">  <!--body-TABLA estudiantes -->
        <div class = "caja-body">
          <table class = "tabla table-responsive mx-auto">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Surnames') }}</th>
                  <th>{{ __('Full name') }}</th>
                  <th>{{ __('Subject') }}</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($estudiantes as $estudiante)
                <tr>
                  <td><!-- -id -->
                        {{ $estudiante->id }}
                  </td>
                  <td><!-- Nombre -->
                        {{$estudiante->nombre }}
                  </td>
                  <td><!-- Apellidos -->
                         {{$estudiante->apellidos }}
                  </td>
                  <td><!-- Nombre completo -->
                      {{$estudiante->nombre_completo }}
                  </td>
                  <td><!-- Materia -->
                      {{$estudiante->materia->materia_name }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>      <!-- fin de body-TABLA estudiantes -->
    </div>
    {{-- <div class="justify-center flex caja ">
        {{ $estudiantes->onEachSide(5)->links() }}
    </div> --}}

  </div>
@endsection