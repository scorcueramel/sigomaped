<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class DatosAlumnoEsperaData extends Data {
    public function __construct(
        public int $alumnoid,
        public string $alumnonombres,
        public string $alumnoapellidos,
        public string $alumnodocumento,
        public int $tipotallerid,
        public string $tipotallerdescripcion,
        public int $programaid,
        public string $programanombre,
        public int $tallerid,
        public string $tallernombre
    ) {}
}
