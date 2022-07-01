<?php

namespace App\Http\Queries\Materials;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MaterialsQueryBuilder extends QueryBuilder
{
    public function __construct($builder, ?Request $request = null)
    {
        parent::__construct($builder, $request);
        $this->allowedFields(['name', 'id', 'uuid', 'description'])
             ->allowedIncludes(['activities', 'files', 'projects']);
    }
}
