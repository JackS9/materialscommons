<div class="mt-2">
    <h5>
        <a href="{{route('projects.activities.show', [$project, $activity])}}">{{$activity->name}}</a> <a class="ml-2"
                                                                                                          href="#">hide</a>
        @foreach($activity->attributes as $attribute)
            @if(!is_null($attribute->marked_important_at))
                {{$attribute->name}}:
                @if(is_array($attribute->values[0]->val["value"]))
                    @json($attribute->values[0]->val["value"], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                @else
                    @if(blank($attribute->values[0]->val["value"]))
                        No value
                    @else
                        {{$attribute->values[0]->val["value"]}}
                    @endif
                @endif
                @if($attribute->values[0]->unit != "")
                    {{$attribute->values[0]->unit}}
                @endif
            @endif
        @endforeach
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