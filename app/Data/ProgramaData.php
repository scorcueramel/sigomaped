<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class ProgramaData extends Data{

    public function __construct(
        public int $programaid,
        public string $nombre,
    ){}
}
