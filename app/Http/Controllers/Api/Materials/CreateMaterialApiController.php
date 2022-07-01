<?php

namespace App\Http\Controllers\Api\Materials;

use App\Actions\Materials\CreateMaterialAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Materials\CreateMaterialRequest;
use App\Http\Resources\Materials\MaterialResource;

class CreateMaterialApiController extends Controller
{
    public function __invoke(CreateMaterialRequest $request, CreateMaterialAction $createMaterialAction)
    {
        $validated = $request->validated();
        $material = $createMaterialAction($validated, auth()->id());
        return (new MaterialResource($material))->response()->setStatusCode(201);
    }
}
