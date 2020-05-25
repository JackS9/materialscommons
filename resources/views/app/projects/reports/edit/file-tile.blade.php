@extends('layouts.app')

@section('pageTitle', 'Create Report')

@section('nav')
    @include('layouts.navs.app.project')
@stop

@section('content')
    @component('components.card')
        @slot('header')
            @if(sizeof($dirPaths) == 1)
                {{$directory->name}}
            @else
                {{$directory->path}}
                {{--            @foreach($dirPaths as $dirpath)--}}
                {{--                <a class="action-link"--}}
                {{--                   href="{{route($directoryPathRouteName, ['project' => $project, 'dataset' => $dataset, 'path' => $dirpath["path"]])}}">--}}
                {{--                    {{$dirpath['name']}}/--}}
                {{--                </a>--}}
                {{--            @endforeach--}}
            @endif

            {{--        <a class="float-right action-link mr-4" href="{{route($addFilesRouteName, [$project, $dataset, $directory])}}">--}}
            {{--            <i class="fas fa-fw fa-plus mr-2"></i>Add Files--}}
            {{--        </a>--}}

            {{--        <a class="float-right action-link mr-4"--}}
            {{--           href="{{route($createDirectoryRouteName, [$project, $dataset, $directory])}}">--}}
            {{--            <i class="fas fa-fw fa-folder-plus mr-2"></i>Create Directory--}}
            {{--        </a>--}}
        @endslot

        @slot('body')
            <table id="files" class="table table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Selected</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>
                            @if ($file->mime_type === 'directory')
                                <a href="{{route('projects.reports.files.edit', [$project, $report, $file])}}">
                                    <i class="fa-fw fas mr-2 fa-folder"></i> {{$file->name}}
                                </a>
                            @else
                                <a href="{{route('projects.files.show', [$project, $file])}}">
                                    <i class="fa-fw fas mr-2 fa-file"></i>{{$file->name}}
                                </a>
                            @endif
                        </td>
                        <td>{{$file->mime_type}}</td>
                        @if ($file->mime_type === 'directory')
                            <td>N/A</td>
                            <td></td>
                        @else
                            <td>{{$file->toHumanBytes()}}</td>
                            <td>
                                <div class="form-group form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="{{$file->uuid}}"
                                           {{$file->selected ? 'checked' : ''}}
                                           onclick="updateSelection({{$file}}, this)">
                                </div>
                            </td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endslot
    @endcomponent
@stop

@push('scripts')
    <script>
        let projectId = "{{$project->id}}";
        let datasetId = "{{$dataset->id}}";
        let directoryPath = "{{$directory->path == '/' ? '' : $directory->path}}";
        let route = "{{route('projects.reports.tiles.file_selection', [$project, $report, $tile])}}";
        let apiToken = "{{$user->api_token}}";

        $(document).ready(() => {
            $('#files').DataTable({
                stateSave: true,
            });
        });

        function updateSelection(file, checkbox) {
            if (checkbox.checked) {
                addFile(file);
            } else {
                removeFile(file);
            }
        }

        function addFile(file) {
            axios.put(`${route}?api_token=${apiToken}`, {
                project_id: projectId,
                file_id: file.id
            }).then(
                () => null
            );
        }

        function removeFile(file) {
            axios.put(`${route}?api_token=${apiToken}`, {
                project_id: projectId,
                remove_file_id: file.id
            }).then(
                () => null
            );
        }

    </script>
@endpush