<div class="modal fade" tabindex="-1" id="scp-dialog" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-nav">
                <h5 class="modal-title help-color">SCP Upload/Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="help-color">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="fs-11">
                    Materials Commons supports using scp to upload/download files. The path you use for referring
                    to files in this project starts with "/{{$project->slug}}".
                </p>
                <p class="fs-11">
                    To recursively upload the directory /tmp/d3 to the directory /d1 in this project (/d1 will
                    be created if it doesn't exist) use the following command:
                </p>
                <pre class="fs-11 font-weight-bold">
                    scp -P 1523 -r /tmp/d3 {{auth()->user()->slug}}@materialscommons.org:/{{$project->slug}}/d1
                </pre>
                <p class="fs-11">
                    To download the project directory /d1 into /tmp use the following command:
                </p>
                <pre class="fs-11 font-weight-bold">
                    scp -P 1523 -r {{auth()->user()->slug}}@materialscommons.org:/{{$project->slug}}/d1 /tmp
                </pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>