<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosAlumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'genero_id',
        'anio_ingreso_id',
        'tipo_seguro_id',
        'cond_socio_economica_id',
        'manif_volunta_id',
        'acred_resid_id',
        'tipo_discapacidad_id',
        'fecha_inscripcion',
        'ds_exp_inscripcion',
        'distrito',
        'sector',
        'subsector',
        'domicilio',
        'fecha_nacimiento',
        'ro_carnet_conadis',
        'solicitud_inscripcion',
        'cons_empadronamiento_sisfoh',
        'copia_dni',
        'informe_medico',
        'recibo_serv',
        'copia_carnet_conadis',
        'documentacion_digital',
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }

    public function anioIngreso(){
        return $this->belongsTo(AnioIngreso::class);
    }

    public function tipoSeguro(){
        return $this->belongsTo(TipoSeguro::class);
    }

    public function condicionSocioEconomica(){
        return $this->belongsTo(CondicionSocioEconomica::class);
    }

    public function manifesctacionVoluntad(){
        return $this->belongsTo(ManifestacionVoluntad::class);
    }

    public function acreditacionResidencia(){
        return $this->belongsTo(AcreditacionResidencia::class);
    }

    public function tipoDiscapacidad(){
        return $this->belongsTo(TipoDiscapacidad::class);
    }

    public function diagnosticoMedico(){
        return $this->hasMany(DiagnosticoMedico::class);
    }

    public function certificadoDiscapacidad(){
        return $this->hasMany(CertificadoDiscapacidad::class);
    }

    public function representante(){
        return $this->hasMany(Horario::class);
    }
}
