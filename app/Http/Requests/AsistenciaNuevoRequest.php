<?php

namespace App\Http\Requests;

use App\Data\AsistenciaData;
use Illuminate\Foundation\Http\FormRequest;

class AsistenciaNuevoRequest extends FormRequest
{
    public array $datos;

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
            'inscripcionid' => 'required',
            'inasistio' => 'required',
            'fechainasistencia' => 'required',
            'justificada' => 'required',
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
            'inscripcionid.required' => 'Es un campo obligatorio',
            'inasistio.required' => 'Es un campo obligatorio',
            'fechainasistencia.required' => 'Es un campo obligatorio',
            'justificada.required' => 'Es un campo obligatorio',
        ];
    }

    public function passedValidation()
    {
        $this->datos[] = AsistenciaData::from([
            'inscripcionid' => $this->inscripcionid,
            'asistenciaasistio' => $this->inasistio,
            'asistenciafecha' => $this->fechainasistencia,
            'asistenciajustificada' => $this->justificada,
            'asistenciamotivo' => $this->motivo,
        ]);
    }
}
