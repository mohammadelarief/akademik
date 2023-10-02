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
    <h3 align="center">DATA Tbl Siswa</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idsiswa</th>
		<th>Idperson</th>
		<th>Idkelas</th>
		<th>Tgl Masuk</th>
		<th>Info1</th>
		<th>Info2</th>
		<th>User1</th>
		<th>Tgl Insert</th>
		<th>TglUpdate</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($siswa_data as $siswa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $siswa->idsiswa ?></td>
		      <td><?php echo $siswa->idperson ?></td>
		      <td><?php echo $siswa->idkelas ?></td>
		      <td><?php echo $siswa->tgl_masuk ?></td>
		      <td><?php echo $siswa->info1 ?></td>
		      <td><?php echo $siswa->info2 ?></td>
		      <td><?php echo $siswa->user1 ?></td>
		      <td><?php echo $siswa->tgl_insert ?></td>
		      <td><?php echo $siswa->tglUpdate ?></td>
		      <td><?php echo $siswa->status ?></td>	
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