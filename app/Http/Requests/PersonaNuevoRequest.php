<?php

namespace App\Http\Requests;

use App\Data\PersonaData;
use Illuminate\Foundation\Http\FormRequest;

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
            'email' => 'unique:users,email|string',
            'password' => 'min:8|string',
            'password_confirmation' => 'same:password|min:8'
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
            'tipopersonaid.required' => 'es un campo requerido',
            'documento.required' => 'El documento de la persona es obligatorio.',
            'documento.min' => 'El documento debe contar con un minimo de 8 caracteres.',
            'documento.unique' => 'El documento ingresado ya fue registrado anteriormente.',
            'nombres.required' => 'El nombre de la persona es obligatorio.',
            'nombres.min' => 'El nombre debe contar con un minimo de 3 caracteres.',
            'apellidos.required' => 'El apellido de la persona es obligatorio.',
            'email.unique'=> 'El correo ingresado ya fue registrado anteriormente.',
            'password.min'=> 'La contraseña deben con un minimo de 8 caracteres.',
            'password_confirmation.same'=> 'Las contraseñas deben coincidir.',
            'password_confirmation.min'=> 'La contraseña deben con un minimo de 8 caracteres.',
        ];
    }

    public function passedValidation()
    {
        $tipopersona = $this->tipopersonaid;

        $this->cargaDto($tipopersona);
    }

    private function cargaDto($personatipo){
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
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos
            ]);
        }

        if ($personatipo == 5) {
            $this->datos[] = PersonaData::from([
                'alumnoid'=>$this->alumnoid,
                'tipopersonaid' => $personatipo,
                'documento' => $this->documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
            ]);
        }
    }
}
