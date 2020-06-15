@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')

	<input type="hidden" 
	name="api_route_fill_calendar" 
	id="api_route_fill_calendar" 
	value="{{route('docente.getDataCronogramaByGrupoId', 
	array('id_proyecto' => $id_proyecto,
	'id_grupo' => $id_grupo)
	)}}">
  	<div id="calendar">

  	</div>

@endsection

@section('custom_scripts')
	<script src="{{URL::asset('JS/calendarios/cronograma.js')}}"> </script>
@endsection