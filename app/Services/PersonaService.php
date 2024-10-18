<?php

namespace App\Services;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonaService
{
    public function getPersonas($documento)
    {
        $persona = Persona::where('documento', $documento)
            ->where('tipo_persona_id', 6)
            ->with('tipo_persona')
            ->get();
        return $persona;
    }

    public function registerDatosGenerales(array $data):int
    {
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres . ' ' . $obtenerUsuario[0]->persona->apellidos;

        foreach ($data as $d) {
            if ($d->tipopersonaid == 1 || $d->tipopersonaid == 2)
                return $this->registerUsuario($d, $usuarioActualiza);
            if ($d->tipopersonaid == 3 || $d->tipopersonaid == 4)
                return $this->registerPadres($d);
        }

        return 500;
    }

    public function registerUsuario($data, $usuario)
    {
        $nuevaPersona = new Persona();
        $nuevaPersona->tipo_persona_id = $data->tipopersonaid;
        $nuevaPersona->documento = $data->documento;
        $nuevaPersona->nombres = Str::upper($data->nombres);
        $nuevaPersona->apellidos = Str::upper($data->apellidos);
        $nuevaPersona->save();
        $nuevoUsuario = new User();
        $nuevoUsuario->persona_id = $nuevaPersona->id;
        $nuevoUsuario->email = $data->correo;
        $nuevoUsuario->password = Hash::make($data->password);
        $nuevoUsuario->usuario_actualiza = Str::upper($usuario);
        $nuevoUsuario->save();

        return 200;
    }
    public function registerPadres($data)
    {
        $nuevaPersona = new Persona();
        $nuevaPersona->tipo_persona_id = $data->tipopersonaid;
        $nuevaPersona->documento = $data->documento;
        $nuevaPersona->nombres = Str::upper($data->nombres);
        $nuevaPersona->apellidos = Str::upper($data->apellidos);
        $nuevaPersona->save();

        return 200;
    }
}
