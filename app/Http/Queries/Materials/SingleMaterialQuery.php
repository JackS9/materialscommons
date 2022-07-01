<?php

namespace App\Http\Queries\Materials;

use App\Models\Material;
use App\Traits\GetRequestParameterId;
use Illuminate\Http\Request;

class SingleMaterialQuery extends MaterialsQueryBuilder
{
    use GetRequestParameterId;

    public function __construct(?Request $request = null)
    {
        $materialId = $this->getParameterId('material');
        $query = Material::with(['owner'])
                       ->where('id', $materialId);
        parent::__construct($query, $request);
    }
}
