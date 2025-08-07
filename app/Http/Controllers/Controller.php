<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

abstract class Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view("categorias/index", ['categorias' => $categorias]);
    }


}
