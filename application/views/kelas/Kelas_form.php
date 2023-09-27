<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Tbl_kelas</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="varchar">Idkelas <?php echo form_error('idkelas') ?></label>
                        <input type="text" class="form-control" name="idkelas" id="idkelas" placeholder="Idkelas" value="<?php echo $idkelas; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idsemester <?php echo form_error('idsemester') ?></label>
                        <?= cmb_where('idsemester', 'tbl_semester', 'nama_semester', 'idsemester', $idsemester, 'status'); ?>
                        <!-- <input type="text" class="form-control" name="idsemester" id="idsemester" placeholder="Idsemester" value="<?php echo $idsemester; ?>" /> -->
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idunit <?php echo form_error('idunit') ?></label>
                        <?= cmb_dinamis('idunit', 'tbl_unit', 'nama_unit', 'idunit', $idunit); ?>
                        <!-- <input type="text" class="form-control" name="idunit" id="idunit" placeholder="Idunit" value="<?php echo $idunit; ?>" /> -->
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idpeg <?php echo form_error('idpeg') ?></label>
                        <input type="text" class="form-control" name="idpeg" id="idpeg" placeholder="Idpeg" value="<?php echo $idpeg; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idtingkat <?php echo form_error('idtingkat') ?></label>
                        <input type="text" class="form-control" name="idtingkat" id="idtingkat" placeholder="Idtingkat" value="<?php echo $idtingkat; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idjurusan <?php echo form_error('idjurusan') ?></label>
                        <input type="text" class="form-control" name="idjurusan" id="idjurusan" placeholder="Idjurusan" value="<?php echo $idjurusan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idrombel <?php echo form_error('idrombel') ?></label>
                        <input type="text" class="form-control" name="idrombel" id="idrombel" placeholder="Idrombel" value="<?php echo $idrombel; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Kapasitas <?php echo form_error('kapasitas') ?></label>
                        <input type="number" class="form-control" name="kapasitas" id="kapasitas" placeholder="Kapasitas" value="<?php echo $kapasitas; ?>" />
                    </div>
                    <!-- <div class="form-group">
                        <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                    </div> -->
                    <div class="form-group">
                        <label for="tinyint">Aktif <?php echo form_error('aktif') ?></label>
                        <input type="text" class="form-control" name="aktif" id="aktif" placeholder="Aktif" value="<?php echo $aktif; ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('kelas') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>