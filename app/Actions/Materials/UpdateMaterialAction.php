<?php

namespace App\Actions\Materials;

use App\Models\Material;

class UpdateMaterialAction
{
    public function __invoke($attrs, Material $material)
    {
        return tap($material)->update($material)->fresh();
    }
}
