<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class PersonaListaEsperaData extends Data{

    public function __construct(
        public int $personaid,
        public int $tallerid,
        public string $documento,
        public string $nombres,
        public string $apellidos,
    ){}
}
