<?php

use App\Http\Controllers\Web\Reports\CreateProjectReportWebController;
use App\Http\Controllers\Web\Reports\DeleteProjectReportWebController;
use App\Http\Controllers\Web\Reports\DestroyProjectReportWebController;
use App\Http\Controllers\Web\Reports\EditProjectReportWebController;
use App\Http\Controllers\Web\Reports\IndexProjectReportsWebController;
use App\Http\Controllers\Web\Reports\ShowProjectReportWebController;
use App\Http\Controllers\Web\Reports\StoreProjectReportWebController;
use App\Http\Controllers\Web\Reports\UpdateProjectReportWebController;
use Illuminate\Support\Facades\Route;

Route::get('/projects/{project}/reports', IndexProjectReportsWebController::class)
     ->name('projects.reports.index');

Route::get('/projects/{project}/reports/create', CreateProjectReportWebController::class)
     ->name('projects.reports.create');

Route::post('/projects/{project}/reports', StoreProjectReportWebController::class)
     ->name('projects.reports.store');

Route::get('/projects/{project}/reports/{report}', ShowProjectReportWebController::class)
     ->name('projects.reports.show');

Route::get('/projects/{project}/reports/{report}/edit', EditProjectReportWebController::class)
     ->name('projects.reports.edit');

Route::put('/projects/{project}/reports/{report}/update', UpdateProjectReportWebController::class)
     ->name('projects.reports.update');

Route::get('/projects/{project}/reports/{report}/delete', DeleteProjectReportWebController::class)
     ->name('projects.reports.delete');

Route::delete('/projects/{project}/reports/{report}/destroy', DestroyProjectReportWebController::class)
     ->name('projects.reports.destroy');

