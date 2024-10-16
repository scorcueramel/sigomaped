<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class GeneroData extends Data{
    public function __construct(
        public int $generoid,
        public string $generotipo,
    ){}
}
