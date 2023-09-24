<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Periode</h3>
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
                        <label for="varchar">Idperiode <?php echo form_error('idperiode') ?></label>
                        <input type="text" class="form-control" name="idperiode" id="idperiode" placeholder="Idperiode" value="<?php echo $idperiode; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Parent <?php echo form_error('parent') ?></label>
                        <input type="text" class="form-control" name="parent" id="parent" placeholder="Parent" value="<?php echo $parent; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="enum">Kalender <?php echo form_error('kalender') ?></label>
                        <input type="text" class="form-control" name="kalender" id="kalender" placeholder="Kalender" value="<?php echo $kalender; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kode <?php echo form_error('kode') ?></label>
                        <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">Tglmulai <?php echo form_error('tglmulai') ?></label>
                        <input type="text" class="form-control" name="tglmulai" id="tglmulai" placeholder="Tglmulai" value="<?php echo $tglmulai; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">Tglakhir <?php echo form_error('tglakhir') ?></label>
                        <input type="text" class="form-control" name="tglakhir" id="tglakhir" placeholder="Tglakhir" value="<?php echo $tglakhir; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="tinyint">Aktif <?php echo form_error('aktif') ?></label>
                        <input type="text" class="form-control" name="aktif" id="aktif" placeholder="Aktif" value="<?php echo $aktif; ?>" />
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('periode') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>