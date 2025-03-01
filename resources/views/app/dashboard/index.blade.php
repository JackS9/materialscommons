@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('nav')
    @include('layouts.navs.app')
@stop

@if (Request::routeIs('dashboard'))
    @section('breadcrumbs', Breadcrumbs::render('dashboard'))
@elseif(Request::routeIs('dashboard.projects.show'))
    @section('breadcrumbs', Breadcrumbs::render('dashboard.projects.show'))
@elseif(Request::routeIs('dashboard.published-datasets.show'))
    @section('breadcrumbs', Breadcrumbs::render('dashboard.published-datasets.show'))
@endif

@section('content')
    <x-card>
        <x-slot name="header">
            Dashboard
        </x-slot>
        <x-slot name="body">
            @include('app.dashboard.tabs.tabs')
            <br>
            @if (Request::routeIs('dashboard.projects.show'))
                @include('app.dashboard.tabs.projects')
            @elseif (Request::routeIs('dashboard.published-datasets.show'))
                @include('app.dashboard.tabs.published-datasets')
            @elseif (Request::routeIs('dashboard.data-dictionary.show'))
                @include('app.dashboard.tabs.data-dictionary')
            @elseif(Request::routeIs('dashboard.globus-bookmarks.index'))
                @include('app.dashboard.tabs.globus-bookmarks')
            @endif
        </x-slot>
    </x-card>
@endsection
