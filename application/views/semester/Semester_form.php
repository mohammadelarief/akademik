<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Semester</h3>
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
                        <label for="varchar">Idsemester <?php echo form_error('idsemester') ?></label>
                        <input type="text" class="form-control" name="idsemester" id="idsemester" placeholder="Idsemester" value="<?php echo $idsemester; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Semester <?php echo form_error('nama_semester') ?></label>
                        <input type="text" class="form-control" name="nama_semester" id="nama_semester" placeholder="Nama Semester" value="<?php echo $nama_semester; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idperiode <?php echo form_error('idperiode') ?></label>
                        <?= cmb_where('idperiode', 'tbl_periode', 'keterangan', 'idperiode', $idperiode, 'aktif'); ?>
                        <!-- <input type="text" class="form-control" name="idperiode" id="idperiode" placeholder="Idperiode" value="<?php echo $idperiode; ?>" /> -->
                    </div>
                    <div class="form-group">
                        <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Awal <?php echo form_error('tanggal_awal') ?></label>
                        <input type="text" class="form-control" name="tanggal_awal" id="tanggal_awal" placeholder="Tanggal Awal" value="<?php echo $tanggal_awal; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Akhir <?php echo form_error('tanggal_akhir') ?></label>
                        <input type="text" class="form-control" name="tanggal_akhir" id="tanggal_akhir" placeholder="Tanggal Akhir" value="<?php echo $tanggal_akhir; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="tinyint">Status <?php echo form_error('status') ?></label>
                        <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('periode') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>