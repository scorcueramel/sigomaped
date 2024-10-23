<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class DiaData extends Data
{
    public function __construct(
        public ?int $diaid,
        public ?string $dianombre,

    ) {}
}
