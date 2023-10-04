<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<script type="text/javascript">
    //select2
    $('.select2').select2();
</script>
<script type="text/javascript">
    let periode = $("#idperiode").val(),
        unit = $("#idunit").val(),
        kls = $("#idkelas").val()
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        t = $("#mytable").DataTable({
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
                sProcessing: "loading..."
            },
            scrollCollapse: true,
            processing: true,
            serverSide: true,
            ajax: {
                "url": "siswa/json",
                "type": "POST",
                data: function(data) {
                    data.periode = periode;
                    data.unit = unit;
                    data.kls = kls;
                    return data;
                }
            },
            columns: [{
                    "data": "idsiswa",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "idsiswa",
                    "orderable": false
                }, {
                    "data": "idsiswa"
                }, {
                    "data": "idperson"
                }, {
                    "data": "idkelas"
                }, {
                    "data": "tgl_masuk"
                }, {
                    "data": "info1"
                }, {
                    "data": "info2"
                }, {
                    "data": "user1"
                }, {
                    "data": "tgl_insert"
                }, {
                    "data": "tglUpdate"
                }, {
                    "data": "status"
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            columnDefs: [{
                    className: "text-center",
                    targets: 0,
                    checkboxes: {
                        selectRow: true,
                    }
                }

            ],
            select: {
                style: 'multi'
            },
            order: [
                [1, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(1)', row).html(index);
            }
        });
        $('#myform').keypress(function(e) {
            if (e.which == 13) return false;

        });
        // $("#myform").on('submit', function(e) {
        //     var form = this
        //     var rowsel = t.column(0).checkboxes.selected();
        //     $.each(rowsel, function(index, rowId) {
        //         $(form).append(
        //             $('<input>').attr('type', 'hidden').attr('name', 'id[]').val(rowId)
        //         )
        //     });

        //     if (rowsel.join(",") == "") {
        //         alertify.alert('', 'Tidak ada data terpilih!', function() {});

        //     } else {
        //         var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?', 'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
        //             ok: 'Yakin',
        //             cancel: 'Batal!'
        //         }).set('onok', function(closeEvent) {
        //             $.ajax({
        //                 url: "siswa/deletebulk",
        //                 type: "post",
        //                 data: "msg = " + rowsel.join(","),
        //                 success: function(response) {
        //                     if (response == true) {
        //                         location.reload();
        //                     }
        //                 },
        //                 error: function(jqXHR, textStatus, errorThrown) {
        //                     console.log(textStatus, errorThrown);
        //                 }
        //             });

        //         });
        //     }
        //     $(".ajs-header").html("Konfirmasi");
        // });
    });
    $('#add_button').click(function() {
        val = "S";
        unit = $("#idunit").val();
        prd = $("#idperiode").val();
        if (unit == 'all') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<a style="color:white">Silahkan Pilih Unit Dahulu</a>');
        } else {
            $('#ModalaForm').modal('show');
            $('#form')[0].reset();
            $('.modal-title').text("Tambah siswa");
            $('#action').val("Add");
            $('#actions').val("Add");
            $.ajax({
                url: "<?php echo base_url(); ?>siswa/get_kelas",
                method: "POST",
                data: {
                    unit: unit,
                    periode: prd
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;

                    // html += '<option value="all" selected="selected">[SEMUA KELAS]</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].idkelas + '>' + data[i].keterangan + '</option>';
                    }
                    $('#idkelas_').html(html);
                }
            });
            $.ajax({
                url: "<?php echo base_url('siswa/uniqid'); ?>",
                type: "POST",
                data: {
                    _uniq: val,
                    unit: unit
                },
                dataType: "json",
                success: function(data) {
                    // console.log(data.hasil);
                    $("[name='idsiswa']").val(data.hasil);
                }
            });
        }
    });
    $(document).on('submit', '#form', function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url('siswa/json_form'); ?>",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    $('#ModalaForm').modal('hide');
                    $('#form')[0].reset();
                    t.ajax.reload();
                    clear_data();
                } else {
                    $.each(data.messages, function(key, value) {
                        var element = $('#' + key);

                        element.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger')
                            .remove();

                        element.after(value)

                    });
                }
            }
        });
    });

    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }

    function edit_data(id) {
        $("#myModalLabel").text("Ubah Tbl_siswa");
        $("#btn_simpan").attr("id", "btn_ubah");
        $("#btn_ubah").text("Ubah");
        // $("[name=idsiswa]").attr("readonly", true);
        unit = $("#idunit").val();
        prd = $("#idperiode").val();
        $.ajax({
            url: "<?php echo base_url(); ?>siswa/get_kelas",
            method: "POST",
            data: {
                unit: unit,
                periode: prd
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;

                // html += '<option value="all" selected="selected">[SEMUA KELAS]</option>';
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].idkelas + '>' + data[i].keterangan + '</option>';
                }
                $('#idkelas_').html(html);
            }
        });
        $.ajax({
            url: "<?php echo base_url('siswa/json_get'); ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#ModalaForm").modal("show");
                $("[name='idsiswa']").val(data.idsiswa);
                $("[name='idperson']").val(data.idperson);
                $("[name='idkelas']").val(data.idkelas);
                $("[name='tgl_masuk']").val(data.tgl_masuk);
                $("[name='info1']").val(data.info1);
                $("[name='info2']").val(data.info2);
                $("[name='user1']").val(data.user1);
                $("[name='tgl_insert']").val(data.tgl_insert);
                $("[name='tglUpdate']").val(data.tglUpdate);
                $("[name='status']").val(data.status);
                $('#action').val("Edit");
                $('#actions').val("Edit");
            }
        });
        return false;
    }

    function clear_data() {
        // $("[name=idsiswa]").attr("readonly", false);
        $('.modal-title').text("Tambah Tbl_siswa");
        $('#action').val("Add");
        $('#actions').val("Add");
        $("#btn_ubah").attr("id", "btn_simpan");
        $("#btn_simpan").text("Simpan");
        $("[name='idsiswa']").val("");
        $("[name='idperson']").val("");
        $("[name='idkelas']").val("");
        $("[name='tgl_masuk']").val("");
        $("[name='info1']").val("");
        $("[name='info2']").val("");
        $("[name='user1']").val("");
        $("[name='tgl_insert']").val("");
        $("[name='tglUpdate']").val("");
        $("[name='status']").val("");
        $(".form-group").toggleClass("has-success has-error", false);
        $(".text-danger").hide();
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#idkelas').change(function() {
            $("#filter_get").click();
        });
        $('#filter_get').click(function() {
            // $('#datasiswakelas').css('display', 'block');
            periode = $("#idperiode").val();
            unit = $("#idunit").val();
            kls = $("#idkelas").val();
            t.ajax.reload();
        });
        $('#reset_filter').click(function() {
            // $('#datasiswakelas').css('display', 'block');
            $("#idunit").val('all').trigger("change");
            $("#idkelas").val('all').trigger("change");
            periode = $("#idperiode").val();
            unit = $("#idunit").val();
            kls = $("#idkelas").val();
            t.ajax.reload();
        });
        $("#idunit").change(function() {
            unit = $("#idunit").val();
            prd = $("#idperiode").val();
            $.ajax({
                url: "<?php echo base_url(); ?>siswa/get_kelas",
                method: "POST",
                data: {
                    unit: unit,
                    periode: prd
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;

                    html += '<option value="all" selected="selected">[SEMUA KELAS]</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].idkelas + '>' + data[i].keterangan + '</option>';
                    }
                    $('#idkelas').html(html);
                }
            });
            $("#filter_get").click();
        });
    });
</script>