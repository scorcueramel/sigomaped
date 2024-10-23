<?php

namespace App\Data;
use Spatie\LaravelData\Data;

class TallerData extends Data{

    public function __construct(
        public ?int $programaid,
        public ?int $tipotallerid,
        public ?string $nombre,
        public ?int $tallerid,
        public ?string $tallernombre,
    ){}
}
