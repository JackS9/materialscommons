<?php

namespace App\Http\Controllers\Api\Materials;

use App\Http\Controllers\Controller;
use App\Http\Queries\Materials\AllMaterialsQuery;
use App\Http\Resources\Materials\MaterialResource;
use Illuminate\Http\Request;

class IndexMaterialsApiController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = new AllMaterialsQuery($request);
        return MaterialResource::collection($query->jsonPaginate());
    }
}
