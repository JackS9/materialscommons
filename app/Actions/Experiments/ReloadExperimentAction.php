<?php

namespace App\Actions\Experiments;

use App\Jobs\Etl\ProcessSpreadsheetJob;
use App\Models\Experiment;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ReloadExperimentAction
{
    public function execute(Project $project, Experiment $experiment, $fileId, $sheetUrl, $userId)
    {
        try {
            DB::transaction(function () use ($project, $experiment, $fileId, $sheetUrl, $userId) {
                $experiment->activities()->delete();
                $experiment->entities()->delete();
                $experiment->files()->detach();
                ProcessSpreadsheetJob::dispatch($project->id, $experiment->id, $userId, $fileId,
                    $sheetUrl)->onQueue('globus');
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}