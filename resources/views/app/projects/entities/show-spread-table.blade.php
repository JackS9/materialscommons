@extends('layouts.app')

@section('pageTitle', 'View Sample')

@section('nav')
    @include('layouts.navs.app.project')
@stop

@section('breadcrumbs', Breadcrumbs::render('projects.entities.show', $project, $entity))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col col-lg-4 float-right">
                <select class="selectpicker col-lg-10" data-live-search="true" title="Compare Samples">
                    @foreach($project->entities as $entry)
                        @if ($entry->name != $entity->name)
                            <option data-tokens="{{$entry->id}}" value="{{$entry->id}}">{{$entry->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @component('components.card')
        @slot('header')
            Sample: {{$entity->name}}
        @endslot

        @slot('body')
            <x-show-standard-details :item="$entity"/>
            <table id="activities" class="table table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Name/Value</th>
                    <th>Image</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    {{--                    @if(!$loop->first)--}}
                    {{--                        <tr class="group"><td colspan="2"></td></tr>--}}
                    {{--                    @endif--}}
                    <tr class="group">
                        <td colspan="2"><span class="fs-11">Process: {{$activity->name}}</span></td>
                    </tr>
                    @if (!blank($activity->attributes))
                        <tr class="group bg-blue-9x">
                            <td colspan="2"><span class="ml-3">Process Attributes</span></td>
                        </tr>
                    @endif
                    @foreach($activity->attributes as $attribute)
                        <tr>
                            <td colspan="2"><span class="ml-5 mr-2">{{$attribute->name}}:</span>
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
                            </td>
                        </tr>
                    @endforeach
                    <tr class="group bg-blue-9x">
                        <td colspan="2"><span class="ml-3">Measurements</span></td>
                    </tr>
                    @foreach($activity->entityStates as $es)
                        <tr>
                            @if($es->pivot->direction == "out")
                                @foreach($es->attributes as $attr)
                                    <td><span class="ml-5 mr-2">{{$attr->name}}:</span>
                                        @if(is_array($attr->values[0]->val["value"]))
                                            @json($attr->values[0]->val["value"], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                                        @else
                                            @if(blank($attr->values[0]->val["value"]))
                                                No value
                                            @else
                                                {{$attr->values[0]->val["value"]}}
                                            @endif
                                        @endif
                                        @if($attr->values[0]->unit != "")
                                            {{$attr->values[0]->unit}}
                                        @endif
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                    @endforeach
                    @if(!blank($activity->files))
                        <tr class="group bg-blue-9x">
                            <td colspan="2"><span class="ml-3">Files</span></td>
                        </tr>
                    @endif
                    @foreach($activity->files as $f)
                        <tr>
                            <td><span class="ml-5"><a
                                            href="{{route('projects.files.show', [$project, $f])}}">{{$f->name}}</a></span>
                            </td>
                            <td>
                                @if(in_array($f->mime_type, ["image/gif", "image/jpeg", "image/png", "image/tiff", "image/x-ms-bmp","image/bmp"]))
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="text-center mb-2 mt-2">
                                                    <a href="{{route('projects.files.display', [$project, $f])}}">
                                                        <img src="{{route('projects.files.display', [$project, $f])}}"
                                                             class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $('#activities').DataTable({stateSave: true});
        });
    </script>
@endpush
