<?php 

namespace App\Services;

use App\Models\Programa;
use Illuminate\Support\Facades\DB;

class ProgramaService{
    public function getProgramasAll(){
        $programas = Programa::all();
        return $programas;
    }

    public function getProgramas($id)
    {
        $programas = DB::select('SELECT p.id, p.nombre FROM tallers t 
                                        LEFT JOIN programas p ON p.id = t.programa_id 
                                        LEFT JOIN tipo_tallers tt ON tt.id = t.tipo_taller_id
                                        WHERE tt.id = ?
                                        GROUP BY p.nombre, p.id', [$id]);
        return $programas;
    }
}