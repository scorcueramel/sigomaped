<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'genero_id',
        'anio_periodo_id',
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

    public function anio_periodo(){
        return $this->belongsTo(AnioPeriodo::class);
    }

    public function tipo_seguro(){
        return $this->belongsTo(TipoSeguro::class);
    }

    public function condicion_socio_economica(){
        return $this->belongsTo(CondicionSocioEconomica::class);
    }

    public function manifesctacion_voluntad(){
        return $this->belongsTo(ManifestacionVoluntad::class);
    }

    public function acreditacion_residencia(){
        return $this->belongsTo(AcreditacionResidencia::class);
    }

    public function tipo_discapacidad(){
        return $this->belongsTo(TipoDiscapacidad::class);
    }

    public function diagnostico_medico(){
        return $this->hasMany(DiagnosticoMedico::class);
    }

    public function certificado_discapacidad(){
        return $this->hasMany(CertificadoDiscapacidad::class);
    }

    public function representante(){
        return $this->hasMany(Representante::class);
    }

    public function padre_alumno(){
        return $this->hasMany(PadreAlumno::class);
    }
}
