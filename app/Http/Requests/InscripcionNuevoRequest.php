<?php

namespace App\Http\Requests;

use App\Data\InscripcionNuevoData;
use App\Data\PersonaEsperaTallerData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class InscripcionNuevoRequest extends FormRequest
{

    public array $inscripcion;
    public array $personaespera;

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
            'alumnoId' => 'required',
            'listaEspera' => 'required',
            'tallerId' => 'required',
        ];
    }

    public function passedValidation()
    {
        $fechainscripcion = Carbon::today()->format('Y-m-d');
        if ($this->listaEspera == "0") {
            $this->inscripcion[] = InscripcionNuevoData::from(['alumnoid' => $this->alumnoId, 'horarioid' => $this->horarioId, 'fechainscripcion' => $fechainscripcion]);
        } elseif ($this->listaEspera == "1") {
            $this->personaespera[] = PersonaEsperaTallerData::from(['alumnoid' => $this->alumnoId, 'tallerid' => $this->tallerId, 'inscrito' => 'E']);
        }
    }
}
