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
                "url": "semester/json",
                "type": "POST"
            },
            columns: [{
                    "data": "idsemester",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "idsemester",
                    "orderable": false
                },
                // {
                //     "data": "idsemester",
                //     "className": "text-center"
                // }, 
                {
                    "data": "nama_semester",
                    "className": "text-center"
                }, {
                    "data": "idperiode",
                    "className": "text-center"
                },
                // {
                //     "data": "keterangan"
                // },
                {
                    "data": "tanggal_awal",
                    "className": "text-center"
                }, {
                    "data": "tanggal_akhir",
                    "className": "text-center"
                }, {
                    "data": "status",
                    "className": "text-center"
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
                        url: "semester/deletebulk",
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

        // $(".update-aktif").click(function() {
        //     var id = $(this).data("id");
        //     $.ajax({
        //         url: "<?php echo base_url('Semester/updateAktifAjax/'); ?>" + id,
        //         method: "POST",
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.success) {
        //                 // Ubah teks pada kolom "Aktif"
        //                 t.ajax.reload();
        //                 // $("#aktif_" + id).text(data.newAktif);
        //             } else {
        //                 alert("Gagal mengupdate status aktif.");
        //             }
        //         },
        //         error: function() {
        //             alert("Terjadi kesalahan dalam permintaan Ajax.");
        //         }
        //     });
        // });
        $('#tabel').on('click', '.update-aktif', function() {
            var id = $(this).data('id');
            updateAktif(id);
        });


    });

    function updateAktif(id) {
        $.ajax({
            url: '<?php echo base_url('semester/updateAktifAjax/'); ?>' + id,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                // alert(response.message);
                t.ajax.reload(); // Memuat ulang data tabel setelah update
            },
            error: function(xhr, status, error) {
                alert('Gagal mengupdate aktif.');
            }
        });
    }

    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }

    function confirmaktif(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  mengaktifkan data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
</script>