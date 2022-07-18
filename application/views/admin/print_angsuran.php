<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Laporan Siswa</title>
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <style>
        table {
            border-collapse: collapse;
        }

        thead>tr {
            background-color: #0070C0;
            color: #f1f1f1;
        }

        thead>tr>th {
            background-color: #0070C0;
            color: #fff;
            padding: 10px;
            border-color: #fff;
        }

        th,
        td {
            padding: 2px;
        }

        th {
            color: #222;
        }

        body {
            font-family: Calibri;
        }
    </style>
</head>

<body onload="window.print();">

    <h4 align="center" style="margin-top:0px;"><u>BUKTI ANGSURAN</u></h4>
    <b>

    </b>
    <br>
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead style="text-align: center">
            <tr>
                <th style="text-align: center;">NO</th>
                <th style="text-align: center;">Nama Lengkap</th>
                <th style="text-align: center;">No Angsuran</th>
                <th style="text-align: center;">Jumlah Angsuran</th>
                <th style="text-align: center;">Nilai</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Metode Pembayaran</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($anggota)) {
                $no = 1;
                foreach ($anggota as $data) {
            ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $no++ ?></td>
                        <td style="text-align: center;"><?php echo $data->full_name ?></td>
                        <td style="text-align: center;"><?php echo $data->no_angsuran ?></td>
                        <td style="text-align: center;"><?php echo $data->jumlah_angsuran ?>X</td>
                        <td style="text-align: center;"><?php echo rupiah($data->nilai) ?></td>
                        <td style="text-align: center;"><?php echo $data->tanggal ?></td>
                        <td style="text-align: center;"><?php echo $data->metode_pembayaran ?></td>
                        <td style="text-align: center;">
                            <?php if ($data->status == 100) { ?>
                                <button type="button" class="btn btn-danger" style="font-size: 10px;">PENDING</button>
                            <?php } elseif ($data->status == 200) { ?>
                                <button type="button" class="btn btn-success" style="font-size: 10px;">SUKSES</button>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>




</body>

</html>