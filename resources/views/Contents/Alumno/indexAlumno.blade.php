@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
	<!-- cabezera de pagina -->
	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fas fa-store-alt"></i> INICIO
		</h3>
		<p class="text-justify">Hola, bienvenido aca podra unirse a un proyecto o conformar un equipo de trabajo y decidir laborar en el que desee. © 2020 Copyright: GEA Software
		</p>
	<a href="{{route('alumno.pdf.getHistoriaPdfById', array('historia_id' => 2))}}">PDF</a>
	</div>
@endsection