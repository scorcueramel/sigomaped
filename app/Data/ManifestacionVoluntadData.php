<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ManifestacionVoluntadData extends Data {

    public function __construct(
        public int $manifestacionid,
        public string $manifestacion,
        public ?string $manifestacionmensaje
    ){}

}
