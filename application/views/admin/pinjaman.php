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
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#pinjaman">
                                <i class="fa fa-plus"></i>
                                Add Pinjaman
                            </button>
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
                                        <th>NO PINJAMAN</th>
                                        <th>JUMLAH</th>
                                        <th>TANGGAL</th>
                                        <th>LAMA</th>
                                        <th>BUNGA</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($pinjaman as $a) { ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <img class="myImgx" src='<?php echo base_url("assets/foto/user/"); ?><?= $a->image ?> ' width="100px" height="100px">
                                            </td>
                                            <td><?= $a->nik ?></td>

                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->no_pinjaman ?></td>
                                            <td><?= rupiah($a->jumlah) ?></td>
                                            <td><?= $a->tanggal ?></td>
                                            <td><?= $a->lama ?>X</td>
                                            <td><?= $a->bunga ?>%</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button data-target="#edit-pinjaman<?= $a->id ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_pinjaman/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="edit-pinjaman<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Edit</span>
                                                            <span class="fw-light">
                                                                Anggota
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="<?= base_url('admin/update_pinjaman'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama</label>
                                                                        <div class="col-sm-12 kosong">
                                                                            <select class="form-control" name="id_user" id="id_user">
                                                                                <option value="">Pilih Nama</option>
                                                                                <?php
                                                                                foreach ($nama as $nm) { ?>
                                                                                    <option <?= ($nm->id_user == $a->id_user ? 'selected=""' : '') ?> value="<?= $nm->id_user; ?>"><?= $nm->full_name; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>No Pinjaman</label>
                                                                        <input type="text" class="form-control" id="no_pinjaman" name="no_pinjaman" placeholder="No Pinjaman" value="<?= $a->no_pinjaman ?>">
                                                                        <?= form_error('no_pinjaman', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 ">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Jumlah</label>
                                                                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="<?= $a->jumlah ?>">
                                                                        <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 pr-0 ">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Lama Pinjaman</label>
                                                                        <div class="col-sm-12 kosong">
                                                                            <select class="form-control" name="lama" id="lama">
                                                                                <option value="">Pilih Lama Pinjaman</option>
                                                                                <?php
                                                                                foreach ($lama as $nm) { ?>
                                                                                    <option <?= ($nm == $a->lama ? 'selected=""' : '') ?> value="<?= $nm; ?>"><?= $nm; ?>X</option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Bunga Pinjaman</label>
                                                                        <input type="text" class="form-control" id="bunga" name="bunga" placeholder="Lama Bunga" value="<?= $a->bunga ?>">
                                                                        <?= form_error('bunga', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        </div>
    </div>
</div>
<div class="modal fade" id="pinjaman" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Pinjaman</span>
                    <span class="fw-light">
                        Add
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                <form class="pinjaman" method="post" action="<?= base_url('admin/insert_pinjaman'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <div class="col-sm-12 kosong">
                                    <select class="form-control" name="id_user" id="id_user">
                                        <option value="">Pilih Nama</option>
                                        <?php
                                        foreach ($nama as $nm) { ?>
                                            <option value="<?= $nm->id_user; ?>"><?= $nm->full_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group form-group-default">
                                <label>Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="<?= set_value('jumlah'); ?>">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="col-md-6 pr-0 ">
                            <div class="form-group form-group-default">
                                <label>Lama Pinjaman</label>
                                <div class="col-sm-12 kosong">
                                    <select class="form-control" name="lama" id="lama">
                                        <option value=""></option>
                                        <option value="6">6X</option>
                                        <option value="10">10X</option>
                                        <option value="12">12X</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                <label>Bunga Pinjaman</label>
                                <input type="text" class="form-control" id="bunga" name="bunga" placeholder="Lama Bunga" value="<?= set_value('bunga'); ?>">
                                <?= form_error('bunga', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>