<div class="main-panel">
    <div class="content">
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-body skew-shadow">
                        <h1>NIK: <?= $angsuran->nik ?>
                        </h1>
                        <h1>NAMA: <?= $angsuran->full_name ?>
                        </h1>
                        <h1>JUMLAH: <?= rupiah($angsuran->jumlah) ?>
                        </h1>
                        <h1>LAMA: <?= $angsuran->lama ?>X
                        </h1>


                    </div>
                </div>
            </div>
            <?php
            $bunga = $angsuran->jumlah / 100 * $angsuran->bunga;
            $hasil = $bunga / $angsuran->lama;
            $total = ($angsuran->jumlah / $angsuran->lama) + $hasil;

            $lunas =  $angsuran->jumlah + $bunga;
            $nilai = $angsuran->total_angsuran;
            ?>
            <div class="col-md-6">
                <div class="card card-dark bg-primary-gradient">
                    <div class="card-body bubble-shadow">
                        <h1>TOTAL BUNGA: <?= rupiah($bunga) ?>
                        </h1>
                        <h1>ANGSURAN PERBULAN: <?= rupiah($total) ?>
                        </h1>
                        <h1>DIBAYAR: <?= rupiah($angsuran->total_angsuran) ?>
                        </h1>

                        <h1>STATUS :<?php if ($lunas >= $nilai) {
                                        echo  "Belum Lunas";
                                    } else {

                                        echo "Lunas";
                                    } ?></h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>