function detallesUsuario(Identificador){
    $.ajax({
        url: 'detalles_usuario',
        async: true,
        data: {id:Identificador},
        success:function(response){
            let data = $.parseJSON(response);
            $('#nombresUsuario').val(data.nombres);
            $('#apellidosUsuario').val(data.apellidos);
            $('#identificacionUsuario').val(data.identificacion);
            $('#emailUsuario').val(data.e_mail);
            $('#usernameUsuario').val(data.username);

            $('#nombresUsuario').attr('disabled','disabled');
            $('#apellidosUsuario').attr('disabled','disabled');
            $('#identificacionUsuario').attr('disabled','disabled');
            $('#emailUsuario').attr('disabled','disabled');
            $('#usernameUsuario').attr('disabled','disabled');

            $('#modalDetalles').show();
            
        },
        error: function(error){
            console.log(error);
            $('#nombresUsuario').val('Error al consultar, intente más tarde');
            $('#nombresUsuario').attr('disabled','disabled');

            $('#modalDetalles').show();
        }
    });
}
$('#btnCierraModalDetallesUsuario').click(function(){
    $('#modalDetalles').toggle();
});
//Para la barra de búsqueda
$('#criterio').keypress(function (e) { 
    _this = this;  
    $.each($("#tabla tbody tr"), function() {
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
        else
            $(this).show();
    });
});