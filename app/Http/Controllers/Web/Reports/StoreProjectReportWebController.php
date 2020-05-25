<?php

namespace App\Http\Controllers\Web\Reports;

use App\Enums\TileType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\CreateReportRequest;
use App\Models\Project;
use App\Models\Report;
use App\Models\Tile;

class StoreProjectReportWebController extends Controller
{
    public function __invoke(CreateReportRequest $request, Project $project)
    {
        $validated = $request->validated();
        $validated['owner_id'] = auth()->id();
        $validated['project_id'] = $project->id;
        $report = Report::create($validated);

        $report->tiles()->save(Tile::create([
            'name'     => 'Chart',
            'type'     => TileType::Chart,
            'owner_id' => auth()->id(),
            'index'    => 0,
        ]));

        $report->tiles()->save(Tile::create([
            'name'     => 'Image',
            'type'     => TileType::File,
            'file_id'  => 29,
            'owner_id' => auth()->id(),
            'index'    => 1,
        ]));

        $report->tiles()->save(Tile::create([
            'name'     => 'Excel',
            'type'     => TileType::File,
            'file_id'  => 27,
            'owner_id' => auth()->id(),
            'index'    => 2,
        ]));

        $report->tiles()->save(Tile::create([
            'name'     => 'Not set',
            'type'     => TileType::Notset,
            'owner_id' => auth()->id(),
            'index'    => 3,
        ]));

        return redirect(route('projects.reports.show', [$project, $report]));
    }
}
