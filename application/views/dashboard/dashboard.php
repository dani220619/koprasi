<?php
$ang = $this->Mod_aplikasi->tot_anggota()->row_array();
$pgw = $this->Mod_aplikasi->tot_pegawai()->row_array();
$adm = $this->Mod_aplikasi->tot_admin()->row_array();
$sim = $this->Mod_aplikasi->tot_simpanan()->row_array();
// dead($ang);
?>
<!-- <?php $anggota['total_ang'] ?> -->
<div class="main-panel">
    <div class="content">
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-body skew-shadow">
                        <h1><?= $ang['total_ang'] ?></h1>
                        <h5 class="op-8">Total Anggota</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">Active</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-dark bg-secondary-gradient">
                    <div class="card-body bubble-shadow">
                        <h1><?= $pgw['total_pgw'] ?></h1>
                        <h5 class="op-8">Total Pegawai</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">Active</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-dark bg-secondary2">
                    <div class="card-body curves-shadow">
                        <h1><?= $adm['total_adm'] ?></h1>
                        <h5 class="op-8">Total Admin</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">Active</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-dark bg-secondary2">
                    <div class="card-body curves-shadow">
                        <h1><?= rupiah($sim['total_simpanan']) ?></h1>
                        <h5 class="op-8">Total Simpanan</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">Active</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>