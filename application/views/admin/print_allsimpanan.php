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
    <table id="datatable" class="display table table-striped table-hover">
        <thead class="center">
            <tr>
                <th>NO</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>JUMLAH</th>
                <th>Metode Pembayaran</th>
                <th>No Virtual</th>
                <th>Status</th>
                <th>TANGGAL</th>

            </tr>
        </thead>
        <tbody class="center">
            <?php
            $no = 1;
            foreach ($det_simpanan as $a) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a->nik ?></td>
                    <td><?= $a->full_name ?></td>
                    <td><?= rupiah($a->jumlah) ?></td>
                    <td><?= $a->metode_pembayaran ?></td>
                    <td><?= $a->no_virtual ?></td>
                    <td><?php if ($a->status == 100) { ?>
                            <button type="button" class="btn btn-danger" style="font-size: 10px;">PENDING</button>
                        <?php } elseif ($a->status == 200) { ?>
                            <button type="button" class="btn btn-success" style="font-size: 10px;">SUKSES</button>
                        <?php } ?>
                    </td>
                    <td><?= $a->tanggal_bayar ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>



</body>

</html>