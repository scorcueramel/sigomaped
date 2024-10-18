<?php

namespace App\Services;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonaService{
    public function getPersonas($documento){
        $persona = Persona::where('documento',$documento)
                    ->where('tipo_persona_id',6)
                    ->with('tipo_persona')
                    ->get();
        return $persona;
    }

    public function registerDatosGenerales(array $data){
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres . ' ' . $obtenerUsuario[0]->persona->apellidos;

        foreach($data as $d){
            $existUser = User::where('email',$d->correo)->get();

            if(count($existUser)>0)
                return 100;

            if($d->tipopersonaid == 1 || $d->tipopersonaid == 2){
                $nuevaPersona = new Persona();
                $nuevaPersona->tipo_persona_id = $d->tipopersonaid;
                $nuevaPersona->documento = $d->documento;
                $nuevaPersona->nombres = Str::upper($d->nombres);
                $nuevaPersona->apellidos = Str::upper($d->apellidos);
                $nuevaPersona->save();
                $nuevoUsuario = new User();
                $nuevoUsuario->persona_id = $nuevaPersona->id;
                $nuevoUsuario->email = $d->correo;
                $nuevoUsuario->password = Hash::make($d->password);
                $nuevoUsuario->usuario_actualiza = Str::upper($usuarioActualiza);
                $nuevoUsuario->save();

                return 200;
            }
        }
    }
}
