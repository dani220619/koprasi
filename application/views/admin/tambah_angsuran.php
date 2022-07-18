<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Angsuran <?= $angsuran->full_name ?></h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead class="center">
                                        <tr>
                                            <th>NO</th>
                                            <th>NO ANGSURAN</th>
                                            <th>JUMLAH</th>
                                            <th>NILAI</th>
                                            <th>METODE PEMBAYARAN</th>
                                            <th>STATUS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center">
                                        <?php
                                        $no = 1;
                                        foreach ($riwayat_angsuran as $a) { ?>

                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $a->no_angsuran ?></td>
                                                <td><?= $a->jumlah_angsuran ?>X</td>
                                                <td><?= rupiah($a->nilai) ?></td>
                                                <td><?= $a->metode_pembayaran ?></td>
                                                <td><?php echo ($a->status == '200' ? 'Lunas' : ($a->status == '100' ? 'Lunas' : 'Pending')) ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= base_url('admin/cetak_perangsuran/' . $a->id) ?>" class="btn btn-link btn-primary btn-lg"><i class="fa fa-print"></i></a>
                                                        <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_angsuran/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Angsuran</div>
                        </div>
                        <form id="form_spp" name="form_spp" class="angsuran" method="post" action="<?= base_url('admin/insert_angsuran'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                    <!-- <input type="text" class="form-control" id="id" name="id" placeholder="Masukan nik" value=""> -->
                                    <input type="text" hidden class="form-control" id="no_pinjaman" name="no_pinjaman" value="<?= $angsuran->no_pinjaman ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="id_user" name="id_user" value="<?= $angsuran->id_user ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="id_pinjaman" name="id_pinjaman" value="<?= $angsuran->id ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="full_name" value="<?= $angsuran->full_name ?>" placeholder="Masukan No Angsuran">
                                    <input type="hidden" name="result_type" id="result-type" value="">
                                    <input type="hidden" name="result_data" id="result-data" value="">
                                    <div class="col-md-12 col-lg-12">
                                        <label>Lama</label>
                                        <select class="bootstrap-select strings selectpicker form-control" title="Jumlah Angsuran" name="jumlah_angsuran[]" id="jumlah_angsuran" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple required>
                                            <?php
                                            
                                            for ($i = 1; $i <= $parm_lama; $i++) { ?>
                                                <option value=" <?php echo $i ?>"> <?php echo $i ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>

                                    <input type="text" hidden class="form-control" id="jumlah" name="jumlah" value="<?= $angsuran->jumlah ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="bunga" name="bunga" value="<?= $angsuran->bunga ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="lama" name="lama" value="<?= $angsuran->lama ?>" placeholder="Masukan No Angsuran">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>

                                            <input type="text" class="form-control" id="nilai" name="nilai" value="" placeholder="Masukan Jumlah" readonly>
                                            <small id="emailHelp2" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                                <a href="<?= base_url('admin/list_angsuran') ?>" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
    $(document).ready(function() {
        $('#jumlah_angsuran').change(function() {
            var jumlah_angsuran = $('#jumlah_angsuran').val();
            var jumlah = $('#jumlah').val();
            var bunga = $('#bunga').val();
            var lama = $('#lama').val();
            var total = parseInt(jumlah) / 100 * parseInt(bunga);
            var hasil = parseInt(total) / parseInt(lama)
            var hastot = (parseInt(jumlah) / parseInt(lama)) + parseInt(hasil)
            var b1 = Math.ceil(hastot);
            $("#nilai").val(b1);
        })
    })
</script>