<?php

namespace App\Services;

use App\Models\Alumno;
use App\Models\PadreAlumno;
use App\Models\Persona;
use App\Models\Representante;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            if ($d->tipopersonaid == 5)
                return $this->registerRepresentante($d,$usuarioActualiza);
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
        $alumno = Alumno::where('persona_id',$data->alumnoid)->get()[0];
        $nuevaPersona = new Persona();
        $nuevaPersona->tipo_persona_id = $data->tipopersonaid;
        $nuevaPersona->documento = $data->documento;
        $nuevaPersona->nombres = Str::upper($data->nombres);
        $nuevaPersona->apellidos = Str::upper($data->apellidos);
        $nuevaPersona->save();
        $padreAlumno = new PadreAlumno();
        $padreAlumno->persona_id = $nuevaPersona->id;
        $padreAlumno->alumno_id = $alumno->id;
        $padreAlumno->save();
        return 200;
    }

    public function registerRepresentante($data,$usuario)
    {
        $alumno = Alumno::where('persona_id',$data->alumnoid)->get()[0];

        $nuevaPersona = new Persona();
        $nuevaPersona->tipo_persona_id = $data->tipopersonaid;
        $nuevaPersona->documento = $data->documento;
        $nuevaPersona->nombres = Str::upper($data->nombres);
        $nuevaPersona->apellidos = Str::upper($data->apellidos);
        $nuevaPersona->save();
        $nuevoRepresentante = new Representante();
        $nuevoRepresentante->persona_id = $nuevaPersona->id;
        $nuevoRepresentante->alumno_id = $alumno->id;
        $nuevoRepresentante->telefono = $data->telefono;
        $nuevoRepresentante->email = $data->correo;
        $nuevoRepresentante->usuario_actualiza = Str::upper($usuario);
        $nuevoRepresentante->save();

        return 200;
    }
}
