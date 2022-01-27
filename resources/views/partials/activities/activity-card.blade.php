<div class="mt-2">
    <h5>
        <a href="{{route('projects.activities.show', [$project, $activity])}}">{{$activity->name}}</a> <a class="ml-2" href="#">hide</a>
    </h5>
    @if(!blank($activity->description))
        <form>
            <div class="form-group">
                <textarea class="form-control" readonly>{{$activity->description}}</textarea>
            </div>
        </form>
    @endisset
    <h6>Process Attributes <a href="#">hide</a></h6>
    @include('partials.activities._activity-attributes', ['activity' => $activity])
    <h6>Measurements <a href="#">hide</a></h6>
    @include('partials.activities._activity-measurements', ['activity' => $activity])
    <h6>Files <a href="#">hide</a></h6>
    @include('partials.activities._activity-files', ['activity' => $activity])
</div>