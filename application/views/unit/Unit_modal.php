
<!-- MODAL FORM -->
<div class="modal fade" id="ModalaForm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="clear_data()" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Tbl_unit</h3>
            </div>
            <form class="form-horizontal" method="post" id="form">
                <div class="modal-body">
	<div class="form-group">
                        <label class="control-label col-xs-3" >Idunit</label>
                        <div class="col-xs-9">
                        <input type="text" name="idunit" id="idunit" class="form-control" placeholder="Idunit" />
                        </div>
                    </div>
	<div class="form-group">
                        <label class="control-label col-xs-3" >Nama Unit</label>
                        <div class="col-xs-9">
                        <input type="text" name="nama_unit" id="nama_unit" class="form-control" placeholder="Nama Unit" />
                        </div>
                    </div>
	<div class="form-group">
                        <label class="control-label col-xs-3" >Alamat</label>
                        <div class="col-xs-9">
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" />
                        </div>
                    </div>
	<div class="form-group">
                        <label class="control-label col-xs-3" >Telepon</label>
                        <div class="col-xs-9">
                        <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Telepon" />
                        </div>
                    </div>
	<div class="form-group">
                        <label class="control-label col-xs-3" >Status</label>
                        <div class="col-xs-9">
                        <input type="text" name="status" id="status" class="form-control" placeholder="Status" />
                        </div>
                    </div></div>
 
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