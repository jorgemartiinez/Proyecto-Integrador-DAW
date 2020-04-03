<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Nivel;

class NivelController extends Controller
{
    
    public function getNivel($id){
        
        $id_nivel = DB::table('nivel_post')->where('id_post', $id)->pluck('id_nivel');

        $nivel = Nivel::whereIn('id', $id_nivel)->pluck('nombre');
        
        return implode(', ', $nivel->toArray());
    }
    
    public function getNivelNombres($id){
        
        $id_nivel = DB::table('nivel_evento')->where('id_evento', $id)->pluck('id_nivel');

        $nivel = Nivel::whereIn('id', $id_nivel)->pluck('nombre');
        
        return $nivel->toArray();
    }
    
    //Funcion que devuelte todos los niveles de la tabla
    public function getNiveles(){
        
        return Nivel::all();
    }
    
    public function getNivelesEvento($id){
        
        $niveles = DB::table('nivel_evento')->where('id_evento', $id)->pluck('id_nivel');
        
        return $niveles->toArray();
        
        
        
    }
    
}
