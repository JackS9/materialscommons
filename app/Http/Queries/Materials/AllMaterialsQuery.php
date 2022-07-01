<?php

namespace App\Http\Queries\Materials;

use App\Models\Material;
use Illuminate\Http\Request;

class AllMaterialsForProjectQuery extends MaterialsQueryBuilder
{
    public function __construct(Builder $builder, ?Request $request = null)
    {
        parent::__construct($builder, $request);
    }
}