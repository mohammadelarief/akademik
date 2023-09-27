<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Tbl Kelas</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idkelas</th>
		<th>Idsemester</th>
		<th>Idunit</th>
		<th>Idpeg</th>
		<th>Idtingkat</th>
		<th>Idjurusan</th>
		<th>Idrombel</th>
		<th>Kapasitas</th>
		<th>Keterangan</th>
		<th>Aktif</th>
		
            </tr><?php
            foreach ($kelas_data as $kelas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kelas->idkelas ?></td>
		      <td><?php echo $kelas->idsemester ?></td>
		      <td><?php echo $kelas->idunit ?></td>
		      <td><?php echo $kelas->idpeg ?></td>
		      <td><?php echo $kelas->idtingkat ?></td>
		      <td><?php echo $kelas->idjurusan ?></td>
		      <td><?php echo $kelas->idrombel ?></td>
		      <td><?php echo $kelas->kapasitas ?></td>
		      <td><?php echo $kelas->keterangan ?></td>
		      <td><?php echo $kelas->aktif ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>