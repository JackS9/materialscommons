<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Traits\Projects\UserProjects;
use Illuminate\Http\Request;

class IndexGlobusBookmarksWebController extends Controller
{
    use UserProjects;

    public function __invoke(Request $request)
    {
        $projects = $this->getUserProjects(auth()->id());
        return view('app.dashboard.index', [
            'projects'               => $projects,
            'projectsCount'          => $projects->count(),
            'publishedDatasetsCount' => Dataset::whereNotNull('published_at')
                                               ->where('owner_id', auth()->id())
                                               ->count(),
        ]);
    }
}
