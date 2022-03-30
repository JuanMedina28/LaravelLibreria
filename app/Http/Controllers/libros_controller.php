<?php

namespace App\Http\Controllers;

use App\Models\m_autor;
use App\Models\m_libros;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class libros_controller extends Controller
{
    /*public function lista_libros(){
        $libros = m_libros::all();
        return $libros;
    }*/
    /**Lista los libros y conecta con la tabla autor para obtener el nombre */
    public function lista_libros(){
        $libros= DB::table('libros')
            ->join("autor","autor.id","=","libros.id_autor")
            ->select('libros.*','autor.nombre as nombre_au')
            ->get();

        return $libros;
    }

    /**Realiza la funcion para eliminar un libro en base a su ID */
    public function eliminar_libro(Request $request){
        $libro = m_libros::find($request->id);

        $libro->delete();
        
    }

    /**Guarda los nuevos libros y realiza las modificaciones a un libro existente */
    public function guardar_libro(Request $request){

       
        if($request->id==null||$request->id==0){
            $libro = new m_libros();
        }else{
            $libro = m_libros::find($request->id);
        }
        
        $autor=m_autor::where('nombre',$request->nom_autor)->first();
        
        $libro->nombre_libro =$request->nombre_libro;
        $libro->precio =$request->precio;
        $libro->paginas =$request->paginas;
        $libro->anio =$request->anio;
        $libro->id_autor =$autor->id;
        $libro->save();
    }

}
