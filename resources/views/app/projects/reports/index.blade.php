@extends('layouts.app')

@section('pageTitle', 'Create Report')

@section('nav')
    @include('layouts.navs.app.project')
@stop

@section('content')
    @component('components.card')
        @slot('header')
            Projects
            <a class="action-link float-right"
               href="{{route('projects.create')}}">
                <i class="fas fa-plus mr-2"></i>Create Project
            </a>
        @endslot

        @slot('body')
            <table id="reports" class="table table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Report</th>
                    <th>Summary</th>
                    <th>Updated</th>
                    {{--                    <th>Date</th>--}}
                    {{--                    <th></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>
                            <a href="{{route('projects.reports.show', [$project, $report])}}" class="">
                                {{$report->name}}
                            </a>
                        </td>
                        <td>{{$report->summary}}</td>
                        <td>{{$report->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endslot
    @endcomponent
@stop

@push('scripts')
    <script>
        $(document).ready(() => {
            $('#reports').DataTable({
                stateSave: true,
                // columnDefs: [
                //     {orderData: [4], targets: [3]},
                //     {targets: [4], visible: false, searchable: false},
                // ]
            });
        });
    </script>
@endpush