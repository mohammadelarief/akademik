<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Kelas Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
	    <tr><td>Idkelas</td><td><?php echo $idkelas; ?></td></tr>
	    <tr><td>Idsemester</td><td><?php echo $idsemester; ?></td></tr>
	    <tr><td>Idunit</td><td><?php echo $idunit; ?></td></tr>
	    <tr><td>Idpeg</td><td><?php echo $idpeg; ?></td></tr>
	    <tr><td>Idtingkat</td><td><?php echo $idtingkat; ?></td></tr>
	    <tr><td>Idjurusan</td><td><?php echo $idjurusan; ?></td></tr>
	    <tr><td>Idrombel</td><td><?php echo $idrombel; ?></td></tr>
	    <tr><td>Kapasitas</td><td><?php echo $kapasitas; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Aktif</td><td><?php echo $aktif; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('kelas') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>