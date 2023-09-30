<!-- MODAL FORM -->
<div class="modal fade" id="ModalaForm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="clear_data()" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Tbl_siswa</h3>
            </div>
            <form class="form-horizontal" method="post" id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idsiswa</label>
                        <div class="col-xs-9">
                            <input type="text" name="idsiswa" id="idsiswa" class="form-control" placeholder="Idsiswa" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idperson</label>
                        <div class="col-xs-9">
                            <input type="text" name="idperson" id="idperson" class="form-control" placeholder="Idperson" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idkelas</label>
                        <div class="col-xs-9">
                            <input type="text" name="idkelas" id="idkelas" class="form-control" placeholder="Idkelas" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tgl Masuk</label>
                        <div class="col-xs-9">
                            <input type="text" name="tgl_masuk" id="tgl_masuk" class="form-control" placeholder="Tgl Masuk" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Info1</label>
                        <div class="col-xs-9">
                            <input type="text" name="info1" id="info1" class="form-control" placeholder="Info1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Info2</label>
                        <div class="col-xs-9">
                            <input type="text" name="info2" id="info2" class="form-control" placeholder="Info2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">User1</label>
                        <div class="col-xs-9">
                            <input type="text" name="user1" id="user1" class="form-control" placeholder="User1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tgl Insert</label>
                        <div class="col-xs-9">
                            <input type="text" name="tgl_insert" id="tgl_insert" class="form-control" placeholder="Tgl Insert" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">TglUpdate</label>
                        <div class="col-xs-9">
                            <input type="text" name="tglUpdate" id="tglUpdate" class="form-control" placeholder="TglUpdate" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Status</label>
                        <div class="col-xs-9">
                            <input type="text" name="status" id="status" class="form-control" placeholder="Status" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" onclick="clear_data()" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <input type="hidden" name="actions" id="actions" class="btn btn-success" value="Add" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <!-- <button class="btn btn-info" onclick="tambahdata()" id="btn_simpan">Simpan</button> -->
                    <!-- <button class="btn btn-info" id="btn_simpan">Simpan</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL FORM-->