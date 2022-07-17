<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Simpanan</div>
                    </div>
                    <form id="payment-form" method="post" action="<?= base_url('admin/insert_simpanan_anggota'); ?>">
                        <div class="card-body">
                            <div class="row">
                                <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                <input hidden type="number" class="form-control" id="nik" name="nik" placeholder="Masukan nik" value="<?= $simpanan['nik'] ?>">
                                <input hidden type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukan full_name" value="<?= $user['full_name'] ?>">
                                <input hidden type="text" class="form-control" id="tlp" name="tlp" placeholder="Masukan tlp" value="<?= $user['tlp'] ?>">
                                <input hidden type="number" class="form-control" id="nik" name="nik" placeholder="Masukan nik" value="<?= $simpanan['nik'] ?>">
                                <input hidden type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" placeholder="Masukan metode_pembayaran" value="Online">
                                <input type="hidden" name="result_type" id="result-type" value="">
                            </div>
                            <input type="hidden" name="result_data" id="result-data" value="">
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="">
                                <small id="emailHelp2" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </form>
                    <div class="card-action">
                        <button id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-a3XBeF6t11TJ5LWQ"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var _jumlah = $('#jumlah').val();
        var _full_name = $('#full_name').val();
        var _tlp = $('#tlp').val();
        $.ajax({
            method: "POST",
            url: '<?= site_url() ?>/snap_simpanan/token',
            cache: false,
            data: {
                jumlah: _jumlah,
                full_name: _full_name,
                tlp: _tlp,
            },
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


<script type="text/javascript">
    var rupiah = document.getElementById('jml');
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
</script>