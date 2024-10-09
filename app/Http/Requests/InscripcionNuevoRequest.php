<?php

namespace App\Http\Requests;

use App\Data\InscripcionNuevoData;
use Illuminate\Foundation\Http\FormRequest;

class InscripcionNuevoRequest extends FormRequest
{

    public array $inscripcion;

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
            'alumnoId' => 'required|numeric',
            'horarioId' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'alumnoId.required' => 'Debes seleccionar un alumno para inscribir',
            'horarioId.required' => 'Debes seleccionar un horario',
        ];
    }

    public function passedValidation(){
        $this->inscripcion[] = InscripcionNuevoData::from(['alumnoid'=>$this->alumnoId,'horarioid'=>$this->horarioId]);
    }
}
