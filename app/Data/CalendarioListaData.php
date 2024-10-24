<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CalendarioListaData extends Data {

    public function __construct(
        public string $title,
        public string $start,
        public string $end,
        public string $dia,
        public int $cicloid,
        public string $anio,
        public string $periodo,
        public int $tallerid,
        public string $taller,
        public int $programaid,
        public string $programa,
        public ?string $nomnbrerepre,
        public ?string $telefonorepre,
        public ?string $correorepre,
    ) {}

}
