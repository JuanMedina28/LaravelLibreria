<?php

namespace App\Http\Controllers;
use App\Models\m_autor;
use Illuminate\Http\Request;

class autor_controller extends Controller
{
    public function lista_autores(){
        $autor = m_autor::all();
        return $autor;
    }

    public function eliminar_autor(Request $request){
        $libro = m_autor::find($request->id);

        $libro->delete();
    }

    public function guardar_autor(Request $request){

       
        if($request->id==null||$request->id==0){
            $autor = new m_autor();
        }else{
            $autor = m_autor::find($request->id);
        }
        
        $autor->nombre =$request->nombre_libro;
        $autor->save();
    }
}
