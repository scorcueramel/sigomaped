<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class PersonaInscritaData extends Data {

    public function __construct(
        public ?string $personainscritaid,
        public ?string $personainscritanombre,
        public ?string $personainscritadocumento,

    ) {}

}
