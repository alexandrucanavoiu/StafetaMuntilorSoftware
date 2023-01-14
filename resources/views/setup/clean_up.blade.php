<div class="modal fade text-left" id="SetupCleanUp" tabindex="-1" role="dialog" aria-labelledby="SetupCleanUp" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title text-white" id="SetupCleanUp">Confirmare stergere date</h4>
            </div>
            <div class="modal-body">
                @csrf
                <p>Prin apasarea butonului CONFIRMA sunteti de acord cu stergerea permanenta a continutului selectat.</p>
                <br/>
                <strong>Date marcate pentru a fi sterse:</strong>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white type="reset" data-bs-dismiss="modal" aria-label="Close">Anuleaza</button>
                <button type="button" class="btn btn-danger js--setup-clean-up-confirm">Confirma</button>
            </div>
        </div>
    </div>
</div>
