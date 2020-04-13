@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Historias de usuario</h3>
    <br>
    <!-- Formulacio para crear historias de usuario-->
    <h5>Agregar un usuario</h5>
    <!--Este es el form para agregar a un usuario entrevistado-->
    <form action="{{route('alumno.postCrearUsuarioEntrevistado', array('id_proyecto' => $id_proyecto, 'id_fase' => $id_fase,'id_modulo' => $id_modulo, 'id_actividad' => $id_actividad))}}" method="POST">
        @csrf
        <label for="">Nombre</label>
        <input type="text" name="nombre_usuario_entrevistado" id="nombre_usuario_entrevistado">
        <br>
        <label for="">Email</label>
        <input type="text" name="email_usuario_entrevistado" id="email_usuario_entrevistado">
        <br>
        <label for="">Telefono</label>
        <input type="text" name="telefono_usuario_entrevistado" id="telefono_usuario_entrevistado">
        <br>
        <label for="">Cargo</label>
        <input type="text" name="cargo_usuario_entrevistado" id="cargo_usuario_entrevistado">
        <br>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    <br>
    <br><br>
    <br><br>
    <h5>Agregar una historia de usuario</h5>
    <div class="container-sm">
        <form action="{{route('alumno.postCrearHistoriaUsuario', array('id_modulo' => $id_modulo, 
            'id_proyecto' => $id_proyecto, 
            'id_fase' => $id_fase,
            'id_actividad' => $id_actividad))}}" method="POST">
            @csrf
            <label for="">Secuencia</label>
            <input type="text" name="secuencia" id="">
            <br>
            <label for="">Nombre</label>
            <input type="text" name="nombre" id="">
            <br>
            <label for="prioridad">Prioridad</label>
            <div class="alert alert-info" role="alert" id="indicador_prioridad">
                Media
            </div>
            <input type="range" name="prioridad" id="desplazamiento_bar" max="5" min="1" value="3" class="custom-range">
            <br>
            <label for="">Estado</label>
            <input type="text" name="estado" id="">
            <br>
            <label for="">Fecha de ralización</label>
            <input type="date" name="fecha_realizado" id="">
            <br>
            <label for="">Compromisos</label>
            <a class="btn btn-success" id="btnAgregarCompromiso">+</a>
            <table class="table table-sm">
                <thead class="bg-primary">
                    <tr>
                        <th>Compromiso</th>
                    </tr>
                </thead>
                <tbody id="contenedor">
                    <tr>
                        <td>
                            <textarea type="text" name="compromisos[]"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3>Evidencias</h3>

            <a class="btn btn-success" id="btn_agregar_evidencia">+</a>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody id="contenedor_evidencia">
                    <tr>
                        <td>
                            <input type='text' name='nombre_evidencia[]'>
                        </td>
                        <td>
                            <input type='file' name='foto_evidencia[]'>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <button type="submit">Crear</button>
            <br>
        </form>
    </div>
@endsection