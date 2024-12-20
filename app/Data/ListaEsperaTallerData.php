<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ListaEsperaTallerData extends Data {

    public function __construct(
        public int $alumnoid,
        public int $tallerid,
        public string $inscrito,
        public ?string $tallernombre,
    ) {}

}
