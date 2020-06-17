consultandogrupos = (Identificador) =>{
    const uri = $('#api_route_get_grupo').val();
    $.ajax({
      url: uri,
      async: true,
      data: {'id_grupo':Identificador},
      success:function(response){
        console.log(response);
        $('#modal_nombre_grupo').val(response.nombre);
        $('#descripcion_grupo').val(response.descripcion);

  
        $('#modal_nombre_grupo').attr('disabled','disabled');
        $('#descripcion_grupo').attr('disabled','disabled');

        $('#modalgrupos').modal('show');
      },
      error:function(error){
        console.log("ERROR:\n");
        console.log(error);
        $('#nombre_grupo').val('Error al consultar, intente más tarde');
      }
    });
  }
  
  $('#btnCierramodal').click(function(){
    $('#modalgrupos').toggle();
    $('#modaleditargrupos').hide();
    limpiarModal();
    window.location.reload();
  });
  function limpiarModal(){
    $('#integrantes tbody').empty();
    $('#nombre_grupo_editar').val('');
    $('#descripcion_grupo_editar').val('');
    $('#id_grupo').val('');
  }
  Grupo = (Identificador) =>{
    limpiarModal();
    const uri = $('#api_route_get_edit_grupo').val();
    $.ajax({
      url: uri,
      async: true,
      data: {'id_grupo':Identificador},
      success:function(response){
        console.log(response);
        $('#id_grupo').val(Identificador);
        $('#nombre_grupo_editar').val(response.grupo.nombre);
        $('#descripcion_grupo_editar').val(response.grupo.descripcion);
        Integrantes = response.integrantes;
        var island_serverinfo = '';
        Integrantes.forEach(element => {
            island_serverinfo += '<tr>';
            island_serverinfo += '<td scope="row">'+element.nombres+' '+ element.apellidos+'</td>';
            island_serverinfo += '<td scope="row"><a type="submit" class="btn btn-danger" onclick="EliminarIntegrante('+element.id+')"><i class="far fa-trash-alt"></i></a></td>';
            island_serverinfo += '</tr>';
        });
        $('#integrantes tbody').append(island_serverinfo);
      },
      error:function(error){
        console.log("ERROR:\n");
        console.log(error);
        $('#nombre_grupo').val('Error al consultar, intente más tarde');
      }
    });
  }
  EliminarIntegrante = (Identificador) =>{
    const uri = $('#api_route_get_delete').val();
    let id_proyecto = $('#id_grupo').val();
    $.ajax({
      url: uri,
      async: true,
      data: {'id_grupo_usuario':Identificador},
      success:function(response){
        console.log(response);
        alert('El integrante se ha eliminado con exito!');
        limpiarModal();
        Grupo(id_proyecto);
      },
      error:function(error){
        console.log("ERROR:\n");
        console.log(error);
        $('#nombre_grupo').val('Error al consultar, intente más tarde');
      }
    });
  }
  EditarGrupo = () =>{
    let nombre = $('#nombre_grupo_editar').val();
    let descripcion = $('#descripcion_grupo_editar').val();
    let grupo =  $('#id_grupo').val();
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: ruta,
      async: true,
      data:{
        'id_grupo': grupo,
        'nombre':nombre,
        'descripcion':descripcion
      },
      success: function(response){
        console.log(response);
        alert('Actualización Existosa');
        limpiarModal();
        $('#modaleditargrupos').hide();
        window.location.reload();
        response = null;
      },
      error: function(response){
        alert('Algo salió mal... comuníquese con soporte');
        console.log(response);
        response = null;
      }
    });
  }