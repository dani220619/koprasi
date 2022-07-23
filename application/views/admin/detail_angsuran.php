<style>
    h4 {
        color: white;
    }
</style>
<div class="main-panel">
    <div class="content">
        <br>
        <button type="button" id="cek_angsuran" class="btn btn-warning">Cek Angsuran</button>
        <br>
        <br>
        <div class="row">

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-body skew-shadow" class="hed">
                        <label for="" class="hed">
                            <h4>NIK:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="nik" name="nik" value="<?= $angsuran->nik ?>" placeholder="NIK">
                        <br>
                        <label for="" class="hed">
                            <h4>NAMA:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="username" name="username" value="<?= $angsuran->full_name ?>" placeholder="USERNAME">
                        <br>
                        <label for="" class="hed">
                            <h4>JUMLAH:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="jumlah" name="jumlah" value="<?= $angsuran->jumlah ?>" placeholder="JUMLAH">
                        <br>
                        <label for="" class="hed">
                            <h4>LAMA:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="lama" name="lama" value="<?= $angsuran->lama ?>X" placeholder="LAMA">
                        <br>
                        <label for="" class="hed">
                            <h4>BUNGA:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="bunga" name="bunga" value="<?= $angsuran->bunga ?>" placeholder="LAMA">
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card card-primary">
                    <div class="card-body skew-shadow" class="hed">
                        <label for="">
                            <h4>TOTAL BUNGA:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="tot_bunga" name="tot_bunga" value="" placeholder="TOTAL BUNGA">
                        <br>
                        <label for="">
                            <h4>ANGSURAN PERBULAN:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="tot_angsuran" name="tot_angsuran" value="" placeholder="TOTAL BUNGA">
                        <br>
                        <label for="">
                            <h4>HARUS DIBAYAR:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="tot_dibayar" name="tot_dibayar" value="<?= rupiah($angsuran->total_angsuran) ?>" placeholder="TOTAL BUNGA">
                        <br>
                        <label for="">
                            <h4>DIBAYAR:</h4>
                        </label>
                        <input type="button" class="btn btn-primary" id="lunas" name="lunas" value="" placeholder="TOTAL BUNGA">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#cek_angsuran').click(function() {
            var jumlah_angsuran = $('#jumlah_angsuran').val();
            var jumlah = $('#jumlah').val();
            var bunga = $('#bunga').val();
            var lama = $('#lama').val();
            var total = parseInt(jumlah) / 100 * parseInt(bunga);
            let nf = new Intl.NumberFormat('en-US');
            var tot = nf.format(total); // "1,234,567,890"
            $("#tot_bunga").val("Rp." + tot);
            var hasil = parseInt(total) / parseInt(lama);
            var hastot = (parseInt(jumlah) / parseInt(lama)) + parseInt(hasil);
            var b2 = Math.ceil(hastot);
            var tot_b2 = nf.format(b2); // "1,234,567,890"
            $("#tot_angsuran").val("Rp." + tot_b2);
            var b1 = Math.ceil(hastot);
            $("#nilai").val(b1);
            var jumlah = $('#jumlah').val();

            var lunas = parseInt(jumlah) + parseInt(bunga);
            var tot_lunas = nf.format(lunas); // "1,234,567,890"
            $("#lunas").val("Rp." + tot_lunas);

        })
    })
</script>