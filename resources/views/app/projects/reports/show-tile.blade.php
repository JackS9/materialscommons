@switch($tile->type)
    @case(0)
    @include('app.projects.reports.show.notset-tile', ['tile' => $tile])
    @break

    @case(1)
    @include('app.projects.reports.show.text-tile', ['tile' => $tile])
    @break

    {{--    file --}}
    @case(2)
    @include('app.projects.reports.show.file-tile', ['tile' => $tile])
    @break

    @case(3)
    @include('app.projects.reports.show.chart-tile', ['tile' => $tile])
    @break

    @default
    @include('app.projects.reports.show.notset-tile', ['tile' => $tile])
    @break
@endswitch