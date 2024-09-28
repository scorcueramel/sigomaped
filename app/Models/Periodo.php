<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $fillable = ['periodo'];

    public function anioIngreso(){
        $this->belongsTo(AnioIngreso::class);
    }
}
