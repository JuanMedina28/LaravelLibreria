<?php

namespace App\Http\Controllers;

use App\Models\m_libros;
use Illuminate\Http\Request;

class libros_controller extends Controller
{
    public function lista_libros(){
        $libros = m_libros::all();
        return $libros;
    }
}
