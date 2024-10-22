<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class TipoDiscapacidadData extends Data{
    public function __construct(
        public int $tipodiscapacidadid,
        public string $tipodiscapacidad,
        public ?string $tipodiscapacidadmensaje,
    ){}
}
