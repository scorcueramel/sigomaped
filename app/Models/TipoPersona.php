<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPersona extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_persona'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function persona(){
        return $this->hasMany(Persona::class);
    }
}
