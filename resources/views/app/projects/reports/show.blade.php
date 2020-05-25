@extends('layouts.app')

@section('pageTitle', 'Create Report')

@section('nav')
    @include('layouts.navs.app.project')
@stop

@section('content')
    <div class="row">
        <div class="col-5 bg-grey-9">
            @include('app.projects.reports.show-tile', ['tile' => $tiles[0]])
        </div>
        <div class="col-5 bg-grey-9 ml-2">
            @include('app.projects.reports.show-tile', ['tile' => $tiles[1]])
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-5 bg-grey-9">
            @include('app.projects.reports.show-tile', ['tile' => $tiles[2]])
        </div>
        <div class="col-5 bg-grey-9 ml-2">
            @include('app.projects.reports.show-tile', ['tile' => $tiles[3]])
        </div>
    </div>
@stop