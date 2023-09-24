<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Semester Detail</h3>
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
                        <td>Idsemester</td>
                        <td><?php echo $idsemester; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Semester</td>
                        <td><?php echo $nama_semester; ?></td>
                    </tr>
                    <tr>
                        <td>Idperiode</td>
                        <td><?php echo $idperiode; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><?php echo $keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Awal</td>
                        <td><?php echo $tanggal_awal; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir</td>
                        <td><?php echo $tanggal_akhir; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $status; ?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('semester') ?>" class="btn bg-purple">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>