<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioLibroController extends Controller
{
    public function store(Request $request, Usuario $usuario, Libro $libro)
     {
       $rules = [
           'libro_id' => 'required|integer',
       ];

       $messages = [
           'integer' => 'la is debe de ser de tipo int',
           'required' => 'Se necesita la id'
       ];

       $validateData = $request->validate($rules,$messages);

       $usuario->libros()->syncWithoutDetaching($validateData);

       return $this->showOne($usuario);

    }

    public function destroy(Usuario $usuario, Libro $libro)
    {
        $usuario->libros()->detach($libro->libro_id);
        return $this->showOne($usuario);
    }

}
