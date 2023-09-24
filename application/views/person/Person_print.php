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
    <h3 align="center">DATA Tbl Person</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idperson</th>
		<th>Nama</th>
		<th>Gender</th>
		<th>ImageId</th>
		<th>Status</th>
		<th>Tipe</th>
		<th>Info1</th>
		<th>Info2</th>
		<th>User1</th>
		<th>Password</th>
		<th>Tgl Insert</th>
		<th>Tgl Update</th>
		
            </tr><?php
            foreach ($person_data as $person)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $person->idperson ?></td>
		      <td><?php echo $person->nama ?></td>
		      <td><?php echo $person->gender ?></td>
		      <td><?php echo $person->imageId ?></td>
		      <td><?php echo $person->status ?></td>
		      <td><?php echo $person->tipe ?></td>
		      <td><?php echo $person->info1 ?></td>
		      <td><?php echo $person->info2 ?></td>
		      <td><?php echo $person->user1 ?></td>
		      <td><?php echo $person->password ?></td>
		      <td><?php echo $person->tgl_insert ?></td>
		      <td><?php echo $person->tgl_update ?></td>	
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