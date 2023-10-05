<script type="text/javascript">
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
                "url": "person/json",
                "type": "POST"
            },
            columns: [{
                    "data": "id",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "id",
                    "orderable": false
                }, {
                    "data": "idperson"
                }, {
                    "data": "nama"
                }, {
                    "data": "gender",
                    "className": "text-center"
                }, {
                    "data": "imageId",
                    "orderable": false
                }, {
                    "data": "status",
                    "orderable": false,
                    "className": "text-center"
                }, {
                    "data": "tipe",
                    "orderable": false,
                    "className": "text-center"
                },
                // {
                //     "data": "info1"
                // }, {
                //     "data": "info2"
                // }, {
                //     "data": "user1"
                // }, {
                //     "data": "password"
                // }, {
                //     "data": "tgl_insert"
                // }, {
                //     "data": "tgl_update"
                // },
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
                },
                {
                    "targets": 6,
                    "data": "",
                    "mRender": function(data, type, row) {
                        var text = "";
                        if (type == "display") {
                            if (data == "1") {
                                text = "<button type='button' class='btn btn-success btn-xs'>Aktif</button>";
                            } else {
                                text = "<button type='button' class='btn btn-danger btn-xs'>Nonaktif</button>";
                            }
                            data = text
                        }
                        return data;
                    },
                },
                {
                    "targets": 7,
                    "data": "",
                    "mRender": function(data, type, row) {
                        var text = "";
                        if (type == "display") {
                            if (data == "S") {
                                text = "<button type='button' class='btn btn-success btn-xs'>Siswa</button>";
                            } else if (data == "P") {
                                text = "<button type='button' class='btn btn-info btn-xs'>Pegawai</button>";
                            } else {
                                text = "<button type='button' class='btn btn-warning btn-xs'>Orang Tua</button>";
                            }
                            data = text
                        }
                        return data;
                    },
                }

            ],
            select: {
                style: 'multi'
            },
            order: [
                [2, 'asc']
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
        $("#myform").on('submit', function(e) {
            var form = this
            var rowsel = t.column(0).checkboxes.selected();
            $.each(rowsel, function(index, rowId) {
                $(form).append(
                    $('<input>').attr('type', 'hidden').attr('name', 'id[]').val(rowId)
                )
            });

            if (rowsel.join(",") == "") {
                alertify.alert('', 'Tidak ada data terpilih!', function() {});

            } else {
                var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?', 'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                    ok: 'Yakin',
                    cancel: 'Batal!'
                }).set('onok', function(closeEvent) {
                    $.ajax({
                        url: "person/deletebulk",
                        type: "post",
                        data: "msg = " + rowsel.join(","),
                        success: function(response) {
                            if (response == true) {
                                location.reload();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });

                });
            }
            $(".ajs-header").html("Konfirmasi");
        });
    });
    $('#add_button').click(function() {
        $('#form')[0].reset();
        $('.modal-title').text("Tambah person");
        $('#action').val("Add");
        $('#actions').val("Add");
        $.ajax({
            url: "<?php echo base_url('person/idperson_'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data.hasil);
                $("[name='idperson']").val(data.hasil);
            }
        });
    });
    $(document).on('submit', '#form', function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url('person/json_form'); ?>",
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
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('<a style="color:white">' + data.msg + '</a>');
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
        $("#myModalLabel").text("Ubah Tbl_person");
        $("#btn_simpan").attr("id", "btn_ubah");
        $("#btn_ubah").text("Ubah");
        $("[name=id]").attr("readonly", true);
        $.ajax({
            url: "<?php echo base_url('person/json_get'); ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#ModalaForm").modal("show");
                $("[name=id]").val(data.id);
                $("[name='idperson']").val(data.idperson);
                $("[name='nama']").val(data.nama);
                $("[name='gender']").val(data.gender);
                $("[name='imageId']").val(data.imageId);
                $("[name='status']").val(data.status);
                $("[name='tipe']").val(data.tipe);
                $("[name='info1']").val(data.info1);
                $("[name='info2']").val(data.info2);
                $("[name='user1']").val(data.user1);
                $("[name='password']").val(data.password);
                $("[name='tgl_insert']").val(data.tgl_insert);
                $("[name='tgl_update']").val(data.tgl_update);
                $('#action').val("Edit");
                $('#actions').val("Edit");
            }
        });
        return false;
    }

    function clear_data() {
        $("[name=id]").attr("readonly", false);
        $('.modal-title').text("Tambah Tbl_siswa");
        $('#action').val("Add");
        $('#actions').val("Add");
        $("#btn_ubah").attr("id", "btn_simpan");
        $("#btn_simpan").text("Simpan");
        $("[name=id]").val("");

        $("[name='idperson']").val("");
        $("[name='nama']").val("");
        $("[name='gender']").val("");
        $("[name='imageId']").val("");
        $("[name='status']").val("");
        $("[name='tipe']").val("");
        $("[name='info1']").val("");
        $("[name='info2']").val("");
        $("[name='user1']").val("");
        $("[name='password']").val("");
        $("[name='tgl_insert']").val("");
        $("[name='tgl_update']").val("");
        $(".form-group").toggleClass("has-success has-error", false);
        $(".text-danger").hide();
    }
</script>