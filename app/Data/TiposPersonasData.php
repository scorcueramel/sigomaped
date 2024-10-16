<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TiposPersonasData extends Data{
    public function __construct(
        public int $tipopersonaid,
        public string $tipopersonadescripcion
    ){}
}
