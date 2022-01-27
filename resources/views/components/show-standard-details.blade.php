<form>
    <div class="row">
        <div class="col mb-2">
            <div>
                <span class="fs-10 grey-5">Last Updated: {{$item->updated_at->diffForHumans()}}</span>
                <span class="ml-3 fs-10 grey-5">Owner: {{$item->owner->name}}</span>
                {{ $slot ?? '' }}
                @if (isset($item->id))
                    <span class="ml-3 fs-10 grey-5">ID: {{$item->id}}</span>
                @endif
            </div>
        </div>
    </div>
    @if(!blank($item->description))
        <x-show-description :description="$item->description"/>
    @elseif (!blank($item->summary))
        <x-show-summary :summary="$item->summary"/>
    @endif

    <div class=" ml-2">
        <div class="form-check form-check-inline">
            <label class="form-check-label">Hide:</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="cb_sum_desc" type="checkbox">
            <label class="form-check-label" for="cb_sum_desc">Descriptions</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="cb_process_attrs" type="checkbox">
            <label class="form-check-label" for="cb_process_attrs">Process Attributes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="cb_measurements" type="checkbox">
            <label class="form-check-label" for="cb_measurements">Measurements</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="cb_files" type="checkbox">
            <label class="form-check-label" for="cb_files">Files</label>
        </div>
        <input type="text" class="form-control" placeholder="search...">
    </div>
</form>
