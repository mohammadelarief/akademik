<!-- MODAL FORM -->
<div class="modal fade modal-fullscreen in" id="ModalaForm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin: 15px;width:auto" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="clear_data()" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Tbl_person</h3>
            </div>
            <form class="form-horizontal" method="post" id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Idperson</label>
                        <div class="col-xs-9">
                            <input type="text" name="idperson" id="idperson" class="form-control" placeholder="Idperson" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Nama</label>
                        <div class="col-xs-9">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Gender</label>
                        <div class="col-xs-9">
                            <select class="form-control" name="gender" id="gender">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <!-- <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender" /> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">ImageId</label>
                        <div class="col-xs-9">
                            <input type="text" name="imageId" id="imageId" class="form-control" placeholder="ImageId" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Status</label>
                        <div class="col-xs-9">
                            <select class="form-control" name="status" id="status">
                                <option value="1">Aktif</option>
                                <option value="2">Nonaktif</option>
                            </select>
                            <!-- <input type="text" name="status" id="status" class="form-control" placeholder="Status" /> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tipe</label>
                        <div class="col-xs-9">
                            <select class="form-control" name="tipe" id="tipe">
                                <option value="S">Siswa</option>
                                <option value="P">Pegawai</option>
                                <option value="O">Orang Tua</option>
                            </select>
                            <!-- <input type="text" name="tipe" id="tipe" class="form-control" placeholder="Tipe" /> -->
                        </div>
                    </div>
                    <!-- <div class="form-group">
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
                        <label class="control-label col-xs-3">Password</label>
                        <div class="col-xs-9">
                            <input type="text" name="password" id="password" class="form-control" placeholder="Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tgl Insert</label>
                        <div class="col-xs-9">
                            <input type="text" name="tgl_insert" id="tgl_insert" class="form-control" placeholder="Tgl Insert" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tgl Update</label>
                        <div class="col-xs-9">
                            <input type="text" name="tgl_update" id="tgl_update" class="form-control" placeholder="Tgl Update" />
                        </div>
                    </div> -->
                    <input type="hidden" name="id" />
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