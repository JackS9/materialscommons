<?php

namespace App\Http\Controllers\Api\Materials;

use App\Actions\Materials\DeleteMaterialAction;
use App\Http\Controllers\Controller;
use App\Models\Material;

class DeleteMaterialApiController extends Controller
{
    public function __invoke(DeleteMaterialAction $deleteMaterialAction, $projectId, Material $material)
    {
        $deleteMaterialAction($material);
    }
}
