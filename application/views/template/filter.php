<div class="row" style="margin-bottom: 5px">
    <div class="col-sm-4 form-horizontal">
        <div class="form-group" style="margin-bottom: 5px; margin-top: 5px">
            <label for="inputEmail3" class="col-sm-5 control-label">Periode</label>

            <div class="col-sm-7">
                <?= cmb_dinamis('idperiode', 'tbl_periode', 'keterangan', 'idperiode'); ?>
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 5px; margin-top: 5px">
            <label for="inputEmail3" class="col-sm-5 control-label">Unit</label>

            <div class="col-sm-7">
                <?= cmb_filter('[SEMUA UNIT]', 'idunit', 'tbl_unit', 'nama_unit', 'idunit'); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4 form-horizontal">
        <?php
        $uri = $this->uri->segment(1);
        if ($uri == "siswa") {
            echo '
        <div class="form-group" style="margin-bottom: 5px; margin-top: 5px">
            <label for="inputEmail3" class="col-sm-5 control-label">Kelas</label>

            <div class="col-sm-7">
                <select class="form-control select2 filter" id="idkelas" style="width: 100%;">
                    <option value="[SEMUA KELAS]" selected="selected">[SEMUA KELAS]</option>

                </select>
            </div>
        </div>
        ';
        }
        ?>
        <div class="form-group" style="margin-bottom: 5px; margin-top: 5px">
            <label for="inputEmail3" class="col-sm-5 control-label"></label>

            <div class="col-sm-7">
                <button type="submit" id="filter_get" class="btn btn-warning">Apply Filter</button>
            </div>
        </div>
    </div>
</div>