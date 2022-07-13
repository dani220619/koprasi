<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ajukan Pinjaman</div>
                    </div>
                    <form class="simpanan" method="post" action="<?= base_url('admin/insert_ajukan_pinjaman'); ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                <input type="number" hidden class="form-control" id="id_user" name="id_user" placeholder="" value="<?= $id_user['id_user'] ?>">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                                        <small id="emailHelp2" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Lama Pinjaman</label>

                                        <select class="form-control" name="lama" id="lama">
                                            <option value=""></option>
                                            <option value="6">6X</option>
                                            <option value="10">10X</option>
                                            <option value="12">12X</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            <a href="<?= base_url('admin/angsuran_anggota') ?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script type="text/javascript">
    var rupiah = document.getElementById('jumlah');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script> -->