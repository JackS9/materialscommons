<?php

namespace App\Http\Controllers\Web\Reports;

use App\Charts\SampleChart;
use App\Http\Controllers\Controller;
use App\Models\Experiment;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Http\Request;

class ShowProjectReportWebController extends Controller
{
    public function __invoke(Request $request, Project $project, Report $report)
    {
        $chart = $this->createChart();
        $tiles = $report->tiles()->get();
        $tiles[0]->setChart($chart);
        return view('app.projects.reports.show', [
            'project' => $project,
            'report'  => $report,
            'tiles'   => $tiles,
        ]);
    }

    private function createChart()
    {
        $chart = new SampleChart;
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
        return $chart;
    }
}
