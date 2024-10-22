<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CondicionSocioEconomicaData extends Data{
    public function __construct(
        public int $cseid,
        public string $csedescripcion,
        public ?string  $csemensaje,
    ){}
}
