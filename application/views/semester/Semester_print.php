<!DOCTYPE html>
<html>

<head>
  <title>Tittle</title>
  <style type="text/css" media="print">
    @page {
      margin: 0;
      /* this affects the margin in the printer settings */
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
    }

    table th {
      -webkit-print-color-adjust: exact;
      border: 1px solid;

      padding-top: 11px;
      padding-bottom: 11px;
      background-color: #a29bfe;
    }

    table td {
      border: 1px solid;

    }
  </style>
</head>

<body>
  <h3 align="center">DATA Tbl Semester</h3>
  <h4>Tanggal Cetak : <?= date("d/M/Y"); ?> </h4>
  <table class="word-table" style="margin-bottom: 10px">
    <tr>
      <th>No</th>
      <th>Idsemester</th>
      <th>Nama Semester</th>
      <th>Idperiode</th>
      <th>Keterangan</th>
      <th>Tanggal Awal</th>
      <th>Tanggal Akhir</th>
      <th>Status</th>

    </tr><?php
          foreach ($semester_data as $semester) {
          ?>
      <tr>
        <td><?php echo ++$start ?></td>
        <td><?php echo $semester->idsemester ?></td>
        <td><?php echo $semester->nama_semester ?></td>
        <td><?php echo $semester->idperiode ?></td>
        <td><?php echo $semester->keterangan ?></td>
        <td><?php echo $semester->tanggal_awal ?></td>
        <td><?php echo $semester->tanggal_akhir ?></td>
        <td><?php echo $semester->status ?></td>
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