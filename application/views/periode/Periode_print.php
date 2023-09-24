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
  <h3 align="center">DATA Tbl Periode</h3>
  <h4>Tanggal Cetak : <?= date("d/M/Y"); ?> </h4>
  <table class="word-table" style="margin-bottom: 10px">
    <tr>
      <th>No</th>
      <th>Idperiode</th>
      <th>Parent</th>
      <th>Kalender</th>
      <th>Kode</th>
      <th>Tglmulai</th>
      <th>Tglakhir</th>
      <th>Keterangan</th>
      <th>Aktif</th>

    </tr><?php
          foreach ($periode_data as $periode) {
          ?>
      <tr>
        <td><?php echo ++$start ?></td>
        <td><?php echo $periode->idperiode ?></td>
        <td><?php echo $periode->parent ?></td>
        <td><?php echo $periode->kalender ?></td>
        <td><?php echo $periode->kode ?></td>
        <td><?php echo $periode->tglmulai ?></td>
        <td><?php echo $periode->tglakhir ?></td>
        <td><?php echo $periode->keterangan ?></td>
        <td><?php echo $periode->aktif ?></td>
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