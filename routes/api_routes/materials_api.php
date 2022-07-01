<?php

use App\Http\Controllers\Api\Materials\CreateMaterialApiController;
use App\Http\Controllers\Api\Materials\DeleteMaterialApiController;
use App\Http\Controllers\Api\Materials\IndexMaterialsApiController;
use App\Http\Controllers\Api\Materials\ShowMaterialApiController;
use App\Http\Controllers\Api\Materials\UpdateMaterialApiController;
use Illuminate\Support\Facades\Route;

/**
 * @apiDefine MaterialsParams
 * @apiParam (URL Parameters) {String} api_token Mandatory API token
 * @apiParam (Body Parameters) {String} name name of Material
 * @apiParam (Body Parameters) {String} [description] description of Material
 */

/**
 * @api {post} /Materials Create a new Material
 * @apiGroup Materials
 * @apiName CreateMaterial
 * @apiDescription Creates a new Material
 * @apiUse MaterialsParams
 */
Route::post('/Materials', CreateMaterialApiController::class);

/**
 * @api {put} /Materials/{Material_id} Update an existing Material
 * @apiGroup Materials
 * @apiName UpdateMaterial
 * @apiDescription Change attributes of an existing Material
 * @apiUse MaterialsParams
 */
Route::put('/Materials/{Material}', UpdateMaterialApiController::class);

/**
 * @api {delete} /Materials/{Material_id} Delete an existing Material
 * @apiGroup Materials
 * @apiName DeleteMaterial
 * @apiDescription Delete an existing Material and all its relationships
 * @apiUse APITokenParam
 */
Route::delete('/entitites/{Material}', DeleteMaterialApiController::class);

/**
 * @api {get} /Materials/{Material_id} Show an existing Material
 * @apiGroup Materials
 * @apiName ShowMaterial
 * @apiDescription Show details of a Material user has access to
 * @apiUse APITokenParam
 */
Route::get('/Materials/{Material}', ShowMaterialApiController::class);

Route::get('/Materials', IndexMaterialsApiController::class);
