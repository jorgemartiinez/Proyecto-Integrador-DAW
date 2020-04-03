<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Description of ValidacionRegistro
 *
 * @author harve
 */
class StoreContacto extends FormRequest {
    
    public function authorize(){
        
        return true;
    }
    
    public function rules(){
        
        return[
            'nombre' => 'required|string|max:100',
            'asunto' => 'required|string|max:150',
            'email' => 'required|email|max:250',
            'mensaje' => 'required|max:280',
            
        ];
    }
}
