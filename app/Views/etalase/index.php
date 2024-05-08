<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <?php foreach($model as $m): ?>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header">
                        <span class="text-success"><strong><?= $m->nama ?></strong></span>
                    </div>
                    <div class="card-body">
                        <img class="img-thumbnail" style="max-height: 200px" src="<?= base_url('uploads/'.$m->gambar) ?>" />
                        <h5 class="mt-3 text-success"><?= "Rp ".number_format($m->harga,2,',','.') ?></h5>
                        <p class="text-info">Stok : <?= $m->stok ?></p>
                    </div>
                    <div class="card-footer">
                        <button id="pay-button-<?= $m->id ?>" style="width:100%" class="btn btn-success" data-id="<?= $m->id ?>">Beli</button>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-UwkEQI5QU00Vt5NK"></script>
<script type="text/javascript">
    <?php foreach($model as $m): ?>
    document.getElementById('pay-button-<?= $m->id ?>').onclick = function() {
        var id_barang = this.getAttribute('data-id');
        // SnapToken acquired from Payment controller
        window.snap.pay('<?= $snapToken; ?>', {
            onSuccess: function(result) {
                console.log(result);
                $.ajax({
                    url: '<?= base_url('payment/save-transaction'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({result: result, id_barang: id_barang}),
                    contentType: 'application/json',
                    success: function(response) {
                        console.log(response);
                        if (result.transaction_status == 'settlement') {
                            // Redirect to success page
                            document.location.href = '<?= base_url('payment/success'); ?>';
                        } else {
                            // Redirect to failed page
                            document.location.href = '<?= base_url('payment/failed'); ?>';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Failed to send transaction data to server!');
                    }
                });
            },
            onPending: function(result) {
                console.log(result);
            },
            onError: function(result) {
                console.log(result);
                // Redirect to failed page
                document.location.href = '<?= base_url('payment/failed'); ?>';
            }
        });
    };
    <?php endforeach ?>
</script>

<?= $this->endSection() ?>