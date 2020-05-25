<?php

namespace App\Http\Controllers\Web\Reports;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class IndexProjectReportsWebController extends Controller
{
    public function __invoke(Request $request, Project $project)
    {
        return view('app.projects.reports.index', [
            'project' => $project,
            'reports' => $project->reports()->get(),
        ]);
    }
}
