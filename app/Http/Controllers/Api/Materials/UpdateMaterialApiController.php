<?php

namespace App\Http\Controllers\Api\Materials;

use App\Actions\Materials\UpdateMaterialAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Materials\UpdateMaterialRequest;
use App\Http\Resources\Materials\MaterialResource;
use App\Models\Material;

class UpdateMaterialApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  UpdateMaterialRequest  $request
     * @param  UpdateMaterialAction  $updateMaterialAction
     * @param  Material  $Material
     * @return MaterialResource
     */
    public function __invoke(UpdateMaterialRequest $request, UpdateMaterialAction $updateMaterialAction, Material $material)
    {
        $validated = $request->validated();
        $material = $updateMaterialAction($validated, $material);
        return new MaterialResource($material);
    }
}
