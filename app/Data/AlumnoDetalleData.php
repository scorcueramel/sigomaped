<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AlumnoDetalleData extends Data {
    public function __construct(
        public ?string $fecha_inicio,
        public ?string $fecha_fin,
        public ?string $dia,
        public ?string $nombre_alumno,
        public ?string $tipo_taller,
        public ?string $ciclo_id,
        public ?string $anio,
        public ?string $periodo,
        public ?string $taller_id,
        public ?string $taller,
        public ?string $programaid,
        public ?string $programa,
        public ?string $email_rep,
        public ?string $tel_rep,
        public ?string $nombre_rep,
        public ?string $nombre_padre,
        public ?string $nombre_madre,
    ) {}
}
