<?php

namespace App\Services;

use App\Data\AlumnoDetalleData;
use App\Data\PersonaData;
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
    public array $personas = [];

    public function getPersonasByDocumento($documento)
    {
        $persona = Persona::where('documento', $documento)
            ->where('tipo_persona_id', 6)
            ->with('tipo_persona')
            ->get();

        return $persona;
    }

    public function getRegisterSeach(?int $tipopersona)
    {
        $personasFind = Persona::where('tipo_persona_id', $tipopersona)->with('tipo_persona')->with('alumno')->get();

        if ($tipopersona === 6) {
            foreach ($personasFind as $key => $value) {
                $this->personas[] = PersonaData::from([
                    'alumnoid' => $personasFind[$key]->alumno[0]->id,
                    'tipopersonaid' => $personasFind[$key]->tipo_persona->id,
                    'tipopersona' => $personasFind[$key]->tipo_persona->tipo_persona,
                    'personaid' => $personasFind[$key]->id,
                    'documento' => $personasFind[$key]->documento,
                    'nombres' => $personasFind[$key]->nombres,
                    'apellidos' => $personasFind[$key]->apellidos,
                ]);
            }
        } else {
            foreach ($personasFind as $key => $value) {
                $this->personas[] = PersonaData::from([
                    'tipopersonaid' => $personasFind[$key]->tipo_persona->id,
                    'tipopersona' => $personasFind[$key]->tipo_persona->tipo_persona,
                    'personaid' => $personasFind[$key]->id,
                    'documento' => $personasFind[$key]->documento,
                    'nombres' => $personasFind[$key]->nombres,
                    'apellidos' => $personasFind[$key]->apellidos,
                ]);
            }
        }

        return $this->personas;
    }

    public function getDetalleAlumnoPersona(int $alumnoid)
    {
        $detalleAlumno = DB::select("SELECT
                                                title, email_rep, tel_rep, representante, padre, madre
                                            FROM
                                                calendario_listar1(0,0,0,?)
                                            GROUP BY title, email_rep, tel_rep, representante, padre, madre", [$alumnoid]);
        foreach ($detalleAlumno as $da) {
            $this->personas[] = AlumnoDetalleData::from([
                'nombre_alumno' => $da->title,
                'email_rep' => $da->email_rep,
                'tel_rep' => $da->tel_rep,
                'nombre_rep' => $da->representante,
                'nombre_padre' => $da->padre,
                'nombre_madre' => $da->madre,
            ]);
        }

        return $this->personas;
    }

    public function registerDatosGenerales(array $data): int
    {
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres . ' ' . $obtenerUsuario[0]->persona->apellidos;

        foreach ($data as $d) {
            if ($d->tipopersonaid == 1 || $d->tipopersonaid == 2)
                return $this->registerUsuario($d, $usuarioActualiza);
            if ($d->tipopersonaid == 3 || $d->tipopersonaid == 4)
                return $this->registerPadres($d);
            if ($d->tipopersonaid == 5)
                return $this->registerRepresentante($d, $usuarioActualiza);
            if ($d->tipopersonaid == 6)
                return $this->registerAlumno($d, $usuarioActualiza);
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
        $alumno = Alumno::where('persona_id', $data->alumnoid)->get()[0];
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

    public function registerRepresentante($data, $usuario)
    {
        $alumno = Alumno::where('persona_id', $data->alumnoid)->get()[0];

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

    public function registerAlumno($data, $usuario)
    {
        $nuevaPersona = new Persona();
        $nuevaPersona->tipo_persona_id = $data->tipopersonaid;
        $nuevaPersona->documento = $data->documento;
        $nuevaPersona->nombres = Str::upper($data->nombres);
        $nuevaPersona->apellidos = Str::upper($data->apellidos);
        $nuevaPersona->save();
        $nuevoAlumno = new Alumno();
        $nuevoAlumno->persona_id = $nuevaPersona->id;
        $nuevoAlumno->genero_id = $data->generoid;
        $nuevoAlumno->anio_periodo_id = $data->anioingresoid;
        $nuevoAlumno->tipo_seguro_id = $data->tiposeguroid;
        $nuevoAlumno->cond_socio_economica_id = $data->condsocecoid;
        $nuevoAlumno->manif_volunta_id = $data->manifvolid;
        $nuevoAlumno->acred_resid_id = $data->acredresid;
        $nuevoAlumno->tipo_discapacidad_id = $data->tipodiscapaid;
        $nuevoAlumno->fecha_inscripcion = $data->fecinscalumno;
        $nuevoAlumno->ds_exp_inscripcion = $data->dsexpinsc;
        $nuevoAlumno->distrito = $data->distrito;
        $nuevoAlumno->sector = $data->sector;
        $nuevoAlumno->subsector = $data->subsector;
        $nuevoAlumno->domicilio = $data->domicilio;
        $nuevoAlumno->fecha_nacimiento = $data->fecnac;
        $nuevoAlumno->ro_carnet_conadis = $data->rocarnetconadis;
        $nuevoAlumno->solicitud_inscripcion = $data->solisinsc;
        $nuevoAlumno->cons_empadronamiento_sisfoh = $data->consempadrosisfoh;
        $nuevoAlumno->copia_dni = $data->copiadni;
        $nuevoAlumno->informe_medico = $data->informemed;
        $nuevoAlumno->recibo_serv = $data->reciboserv;
        $nuevoAlumno->copia_carnet_conadis = $data->copiacarnetconadis;
        $nuevoAlumno->documentacion_digital = $data->docdigital;
        $nuevoAlumno->save();

        return 200;
    }
}
