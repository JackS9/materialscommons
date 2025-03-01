@extends('layouts.app')

@section('pageTitle', "{$project->name} - Public Data")

@section('nav')
    @include('layouts.navs.app.project')
@stop
@section('content')
    <div class="row mb-10">
        <p class="col-10">
            Maximum file size is 250M. If you need to upload larger files please use
            <a href="{{route('projects.globus.uploads.index', [$project])}}">Globus Upload</a>.
        </p>
        <div class="col-8">
            <a class="btn btn-primary float-right"
               href="{{route('projects.datasets.files.edit', [$project, $dataset, $directory])}}">
                Done Uploading Files
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div id="file-upload" style="margin-top: 10px"></div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        let csrf = "{{csrf_token()}}";
        let r = route('projects.datasets.files.upload', {
            project: "{{$project->id}}",
            dataset: "{{$dataset->id}}",
            file: "{{$directory->id}}"
        });
        const uppy = Uppy({
            restrictions: {
                maxFileSize: 250 * 1024 * 1024,
            }
        }).use(UppyDashboard, {
            trigger: '#file-upload',
            inline: true,
            showProgressDetails: true,
            proudlyDisplayPoweredByUppy: false,
        }).use(UppyXHRUpload, {endpoint: r});

        uppy.on('file-added', () => {
            uppy.setMeta({_token: csrf});
        });
    </script>
@endpush
