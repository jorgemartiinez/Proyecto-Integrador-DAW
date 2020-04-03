<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Description of StoreHijo
 *
 * @author harve
 */
class StoreHijo extends FormRequest {
    
    public function authorize(){
        
        return true;
    }
    
    public function rules(){
        
        return[
            'username' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'dni' => 'required',
            'fec_nac' => 'required',
            'curso_escolar' => 'required',
        ];
    }
}
