<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class InscripcionNuevoData extends Data
{
    public function __construct(
        public int $alumnoid,
        public int $horarioid,
        public string $fechainscripcion,
        public ?int $cicloid,
    ) {}
}
