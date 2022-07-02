<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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

                                                <td>
                                                    <div class="form-button-action">
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
                        <form id="payment-form" class="angsuran" method="post" action="<?= base_url('admin/insert_angsuran'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                    <!-- <input hidden type="number" class="form-control" id="nik" name="nik" placeholder="Masukan nik" value=""> -->
                                    <input type="text" hidden class="form-control" id="no_pinjaman" name="no_pinjaman" value="<?= $angsuran->no_pinjaman ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="id_user" name="id_user" value="<?= $angsuran->id_user ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="id_pinjaman" name="id_pinjaman" value="<?= $angsuran->id ?>" placeholder="Masukan No Angsuran">
                                    <input type="text" hidden class="form-control" id="full_name" value="<?= $angsuran->full_name ?>" placeholder="Masukan No Angsuran">
                                    <input type="hidden" name="result_type" id="result-type" value="">
                                    <input type="hidden" name="result_data" id="result-data" value="">
                                    <div class="form-group col-12">
                                        <label>Bulan</label>
                                        <select class="bootstrap-select strings selectpicker" onchange="addlama(this.value)" title="Jumlah Angsuran" name="jumlah_angsuran[]" id="jumlah_angsuran" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple required>
                                            <?php
                                            foreach ($lama as $lm) { ?>
                                                <option value="<?= $lm->id; ?>"><?= $lm->lama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php
                                    $bunga = $angsuran->jumlah / 100 * $angsuran->bunga;
                                    $hasil = $bunga / $angsuran->lama;
                                    $total = ($angsuran->jumlah / $angsuran->lama) + $hasil;
                                    ?>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" id="nilai" name="nilai" value="<?= $total ?>" placeholder="Masukan Jumlah" hidden>
                                            <input type="text" class="form-control" value="<?= rupiah($total) ?>" placeholder="Masukan Jumlah" readonly>
                                            <small id="emailHelp2" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <input type="text" hidden class="form-control" id="full_name" value="Online" placeholder="Masukan No Angsuran">
                                </div>
                            </div>
                            <div class="card-action">
                                <button id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                                <a href="<?= base_url('admin/angsuran_anggota') ?>" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</script>
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
<script>
    function hitungTotalSPP() {
        var _selected = $('select.bootstrap-select').val();
        var _jmlbln = _selected.length;
        var _jmlspp = $('#jumlah_angsuran option:selected').text().split('|')[1].replace('Rp. ', '').replace('.', '');
        var _total = parseInt(_jmlbln) * parseInt(_jmlspp);
        return _total;
    }

    function addlama(lama) {
        var explode = lama.split("|", );
        var _nilai = $('#nilai').val();

        var total = explode++ * _nilai;
        console.log(total);
        $("#nilai_tukar").val(explode[0]);
    }
</script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-a3XBeF6t11TJ5LWQ"></script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var _nilai = hitungTotalSPP();
        var _jumlah_angsuran = $('#jumlah_angsuran').val();
        var _full_name = $('#full_name').val();
        console.log(_nilai);
        $.ajax({
            url: '<?= site_url() ?>snap/token',
            cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>