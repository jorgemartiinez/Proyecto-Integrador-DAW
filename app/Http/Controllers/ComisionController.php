<?php
/**
 * Created by PhpStorm.
 * User: vesprada
 * Date: 18/02/19
 * Time: 19:39
 */

namespace App\Http\Controllers;

use App\Comision;
use App\Monitor;
use App\Tarea;
use Illuminate\Http\Request;
class ComisionController
{
    public function getComisiones()
    {
        $comisiones = Comision::all();
        return $comisiones;
    }

    public function getComision($id)
    {
        $comision = Comision::FindOrFail($id);
        return $comision;
    }

    public function getMonitoresComision($id){
        $comision=Comision::FindOrFail($id);
        $monitores=$comision->monitores()->get();
        return $monitores;
    }

    public function getMonitor($id){
        $monitor=Monitor::FindOrFail($id);
        return $monitor;
    }

    public function getTareas($id){
        $comision=Comision::FindOrFail($id);
        $tareas=$comision->tareas()->get();
        return $tareas;
    }

    public function getTarea($id){
        $tarea=Tarea::FindOrFail($id);
        return $tarea;
    }

    public function postTarea(Request $request){
        $tarea = new Tarea();
        $tarea->nombre=$request->nombre;
        $tarea->descripcion=$request->descripcion;
        $tarea->vencimiento=$request->vencimiento;
        $tarea->comision_id=$request->comision_id;
        $tarea->save();
    }

    public function putTarea(Request $request){
        $tarea = Tarea::FindOrFail($request->id);
        $tarea->nombre=$request->nombre;
        $tarea->descripcion=$request->descripcion;
        $tarea->vencimiento=$request->vencimiento;
        $tarea->comision_id=$request->comision_id;
        $tarea->save();
    }

    public function deleteTarea($id){
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
    }

    public function putEstado($id){
        $tarea=Tarea::FindOrFail($id);
        if($tarea->completada==false){
            $tarea->completada=true;
        }else{
            $tarea->completada=false;
        }
        $tarea->save();
    }

}
