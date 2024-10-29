<?php

namespace App\Services;

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

    public function getLastTenPersons(): array
    {
        $personas = DB::select("SELECT
                                            tp.id AS tipo_persona_id, tp.tipo_persona AS tipo_persona_descripcion, p.id AS persona_id,
                                            p.nombres as persona_nombre, p.apellidos as persona_apellido, p.documento AS persona_documento
                                        FROM personas p
                                        LEFT JOIN tipo_personas tp ON p.tipo_persona_id  = tp.id
                                        ORDER BY p.id DESC LIMIT 5;");
        foreach ($personas as $persona) {
            $this->personas[] = PersonaData::from([
                'tipopersonaid' => $persona->tipo_persona_id,
                'tipopersona' => $persona->tipo_persona_descripcion,
                'personaid' => $persona->persona_id,
                'documento' => $persona->persona_documento,
                'nombres' => $persona->persona_nombre,
                'apellidos' => $persona->persona_apellido,
            ]);
        }

        return $this->personas;
    }

    public function getPersonasByDocumento($documento)
    {
        $persona = Persona::where('documento', $documento)
            ->where('tipo_persona_id', 6)
            ->with('tipo_persona')
            ->get();

        return $persona;
    }

    public function getRegisterSeach(?string $buscar)
    {
        return  Persona::where('tipo_persona_id', $buscar)->with('tipo_persona')->paginate(5);
    }

    public function getLastRegisters()
    {
        $ultimoRegistros = Persona::leftJoin('tipo_personas', 'tipo_personas.id', '=', 'personas.tipo_persona_id')
            ->select("tipo_personas.id as tipopersona_id", "tipo_personas.tipo_persona as tipopersona_descripcion", "personas.id as persona_id", "personas.documento as persona_documento", "personas.nombres as persona_nombres", "personas.apellidos as persona_apellidos")
            ->orderBy('personas.id', 'desc')
            ->limit(10)
            ->take(-1)
            ->get();

        foreach ($ultimoRegistros as $ut) {
            $this->personas[] = collect(PersonaData::from((object)[
                'tipopersonaid' => $ut->tipopersona_id,
                'tipopersona' => $ut->tipopersona_descripcion,
                'personaid' => $ut->persona_id,
                'documento' => $ut->persona_documento,
                'nombres' => $ut->persona_nombres,
                'apellidos' => $ut->persona_apellidos,
            ]));
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
