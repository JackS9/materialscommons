<?php

namespace App\Http\Controllers\Api\Materials;

use App\Http\Controllers\Controller;
use App\Http\Queries\Materials\SingleMaterialQuery;
use App\Http\Resources\Materials\MaterialResource;

class ShowMaterialApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  SingleMaterialQuery  $query
     * @return MaterialResource
     */
    public function __invoke(SingleMaterialQuery $query)
    {
        $data = $query->get();
        return new MaterialResource($data[0]);
    }
}
