<?php

namespace App\Http\Controllers\Web\Experiments;

use App\Charts\SampleChart;
use App\Http\Controllers\Controller;
use App\Models\Experiment;
use App\Models\Project;

class ShowExperimentWebController extends Controller
{
    public function __invoke($projectId, $experimentId)
    {
        $project = Project::with('experiments')->findOrFail($projectId);
        $experiment = Experiment::with('workflows')->findOrFail($experimentId);
        // Datatables does case-insensitive sorting. The database is returning case sensitive, so
        // create a case insensitive list of the workflow items
        $workflows = $experiment->workflows->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        $chart = new SampleChart;
//        $chart->labels(['One', 'Two', 'Three', 'Four']);
//        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
//        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);
        $ex = Experiment::with(
            'entities.entityStates.attributes.values'
        )->findOrFail(7);

        $drawingForceMax = [];
        $punchStrokeAtBreak = [];
        foreach ($ex->entities as $entity) {
            foreach ($entity->entityStates as $es) {
                foreach ($es->attributes as $attr) {
                    if ($attr->name == 'Drawing Force max') {
                        foreach ($attr->values as $value) {
                            array_push($drawingForceMax, $value->val["value"]);
                        }
                    } elseif ($attr->name == 'Punch Stroke at break') {
                        foreach ($attr->values as $value) {
                            array_push($punchStrokeAtBreak, $value->val["value"]);
                        }
                    }
                }
            }
        }
        $chart->labels($punchStrokeAtBreak);
        $chart->dataset('Drawing Force Max', 'line', $drawingForceMax);
        $chart->options([
            'scales' => [
                'yAxes' => [
                    [
                        'scaleLabel' => [
                            'display'     => true,
                            'labelString' => 'Drawing Force max',
                        ],
                    ],
                ],
                'xAxes' => [
                    [
                        'scaleLabel' => [
                            'display'     => true,
                            'labelString' => 'Punch Stroke at break',
                        ],
                    ],
                ],
            ],
        ]);
        return view('app.projects.experiments.show', compact('project', 'experiment', 'workflows', 'chart'));
    }
}
