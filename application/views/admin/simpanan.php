<style>
    .center {
        text-align: center;
    }
</style>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"><?= $title ?></h4>
                            <a href="<?= base_url('admin/print_allsimpanan') ?>" class="btn btn-primary btn-round ml-auto">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Cetak
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>NO</th>
                                        <th>IMAGE</th>
                                        <th>NIK</th>
                                        <th>FULL NAME</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($anggota as $a) { ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <img class="myImgx" src='<?php echo base_url("assets/foto/user/"); ?><?= $a->image ?> ' width="100px" height="100px">
                                            </td>
                                            <td><?= $a->nik ?></td>

                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->jenis_kelamin ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('admin/tambah_simpanan/' . $a->nik . '') ?>" class="btn btn-secondary">
                                                        <span class="btn-label">
                                                            <i class="fa fa-plus"></i>
                                                        </span>
                                                        Simpanan
                                                    </a>
                                                    <a href="<?= base_url('admin/detail_simpanan/' . $a->nik . '') ?>" class="btn btn-warning">
                                                        <span class="btn-label">
                                                            <i class="fa fa-exclamation-circle"></i>
                                                        </span>
                                                        Detail Simpanan
                                                    </a>
                                                    <a href="<?= base_url('admin/print_simpanan/' . $a->nik . '') ?>" class="btn btn-primary">
                                                        <span class="btn-label">
                                                            <i class="fa fa-print"></i>
                                                        </span>
                                                        Cetak
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>