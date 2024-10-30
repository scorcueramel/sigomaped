<?php

namespace App\Data;

use Spatie\LaravelData\Data;


class AsistenciaData extends Data{

    public function __construct(
        public int $asistenciaid,
        public string $asistenciafecha,
        public ?bool $asistenciaasistio,
        public ?bool $asistenciajustificada,
        public ?string $asistenciamotivo,

    ){}
}
