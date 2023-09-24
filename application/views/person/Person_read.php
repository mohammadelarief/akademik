<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Person Detail</h3>
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
	    <tr><td>Idperson</td><td><?php echo $idperson; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Gender</td><td><?php echo $gender; ?></td></tr>
	    <tr><td>ImageId</td><td><?php echo $imageId; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Tipe</td><td><?php echo $tipe; ?></td></tr>
	    <tr><td>Info1</td><td><?php echo $info1; ?></td></tr>
	    <tr><td>Info2</td><td><?php echo $info2; ?></td></tr>
	    <tr><td>User1</td><td><?php echo $user1; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>Tgl Insert</td><td><?php echo $tgl_insert; ?></td></tr>
	    <tr><td>Tgl Update</td><td><?php echo $tgl_update; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('person') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>