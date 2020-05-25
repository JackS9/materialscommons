<div class="mt-2">
    @if(fileExists($tile->file))
        @switch(fileType2($tile->file))
            @case("image")
            <div class="col-lg-10">
                <img src="{{route('projects.files.display', [$project, $tile->file])}}" class="img-fluid">
            </div>
            @break

            @case("text")
            <div class="ml-3">
                <pre>{{fileContents($tile->file)}}</pre>
            </div>
            @break

            @case("pdf")
            <div class="embed-responsive embed-responsive-4by3">
                <embed class="col-xs-8 embed-responsive-item"
                       src="{{route('projects.files.display', [$project, $tile->file])}}">
            </div>
            @break

            @case("excel")
            @include('partials.files._display-excel-file2', [
                'fileContents' => fileContents($tile->file)
            ])
            @break

            @case("office")
            <div class="embed-responsive embed-responsive-4by3">
                <embed class="col-xs-8 embed-responsive-item"
                       src="{{route('projects.files.display', [$project, $tile->file])}}">
            </div>
            @break

            @default
            <span class="ml-3">Unable to display files of type {{fileType2($tile->file)}}</span>
        @endswitch
    @else
        <span class="ml-3">Unable to display file, it may not exist or have been converted yet</span>
    @endif
</div>