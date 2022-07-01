<?php

namespace App\Actions\Materials;

use App\Models\Activity;

class CreateUsedActivitiesForMaterialsAction
{
    public function execute($activities, $materials)
    {
        return $this->createdUsedActivities($materials, $activities);
    }

    /*
     * Loop through Materials and for each Material create a map of the list of activities and their count.
     * For example, if activites = [a,b], and Materials in = [e1 (id 1), e2 (id 2)], and only e1 is using activities a and b, then
     * you end up with:
     * $usedActivitiesForMaterials = [
     *     1 => [1,1],
     *     2 => [0,0]
     * ]
     */
    private function createdUsedActivities($materials, $activities)
    {
        $usedActivitiesForMaterials = [];
        foreach ($materials as $material) {
            $usedActivitiesForMaterials[$material->id] = [];
            foreach ($activities as $activity) {
                array_push($usedActivitiesForMaterials[$material->id],
                    $this->countActivityInMaterial($activity->name, $material));
            }
        }

        return $usedActivitiesForMaterials;
    }

    private function countActivityInMaterial($name, $material)
    {
        return $material->activities->filter(function (Activity $activity) use ($name) {
            return $activity->name === $name;
        })->count();
    }
}