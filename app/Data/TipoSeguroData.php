<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TipoSeguroData extends Data{

    public function __construct(
        public int $tipoguroid,
        public string $tiposeguro,

    )
    {}
}
