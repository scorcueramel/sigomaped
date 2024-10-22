<?php

namespace App\Services;

use App\Data\ManifestacionVoluntadData;
use App\Models\ManifestacionVoluntad;

class ManifestacionVoluntadService
{
    public array $manifestacionVoluntad = [];

    public function getAllManifestaciones(): array
    {
        $manifestaciones = ManifestacionVoluntad::all();
        foreach ($manifestaciones as $manifestacion) {
            $this->manifestacionVoluntad[] = ManifestacionVoluntadData::from([
                "manifestacionid" => $manifestacion->id,
                "manifestacion" => $manifestacion->manifestacion,
                "manifestacionmensaje" => '',
            ]);
        }
        return $this->manifestacionVoluntad;
    }
}
