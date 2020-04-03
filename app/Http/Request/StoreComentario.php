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
class StoreComentario extends FormRequest {

    public function authorize(){

        return true;
    }

    public function rules(){

        return[
            'user_id' => 'required',
            'post_id' => 'required',
            'mensaje' => 'required|string|max:255',

        ];
    }
}
