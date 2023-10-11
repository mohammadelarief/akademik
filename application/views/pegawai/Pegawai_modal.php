<!-- MODAL FORM -->
<div class="modal fade modal-fullscreen in" id="ModalaForm" tabindex="-1" role="dialog" aria-labelledby="largeModal">
    <div class="modal-dialog modal-lg" style="margin: 15px;width:auto" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="clear_data()" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Tbl_pegawai</h3>
            </div>
            <form class="form-horizontal" method="post" id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idpeg</label>
                        <div class="col-xs-9">
                            <input type="text" name="idpeg" id="idpeg" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idsemester</label>
                        <div class="col-xs-9">
                            <input type="text" name="idsemester" id="idsemester" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idunit</label>
                        <div class="col-xs-9">
                            <input type="text" name="idunit" id="idunit" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idperson</label>
                        <div class="col-xs-9">
                            <input type="text" name="idperson" id="idperson" class="form-control" placeholder="Idperson" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" onclick="clear_data()" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <input type="hidden" name="actions" id="actions" class="btn btn-success" value="Add" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL FORM-->