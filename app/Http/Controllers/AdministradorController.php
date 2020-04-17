<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Daos\AdministradorDao;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Encryption\Encrypter;
use App\usuario;
use App\Http\Daos\UsuarioDao;
use App\Http\Controllers\Funciones;

class AdministradorController extends Controller
{
    
    public function index(Request $request){
        return view('Contents/Admin/indexAdmin');
    }
    public function getCreate(Request $request){
        $roles = AdministradorDao::getRoles();
        return view('Contents/Admin/crearUsuario')->with(compact('roles'));
    }
    public function getSelfEdit(Request $request){
        $cookie_usuario = json_decode(Crypt::decrypt(Cookie::get('usuario')));
        $administrador = AdministradorDao::getById($cookie_usuario->id);
        return view('Contents/Admin/editPerfil')->with(compact('administrador'));

    }
    public function postSelfEdit(Request $request){
        $cookie_usuario = json_decode(Crypt::decrypt(Cookie::get('usuario')));
        $usuario = new usuario();
        $usuario->id = $cookie_usuario->id;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->username;
        $usuario->identificacion = $request->identificacion;
        $usuario->email = $request->email;
        if(strlen($request->contrasenia) <= 80){
            $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        }else{
            $usuario->contrasenia = $request->contrasenia;
        }
        UsuarioDao::editarUsuario($usuario);
        return redirect()->route('admin.getListUsuarios');
    }
    public function postCreate(Request $request){
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|unique:usuarios,e_mail|max:50',
            'contrasenia' => 'required',
            'identificacion' => 'required|unique:usuarios,identificacion|max:50',
            'rol_id' => 'required'
        ]);
        
        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->identificacion;
        $usuario->email = $request->email;
        $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        $usuario->identificacion = $request->identificacion;
        $usuario->rol_id = $request->rol_id;
        $usuario->usuario_modifica = 0;
        $usuario->estado_eliminado = 0;
        UsuarioDao::registrar($usuario);
        return redirect()->route('admin.getListUsuarios');
    }
    /**
     * Obtiene la vista del listado de usuarios
     *
     * @return view
     */
    public function getListUsuarios(){
        $usuarios = AdministradorDao::getAllUsers();
        return view('Contents/Admin/listaUsuarios')->with(compact('usuarios'));
    }
    /**
     * Conectado a un AJAX para desplegar la info de un usuario en un modal--->
     * GET
     * @param Request $request
     * @return stdClass
     */
    public function detailsUsuario(Request $request){
        $usuario = json_encode(AdministradorDao::getById($request->id));
        return $usuario;
    }
    /**
     * Obtiene la vista y prepara los datos para editar un usuario
     * GET
     * @param Request $request
     * @return view
     */
    public function getEditar(Request $request){
        $usuario = AdministradorDao::getById($request->id);
        return view('Contents/Admin/editUsuario')->with(compact('usuario'));
    }

    /**
     * Edita la información de un usuario,
     * Trabaja ligado al form de la vista de "editar usuarios"
     * ---> POST
     * @param Request $request
     * @return void
     */
    public function postEditar(Request $request){
        $usuario = new usuario();
        $usuario->id = $request->id;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->username;
        $usuario->identificacion = $request->identificacion;
        $usuario->email = $request->email;
        if(strlen($request->contrasenia) <= 80){
            $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        }else{
            $usuario->contrasenia = $request->contrasenia;
        }
        
        UsuarioDao::editarUsuario($usuario);
        return redirect()->route('admin.getListUsuarios');
    }
    /**
     * Restaura el usuario que posea ese id;
     * Username = contrasenia = CC
     * GET
     * @param Request $request
     * @return void
     */
    public function restaurarUsuario(Request $request){
        AdministradorDao::restaurarUsuario($request->id);
        return redirect()->route('admin.getListUsuarios');
    }
    public function eliminarUsuario(Request $request){
        $usuario = new usuario();
        $usuario->id = $request->id;
        $usuario->estado_eliminado = $request->eliminado == 0 ? 1 : 0;
        AdministradorDao::eliminarUsuario($usuario);
        return redirect()->route('admin.getListUsuarios');
    }
}
