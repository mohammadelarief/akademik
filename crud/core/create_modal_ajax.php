<?php
$string = "
<!-- MODAL FORM -->
<div class=\"modal fade\" id=\"ModalaForm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"largeModal\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
            <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                <h3 class=\"modal-title\" id=\"myModalLabel\">Tambah Barang</h3>
            </div>
            <form class=\"form-horizontal\">
                <div class=\"modal-body\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text') {
        $string .= "\n\t<div class=\"form-group\">
                        <label class=\"control-label col-xs-3\" >" . label($row["column_name"]) . "</label>
                        <div class=\"col-xs-9\">
                            <textarea name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" rows=\"3\" class=\"form-control\" placeholder=\"" . label($row["column_name"]) . "\" </textarea>
                        </div>
                    </div>";
    } else {
        $string .= "\n\t<div class=\"form-group\">
                        <label class=\"control-label col-xs-3\" >" . label($row["column_name"]) . "</label>
                        <div class=\"col-xs-9\">
                        <input type=\"text\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" class=\"form-control\" placeholder=\"" . label($row["column_name"]) . "\" />
                        </div>
                    </div>";
    }
}
if ($isai) {
    $string .= "\n\t    <input type=\"hidden\" name=\"" . $pk . "\" value=\"<?php echo $" . $pk . "; ?>\" /> ";
}
$string .= "</div>
 
                <div class=\"modal-footer\">
                    <button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">Tutup</button>
                    <button class=\"btn btn-info\" id=\"btn_simpan\">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL FORM-->";

$hasil_view_modal = createFile($string, $target . "views/" . $c_url . "/" . $v_modal_file);
