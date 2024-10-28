<?php

namespace App\Http\Requests;

use App\Data\PersonaData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonaNuevoRequest extends FormRequest
{

    public array $datos;
    // public array $padre;
    // public array $representante;
    // public array $alumno;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tipopersonaid' => 'required|numeric',
            'documento' => 'required|unique:personas,documento|string|min:8|max:12',
            'nombres' => 'required|string|min:3|max:50',
            'apellidos' => 'required|string|max:100',
            'email' => [Rule::requiredIf(Request::get('tipopersonaid') == 1)],
            ['unique:users'],
            ['email'],
            ['string'],
            'password' => 'min:8|string',
            'password_confirmation' => 'same:password|min:8',
            'genero' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'tiposeguro' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'anioperiodo' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'cse' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'manifestacion' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'tipodiscapacidad' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'fechainscripcion' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'dsexpisncripcion' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'distrito' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            // 'sector' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            // 'subsector' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'domicilio' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'fechanacimiento' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'rocarnetconadis' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'empadronamientosisfoh' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'solicitudinscripcion' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'copiadni' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'informemedico' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'recibosercivios' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'carnetconadis' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
            'documentaciondigital' => [Rule::requiredIf(Request::get('tipopersonaid') == 6)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tipopersonaid.required' => 'Es un campo requerido',
            'documento.required' => 'Ingresar el documento de la persona es obligatorio.',
            'documento.min' => 'El documento debe contar con un minimo de 8 caracteres.',
            'documento.unique' => 'El documento ingresado ya fue registrado anteriormente.',
            'nombres.required' => 'Ingresar nombre de la persona es obligatorio.',
            'nombres.min' => 'El nombre debe contar con un minimo de 3 caracteres.',
            'apellidos.required' => 'Ingresar el apellido de la persona es obligatorio.',
            'email.unique' => 'El correo ingresado ya fue registrado anteriormente.',
            'email.required' => 'Ingresar el correo es obligatorio.',
            'password.min' => 'La contraseña deben con un minimo de 8 caracteres.',
            'password_confirmation.same' => 'Las contraseñas deben coincidir.',
            'password_confirmation.min' => 'La contraseña deben con un minimo de 8 caracteres.',
            'genero.required' => 'Indicar el genero del alumno es obligatorio.',
            'tiposeguro.required' => 'Indicar el tipo de seguro del alumno es obligatorio.',
            'anioperiodo.required' => 'Indicar el año y periodo del alumno es obligatorio.',
            'cse.required' => 'Indicar la condición socio económica del del alumno es obligatorio.',
            'manifestacion.required' => 'Indicar la manifestación de voluntad del alumno es obligatorio.',
            'tipodiscapacidad.required' => 'Indicar el tipo de discapadidad del alumno es obligatorio.',
            'fechainscripcion.required' => 'Indicar la fecha de inscripción del alumno es obligatorio.',
            'solicitudinscripcion.required' => 'Indicar la solicitud de inscripcion del alumno es obligatorio.',
            'dsexpisncripcion.required' => 'Indicar ds. exp. inscripción del alumno es obligatorio.',
            'distrito.required' => 'Indicar el distrito del alumno es obligatorio.',
            // 'sector.required'=> 'Indicar el sector del alumno es obligatorio.',
            // 'subsector.required'=> 'Indicar el subsector del alumno es obligatorio.',
            'domicilio.required' => 'Indicar el domicilio del alumno es obligatorio.',
            'fechanacimiento.required' => 'Indicar el fecha de nacimiento del alumno es obligatorio.',
            'rocarnetconadis.required' => 'Indicar el ro. carnet conadis del alumno es obligatorio.',
            'empadronamientosisfoh.required' => 'Indicar la const. de empadronamiento sisfoh del alumno es obligatorio.',
            'copiadni.required' => 'Indicar la copia del dni del alumno es obligatorio.',
            'informemedico.required' => 'Indicar el informe medico del alumno es obligatorio.',
            'recibosercivios.required' => 'Indicar el recibo de servicio del alumno es obligatorio.',
            'carnetconadis.required' => 'Indicar la copia de canet conadis del alumno es obligatorio.',
            'documentaciondigital.required' => 'Indicar la documentacion digital del alumno es obligatorio.',
        ];
    }

    public function passedValidation()
    {
        $tipopersona = $this->tipopersonaid;

        $this->cargaDto($tipopersona);
    }

    private function cargaDto($personatipo)
    {
        if ($personatipo == 1 || $personatipo == 2) {
            $this->datos[] = PersonaData::from([
                'tipopersonaid' => $personatipo,
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'correo' => $this->email,
                'password' => $this->password,
            ]);
        }

        if ($personatipo == 3 || $personatipo == 4) {
            $this->datos[] = PersonaData::from([
                'tipopersonaid' => $personatipo,
                'alumnoid' => $this->alumnoid,
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos
            ]);
        }

        if ($personatipo == 5) {
            $this->datos[] = PersonaData::from([
                'tipopersonaid' => $personatipo,
                'alumnoid' => $this->alumnoid,
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
            ]);
        }

        if ($personatipo == 6) {
            $this->datos[] = PersonaData::from([
                'tipopersonaid' => $personatipo,
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'generoid' => $this->genero,
                'anioingresoid' => $this->anioperiodo,
                'tiposeguroid' => $this->tiposeguro,
                'condsocecoid' => $this->cse,
                'manifvolid' => $this->manifestacion,
                'acredresid' => $this->acreditacionderesidencia, //pendiente de campo en la vista
                'tipodiscapaid' => $this->tipodiscapacidad,
                'fecinscalumno' => $this->fechainscripcion,
                'dsexpinsc' => $this->dsexpisncripcion,
                'distrito' => $this->distrito,
                'sector' => $this->sector,
                'subsector' => $this->subsector,
                'domicilio' => $this->domicilio,
                'fecnac' => $this->fechanacimiento,
                'rocarnetconadis' => $this->rocarnetconadis,
                'solisinsc' => $this->solicitudinscripcion,
                'consempadrosisfoh' => $this->empadronamientosisfoh,
                'copiadni' => $this->copiadni,
                'informemed' => $this->informemedico,
                'reciboserv' => $this->recibosercivios,
                'copiacarnetconadis' => $this->carnetconadis,
                'docdigital' => $this->documentaciondigital,
            ]);
        }
    }
}
