<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class AnioPeriodoData extends Data{

    public function __construct(
        public int $anioperiodoid,
        public string $descripcion,
        public ?string $createdat,
    ){}
}
