<div class="modal fade" tabindex="-1" id="sftp-dialog" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-nav">
                <h5 class="modal-title help-color">SFTP Upload/Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="help-color">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="fs-11">
                    Materials Commons supports using sftp to upload/download files.
                </p>
                <p class="fs-11">
                    To connect to the Materials Commons SFTP server use:
                </p>
                <pre class="fs-11 font-weight-bold">
                    sftp -P 1523 {{auth()->user()->slug}}@materialscommons.org
                </pre>
                <p class="fs-11">
                    This project will show up as: <pre class="fs-11 font-weight-bold ml-5">{{$project->slug}}</pre>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>