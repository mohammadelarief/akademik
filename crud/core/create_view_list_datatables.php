<?php 

$string = "<div class=\"row\">
<div class=\"col-xs-12\">
    <div class=\"box\">
      <div class=\"box-header\">
        <h3 class=\"box-title\">List " . ucfirst($table_name) . "</h3>
        <div class=\"box-tools pull-right\">
            <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\" data-toggle=\"tooltip\"
                    title=\"Collapse\">
              <i class=\"fa fa-minus\"></i></button>
              <button type=\"button\" class=\"btn btn-box-tool\" onclick=\"location.reload()\" title=\"Refresh\">
              <i class=\"fa fa-refresh\"></i></button>
          </div>
      </div>

      <div class=\"box-body\">
     
        <form id=\"myform\" method=\"post\" onsubmit=\"return false\">

           <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-xs-12 col-md-4\">";
if ($cruds == 'ajax_modal') {
    $string .= "<a href=\"#\" class=\"btn btn-sm btn-success\" data-toggle=\"modal\" data-target=\"#ModalaForm\"><span class=\"fa fa-plus\"></span> Create</a>";
} else {
    $string .= "<?php echo anchor(site_url('" . $c_url . "/create'), '<i class=\"fa fa-plus\"></i> Create', 'class=\"btn bg-purple\"'); ?>";
}
$string .= "</div>
            <div class=\"col-xs-12 col-md-4 text-center\">
                <div style=\"margin-top: 4px\"  id=\"message\">
                    
                </div>
            </div>
            <div class=\"col-xs-12 col-md-4 text-right\">";
 if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/printdoc'), '<i class=\"fa fa-print\"></i> Print Preview', 'class=\"btn bg-maroon\"'); ?>";
}
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel\"></i> Excel', 'class=\"btn btn-success\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word\"></i> Word', 'class=\"btn btn-primary\"'); ?>";
}

$string .= "\n\t    
         </div>
        </div>
        <div class=\"table-responsive\">
        <table class=\"table table-bordered table-striped\" id=\"mytable\" style=\"width:100%\">
            <thead>
                <tr>
                    <th width=\"\"></th>
                    <th width=\"10px\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t 
                    <th width=\"80px\">Action</th>   
                </tr>
            </thead>
            \n\t
        </table>
         </div>
        <button class=\"btn btn-danger\" type=\"submit\"><i class=\"fa fa-trash\"></i> Hapus Data Terpilih</button>
        </form>

      </div>
    </div>
  </div>
</div>";
$column_non_pk = array();
foreach ($non_pk as $row) {
    $column_non_pk[] .= "{\"data\": \"" . $row['column_name'] . "\"}";
}
$col_non_pk = implode(',', $column_non_pk);
$column_non_pk_1 = array();
foreach ($non_pk as $row) {
    $column_non_pk_1[] .= "$(\"[name='" . $row['column_name'] . "']\").val(data." . $row['column_name'] . ");";
}
$col_non_pk_1 = implode("\n", $column_non_pk_1);

$column_non_pk_clear = array();
foreach ($non_pk as $row) {
    $column_non_pk_clear[] .= "$(\"[name='" . $row['column_name'] . "']\").val(\"\");";
}
$col_non_pk_clear = implode("\n", $column_non_pk_clear);

$column_non_pk_form = array();
foreach ($non_pk as $row) {
    $column_non_pk_form[] .= "var " . $row['column_name'] . " = $(\"[name='" . $row['column_name'] . "']\").val();";
}
$col_non_pk_form = implode("\n", $column_non_pk_form);

$column_non_pk_value = array();
foreach ($non_pk as $row) {
    $column_non_pk_value[] .= $row['column_name'] . " : " . $row['column_name'];
}
$col_non_pk_value = implode(',', $column_non_pk_value);

$column_non_pk_2 = array();
foreach ($non_pk as $row) {
    $column_non_pk_2[] .= $row['column_name'];
}
$col_non_pk_2 = implode(',', $column_non_pk_2);
        $string2 = "<script type=\"text/javascript\">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        \"iStart\": oSettings._iDisplayStart,
                        \"iEnd\": oSettings.fnDisplayEnd(),
                        \"iLength\": oSettings._iDisplayLength,
                        \"iTotal\": oSettings.fnRecordsTotal(),
                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $(\"#mytable\").DataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode != 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: \"loading...\"
                    },
                    scrollCollapse : true,
                    processing: true,
                    serverSide: true,
                    ajax: {\"url\": \"".$c_url."/json\", \"type\": \"POST\"},
                    columns: [
                         {
                            \"data\": \"$pk\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        },
                        {
                            \"data\": \"$pk\",
                            \"orderable\": false
                        }," . $col_non_pk . ",
                        {
                            \"data\" : \"action\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        }
                    ],
                    columnDefs: [
                        {   
                            className: \"text-center\",
                            targets: 0,
                            checkboxes: {
                                selectRow: true,
                            }
                        }

                    ],
                    select:{
                        style: 'multi'
                    },
                    order: [[1, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(1)', row).html(index);
                    }
                });
                $('#myform').keypress(function(e){
                    if ( e.which == 13 ) return false;
                   
                });
                 $(\"#myform\").on('submit', function(e){
                    var form = this
                    var rowsel = t.column(0).checkboxes.selected();
                    $.each(rowsel, function(index, rowId){
                        $(form).append(
                            $('<input>').attr('type','hidden').attr('name','id[]').val(rowId)
                        )
                    });
                    
                    if(rowsel.join(\",\") == \"\"){
                        alertify.alert('', 'Tidak ada data terpilih!', function(){ });

                    }else{
                        var prompt =  alertify.confirm('Apakah anda yakin akan menghapus data tersebut?', 'Apakah anda yakin akan menghapus data tersebut?').set('labels', {ok:'Yakin', cancel:'Batal!'}).set('onok',function(closeEvent){ 
                            $.ajax({
                                url: \"" . $c_url . "/deletebulk\",
                                type: \"post\",
                                data: \"msg = \"+rowsel.join(\",\") ,
                                success: function (response) {
                                    if(response == true){
                                        location.reload();
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                   console.log(textStatus, errorThrown);
                                }
                            });

                        });
                    }
                    $(\".ajs-header\").html(\"Konfirmasi\");
                });
            });
            function confirmdelete(linkdelete) {
              alertify.confirm(\"Apakah anda yakin akan  menghapus data tersebut?\", function() {
                location.href = linkdelete;
              }, function() {
                alertify.error(\"Penghapusan data dibatalkan.\");
              });
              $(\".ajs-header\").html(\"Konfirmasi\");
              return false;
            }
            function edit_data(id){
                $(\"#myModalLabel\").text(\"Ubah " . ucfirst($table_name) . "\");
                $(\"#btn_simpan\").attr(\"id\", \"btn_ubah\");
                $(\"#btn_ubah\").text(\"Ubah\");
                $(\"[name=" . $pk . "]\").attr(\"readonly\", true);
                $.ajax({
                    url: \"<?php echo base_url('" . $c_url . "/json_get'); ?>\",
                    type: \"POST\",
                    data: {
                        id: id
                    },
                    dataType: \"json\",
                    success: function(data) {
                        $.each(data, function(" . $col_non_pk_2 . ") {
                            $(\"#ModalaForm\").modal(\"show\");
                            " . $col_non_pk_1 . "
                        });
                    }
                });
                return false;
            }
            function clear_data(){
                $(\"[name=" . $pk . "]\").attr(\"readonly\", false);
                $(\"#btn_ubah\").attr(\"id\", \"btn_simpan\");
                $(\"#btn_simpan\").text(\"Simpan\");
                " . $col_non_pk_clear . "
            }
            $('#btn_ubah').on('click',function(){
                " . $col_non_pk_form . "
                $.ajax({
                    type : \"POST\",
                    url  : \"<?php echo base_url('" . $c_url . "/json_update')?>\",
                    dataType : \"JSON\",
                    //data : $('#ModalaForm').serialize(),
                    data : {" . $col_non_pk_value . "},
                    success: function(data){
                        if(data.status){
                            clear_data()
                            $('#ModalaForm').modal('hide');
                        } else {
                            $('#ModalaForm .text-danger').html(data.error);
                        }
                    }
                });
                return false;
            });
        </script>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);
$hasil_view_codejs = createFile($string2, $target."views/" . $c_url . "/codejs.php");
?>