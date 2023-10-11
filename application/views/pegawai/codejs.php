<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<script type="text/javascript">
    //select2
    $('.select2').select2();
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="text/javascript">
    let periode = $("#idperiode").val(),
        unit = $("#idunit").val()
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
                "url": "pegawai/json",
                "type": "POST",
                data: function(data) {
                    data.periode = periode;
                    data.unit = unit;
                    return data;
                }
            },
            columns: [{
                    "data": "idpeg",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "idpeg",
                    "orderable": false
                }, {
                    "data": "idpeg"
                }, {
                    "data": "idperson"
                }, {
                    "data": "idsemester"
                }, {
                    "data": "idunit"
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
        //                 url: "pegawai/deletebulk",
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
        val = "P";
        unit = $("#idunit").val();
        prd = $("#idperiode").val();
        if (unit == 'all') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<a style="color:white">Silahkan Pilih Unit Dahulu</a>');
        } else {
            $('#ModalaForm').modal('show');
            $('#form')[0].reset();
            $('.modal-title').text("Tambah pegawai");
            $('#action').val("Add");
            $('#actions').val("Add");
            $.ajax({
                url: "<?php echo base_url('pegawai/uniqid'); ?>",
                type: "POST",
                data: {
                    _uniq: val,
                    unit: unit
                },
                dataType: "json",
                success: function(data) {
                    // console.log(data.hasil);
                    $("[name='idpeg']").val(data.hasil);
                    $("[name='idunit']").val(unit);
                    $("[name='idsemester']").val(data.smsaktif);
                }
            });
            var autocompleteInput = $("#idperson");
            autocompleteInput.autocomplete({
                source: "<?= site_url('pegawai/get_autocomplete'); ?>",
                // source: function(request, response) {
                //     $.ajax({
                //         url: "siswa/get_autocomplete", // Gantilah dengan URL yang sesuai
                //         dataType: "json",
                //         data: {
                //             term: request.term
                //         },
                //         success: function(data) {
                //             response(data); // Menampilkan hasil autocomplete
                //         }
                //     });
                // },
                select: function(event, ui) {
                    $('[name="idperson"]').val(ui.item.value);
                    // $('[name="nama_lengkap"]').val(ui.item.label);
                },
                minLength: 3 // Jumlah karakter minimum sebelum permintaan AJAX dilakukan
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<div class='box box-solid'><div class='box-header with-border bg-info'><i class='fa fa-user'></i><h3 class='box-title'>" + item.label + "</h3></div><div class='box-body' style='margin-top:-17px;'><div><br><span class='label bg-gray-active'>ID Person</span><span class='pull-right'>" + item.value + "</span><br><span class='label bg-gray-active'>Nama</span><span class='pull-right'>" + item.label + "</span></div></div></div>")
                    .appendTo(ul);
            };
            autocompleteInput.autocomplete("option", "appendTo", ".eventInsForm");

        }
    });
    $(document).on('submit', '#form', function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url('pegawai/json_form'); ?>",
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
        $("#myModalLabel").text("Ubah Tbl_pegawai");
        $("#btn_simpan").attr("id", "btn_ubah");
        $("#btn_ubah").text("Ubah");
        $("[name=idpeg]").attr("readonly", true);
        $.ajax({
            url: "<?php echo base_url('pegawai/json_get'); ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#ModalaForm").modal("show");
                $("[name='idpeg']").val(data.idpeg);
                $("[name='idperson']").val(data.idperson);
                $("[name='idsemester']").val(data.idsemester);
                $("[name='idunit']").val(data.idunit);
                $('#action').val("Edit");
                $('#actions').val("Edit");
            }
        });
        return false;
    }

    function clear_data() {
        $("[name=idpeg]").attr("readonly", false);
        $('.modal-title').text("Tambah Tbl_siswa");
        $('#action').val("Add");
        $('#actions').val("Add");
        $("#btn_ubah").attr("id", "btn_simpan");
        $("#btn_simpan").text("Simpan");
        $("[name='idpeg']").val("");
        $("[name='idperson']").val("");
        $("[name='idsemester']").val("");
        $("[name='idunit']").val("");
        $(".form-group").toggleClass("has-success has-error", false);
        $(".text-danger").hide();
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#idunit').change(function() {
            $("#filter_get").click();
        });
        $('#filter_get').click(function() {
            // $('#datasiswakelas').css('display', 'block');
            periode = $("#idperiode").val();
            unit = $("#idunit").val();
            t.ajax.reload();
        });
        $('#reset_filter').click(function() {
            // $('#datasiswakelas').css('display', 'block');
            $("#idunit").val('all').trigger("change");
            $("#idkelas").val('all').trigger("change");
            periode = $("#idperiode").val();
            unit = $("#idunit").val();
            t.ajax.reload();
        });
    });
</script>