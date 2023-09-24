<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Person</h3>
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
                        <label for="varchar">Idperson <?php echo form_error('idperson') ?></label>
                        <input type="text" class="form-control" name="idperson" id="idperson" placeholder="Idperson" value="<?php echo $idperson; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="set">Gender <?php echo form_error('gender') ?></label>
                        <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender" value="<?php echo $gender; ?>" />
                    </div>
                    <!-- <div class="form-group">
                        <label for="varchar">ImageId <?php echo form_error('imageId') ?></label>
                        <input type="text" class="form-control" name="imageId" id="imageId" placeholder="ImageId" value="<?php echo $imageId; ?>" />
                    </div> -->
                    <div class="form-group">
                        <label for="varchar">Status <?php echo form_error('status') ?></label>
                        <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Tipe <?php echo form_error('tipe') ?></label>
                        <input type="text" class="form-control" name="tipe" id="tipe" placeholder="Tipe" value="<?php echo $tipe; ?>" />
                    </div>
                    <!-- <div class="form-group">
                        <label for="varchar">Info1 <?php echo form_error('info1') ?></label>
                        <input type="text" class="form-control" name="info1" id="info1" placeholder="Info1" value="<?php echo $info1; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Info2 <?php echo form_error('info2') ?></label>
                        <input type="text" class="form-control" name="info2" id="info2" placeholder="Info2" value="<?php echo $info2; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">User1 <?php echo form_error('user1') ?></label>
                        <input type="text" class="form-control" name="user1" id="user1" placeholder="User1" value="<?php echo $user1; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Password <?php echo form_error('password') ?></label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="datetime">Tgl Insert <?php echo form_error('tgl_insert') ?></label>
                        <input type="text" class="form-control" name="tgl_insert" id="tgl_insert" placeholder="Tgl Insert" value="<?php echo $tgl_insert; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="timestamp">Tgl Update <?php echo form_error('tgl_update') ?></label>
                        <input type="text" class="form-control" name="tgl_update" id="tgl_update" placeholder="Tgl Update" value="<?php echo $tgl_update; ?>" />
                    </div> -->
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('person') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>