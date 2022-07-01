<?php

namespace App\Actions\Materials;

use App\Models\Material;
use App\Models\MaterialState;
use Illuminate\Support\Facades\DB;

class DeleteMaterialAction
{
    public function __invoke(Material $material)
    {
        DB::transaction(function () use ($material) {
            $material->MaterialStates()->get()->each(function (MaterialState $ms) {
                $ms->attributes()->delete();
                $ms->delete();
            });
            $material->delete();
        });
    }
}
