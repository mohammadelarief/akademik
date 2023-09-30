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
                "url": "tbl_siswa/json",
                "type": "POST"
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
        //                 url: "tbl_siswa/deletebulk",
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
        $('#add_button').click(function() {
            $('#form')[0].reset();
            $('.modal-title').text("Tambah Tbl_siswa");
            $('#action').val("Add");
        })
        // $('#btn_ubah').on('click', function() {
        //     var idsiswa = $("#idsiswa").val();
        //     var idperson = $("#idperson").val();
        //     var idkelas = $("#idkelas").val();
        //     var tgl_masuk = $("#tgl_masuk").val();
        //     var info1 = $("#info1").val();
        //     var info2 = $("#info2").val();
        //     var user1 = $("#user1").val();
        //     var tgl_insert = $("#tgl_insert").val();
        //     var tglUpdate = $("#tglUpdate").val();
        //     var status = $("#status").val();
        //     var action = $("#action").val();
        //     $.ajax({
        //         url: "<?php echo base_url('tbl_siswa/json_update'); ?>",
        //         type: 'POST',
        //         // data: $('#form').serialize(),
        //         data: {
        //             action: action,
        //             idsiswa: idsiswa,
        //             idperson: idperson,
        //             idkelas: idkelas,
        //             tgl_masuk: tgl_masuk,
        //             info1: info1,
        //             info2: info2,
        //             user1: user1,
        //             tgl_insert: tgl_insert,
        //             tglUpdate: tglUpdate,
        //             status: status
        //         },
        //         dataType: 'json',
        //         success: function(data) {
        //             // console.log(data);
        //             if (data.status) {
        //                 clear_data();
        //                 $('#ModalaForm').modal('hide');
        //                 t.ajax.reload();
        //             } else {
        //                 //     // $('#ModalaForm .text-danger').html(data.error);
        //             }
        //         }
        //     });
        //     // return false;
        // });
        $(document).on('submit', '#form', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url('Tbl_siswa/json_update'); ?>",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    $('#form')[0].reset();
                    $('#ModalaForm').modal('hide');
                    t.ajax.reload();
                }
            });
        });
    });

    function edit_data(id) {
        $("#myModalLabel").text("Ubah Tbl_siswa");

        // $("#btn_simpan").attr("onclick", "updatedata()");
        // $("#btn_simpan").attr("id", "btn_ubah");
        // $("#btn_ubah").text("Ubah");
        $("[name=idsiswa]").attr("readonly", true);
        $.ajax({
            url: "<?php echo base_url('tbl_siswa/json_get'); ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                // $.each(data, function(idsiswa, idperson, idkelas, tgl_masuk, info1, info2, user1, tgl_insert, tglUpdate, status) {
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
                // });
            }
        });
        return false;
    }

    // function confirmdelete(linkdelete) {
    //     alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
    //         location.href = linkdelete;
    //     }, function() {
    //         alertify.error("Penghapusan data dibatalkan.");
    //     });
    //     $(".ajs-header").html("Konfirmasi");
    //     return false;
    // }



    function clear_data() {
        $("[name=idsiswa]").attr("readonly", false);
        $('.modal-title').text("Tambah Tbl_siswa");
        $('#action').val("Add");
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
    }
</script>