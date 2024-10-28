<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class AcreditacionResidenciaData extends Data {

    public function __construct(
        public ?int $acredresidid,
        public ?string $acreditacionresidencia,
    ){}

}
