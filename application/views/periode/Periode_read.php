<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Periode Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td>Idperiode</td>
                        <td><?php echo $idperiode; ?></td>
                    </tr>
                    <tr>
                        <td>Parent</td>
                        <td><?php echo $parent; ?></td>
                    </tr>
                    <tr>
                        <td>Kalender</td>
                        <td><?php echo $kalender; ?></td>
                    </tr>
                    <tr>
                        <td>Kode</td>
                        <td><?php echo $kode; ?></td>
                    </tr>
                    <tr>
                        <td>Tglmulai</td>
                        <td><?php echo $tglmulai; ?></td>
                    </tr>
                    <tr>
                        <td>Tglakhir</td>
                        <td><?php echo $tglakhir; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><?php echo $keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>Aktif</td>
                        <td><?php echo $aktif; ?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('periode') ?>" class="btn bg-purple">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>