<div class="card shadow">
    <div class="card-header"><h4>Detail Pengiriman #<?= $shipment['id'] ?></h4></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Pengirim</h5>
                <p><strong>Nama:</strong> <?= htmlspecialchars($shipment['sender_name']) ?><br>
                <strong>Kontak:</strong> <?= htmlspecialchars($shipment['sender_contact']) ?><br>
                <strong>Alamat:</strong> <?= nl2br(htmlspecialchars($shipment['sender_address'])) ?></p>
            </div>
            <div class="col-md-6">
                <h5>Penerima</h5>
                <p><strong>Nama:</strong> <?= htmlspecialchars($shipment['receiver_name']) ?><br>
                <strong>Kontak:</strong> <?= htmlspecialchars($shipment['receiver_contact']) ?><br>
                <strong>Alamat:</strong> <?= nl2br(htmlspecialchars($shipment['receiver_address'])) ?><br>
                <strong>Kota:</strong> <span class="text-uppercase fw-bold"><?= $shipment['receiver_city'] ?></span></p>
            </div>
        </div>
        <hr>
        <h5>Informasi Resi</h5>
        <?php if(!empty($shipment['resi_number']) && !empty($shipment['expedition'])): ?>
            <p><strong>Nomor Resi:</strong> <?= $shipment['resi_number'] ?><br>
            <strong>Ekspedisi:</strong> <?= $shipment['expedition'] ?><br>
            <?php if($shipment['resi_photo']): ?>
                <strong>Foto Resi:</strong> <a href="<?= base_url('uploads/resi_photos/'.$shipment['resi_photo']) ?>" target="_blank">Lihat Foto</a>
            <?php endif; ?>
            </p>
        <?php else: ?>
            <p class="text-danger">Data resi belum diisi.</p>
        <?php endif; ?>

        <?php if (!empty($shipment['item_description'])): ?>
            <hr style="border-top: 2px dashed #ccc; margin: 20px 0;">
            <h5>Keterangan Barang</h5>
            <p><?= nl2br(htmlspecialchars($shipment['item_description'])) ?></p>
        <?php endif; ?>

        <a href="<?= site_url('shipment') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>