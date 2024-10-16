<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class PersonaData extends Data{
    public function __construct(
        // tipo de persona
        public ?int $tipopersonaid,
        public ?string $tipopersona,
        // personas tambien se usa para usuario y representante
        public ?int $personaid,
        public string $documento,
        public string $nombres,
        public string $apellidos,
        // usuario y correo tambien se usa para representante
        public ?string $correo,
        public ?string $password,
        // repesentante
        public ?int $alumnoid,
        public ?string $telefono,
        // genero
        public ?int $genero,
        public ?string $tipogenero,
        // anio
        public ?int $anioingresoid,
        public ?string $anio,
        public ?string $periodo,
        // tipo seguro
        public ?int $tiposeguroid,
        public ?string $tiposeguro,
        // condicion socioeconomica
        public ?int $condsocecoid,
        public ?string $condsocecocondicion,
        // manifestacion voluntad
        public ?int $manifvolid,
        public ?string $manifvolmanifestacion,
        // acreditacion residencia
        public ?int $acredresid,
        public ?string $acredresacreditacion,
        // tipo discapacidad
        public ?int $tipodiscapaid,
        public ?string $tipodiscapadiscapacidad,
        // alumno
        public ?string $fecinscalumno,
        public ?string $dsexpinsc,
        public ?string $distrito,
        public ?string $sector,
        public ?string $domicilio,
        public ?string $fecnac,
        public ?string $rocarnetconadis,
        public ?bool $solisinsc,
        public ?string $consempadrosisfoh,
        public ?bool $copiadni,
        public ?bool $informemed,
        public ?bool $reciboserv,
        public ?bool $copiacarnetconadis,
        public ?bool $docdigital,
    ){}
}
