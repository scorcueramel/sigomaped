<?php

namespace App\Data;
use Spatie\LaravelData\Data;
class DistritosData extends Data {
    public function __construct(
        public string $distrito,
        public string $codigopostal,
    )
    {}
}
