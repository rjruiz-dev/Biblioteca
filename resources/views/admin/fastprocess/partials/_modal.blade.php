<div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Form Input</h4>
            </div>

            <div class="modal-body" id="modal-body">                
            </div>
            
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">{{$Ml_loan_document->btn_cerrar_ld }}</button>
                <button type="button" class="btn btn-primary" id="modal-btn-save">{{$Ml_loan_document->btn_si_ld }}</button>
            </div>
        </div>
    </div>
</div>