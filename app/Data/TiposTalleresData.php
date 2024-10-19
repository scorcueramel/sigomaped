<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TiposTalleresData extends Data
{
    public function __construct(
        public int $tipotallerid,
        public string $tipotallerdescripcion,
        public ?string $tipotallerusuact
    ) {}
}
