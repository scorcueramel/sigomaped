<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class PersonaData extends Data{
    public function __construct(
        // tipo de persona
        public ?string $tipopersonaid,
        public ?string $tipopersona,
        // personas tambien se usa para usuario y representante
        public ?string $personaid,
        public string $documento,
        public string $nombres,
        public string $apellidos,
        // usuario y correo tambien se usa para representante
        public ?string $usuarioid,
        public ?string $correo,
        public ?string $password,
        // repesentante
        public ?string $alumnoid,
        public ?string $telefono,
        // genero
        public ?string $generoid,
        public ?string $tipogenero,
        // anio
        public ?string $anioingresoid,
        public ?string $anio,
        public ?string $periodo,
        // tipo seguro
        public ?string $tiposeguroid,
        public ?string $tiposeguro,
        // condicion socioeconomica
        public ?string $condsocecoid,
        public ?string $condsocecocondicion,
        // manifestacion voluntad
        public ?string $manifvolid,
        public ?string $manifvolmanifestacion,
        // acreditacion residencia
        public ?string $acredresid,
        public ?string $acredresacreditacion,
        // tipo discapacidad
        public ?string $tipodiscapaid,
        public ?string $tipodiscapadiscapacidad,
        // alumno
        public ?string $fecinscalumno,
        public ?string $dsexpinsc,
        public ?string $distrito,
        public ?string $sector,
        public ?string $subsector,
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
