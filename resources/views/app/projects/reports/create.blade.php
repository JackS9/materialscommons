@extends('layouts.app')

@section('pageTitle', 'Create Report')

@section('nav')
    @include('layouts.navs.app.project')
@stop

@section('content')
    <form method="post" action="{{route('projects.reports.store', [$project])}}" id="create-report">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}"
                   placeholder="Name...">
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <input class="form-control" id="summary" name="summary" type="text" value="{{old('summary')}}"
                   placeholder="Summary...">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" type="text"
                      placeholder="Description...">{{old('description')}}</textarea>
        </div>
        <div class="float-right">
            <a href="{{route('projects.reports.index', [$project])}}" class="action-link danger mr-3">
                Cancel
            </a>
            <a class="action-link mr-3" href="#" onclick="document.getElementById('create-report').submit()">
                Create
            </a>
        </div>
    </form>
@stop