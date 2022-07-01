<?php

namespace App\Actions\Materials;

use App\Models\Activity;
use App\Models\Material;
use App\Models\MaterialState;
use App\Traits\MaterialStates\AddMaterialStateAttributes;

class CreateMaterialAction
{
    use AddMaterialStateAttributes;

    public function __invoke($data, $userId)
    {
        $materialsData = collect($data)->except('experiment_id')->toArray();
        $materialsData['owner_id'] = $userId;
        $material = Material::create($materialsData);
        $materialState = MaterialState::create([
            'owner_id'  => $userId,
            'Material_id' => $material->id,
            'current'   => true,
        ]);

        if (array_key_exists('experiment_id', $data)) {
            $material->experiments()->attach($data['experiment_id']);
        }

        if (array_key_exists('activity_id', $data)) {
            $activity = Activity::findOrFail($data['activity_id']);
            $activity->Materials()->attach($material);
            $activity->MaterialStates()->attach([$materialState->id => ['direction' => 'out']]);
        }

        $material->refresh();

        if (!array_key_exists('attributes', $data)) {
            return $material;
        }

        $this->addSampleAttributes($materialState, $data['attributes']);

        return $material;
    }
}