<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Pengiriman #<?= $shipment['id'] ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="border-start border-primary border-4 ps-3">
                    <h5 class="text-primary"><i class="fas fa-user me-2"></i>Pengirim</h5>
                    <p class="mb-1"><strong>Nama:</strong> <?= htmlspecialchars($shipment['sender_name']) ?></p>
                    <p class="mb-1"><strong>Kontak:</strong> <?= htmlspecialchars($shipment['sender_contact']) ?></p>
                    <p class="mb-0"><strong>Alamat:</strong><br><?= nl2br(htmlspecialchars($shipment['sender_address'])) ?></p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="border-start border-success border-4 ps-3">
                    <h5 class="text-success"><i class="fas fa-user-check me-2"></i>Penerima</h5>
                    <p class="mb-1"><strong>Nama:</strong> <?= htmlspecialchars($shipment['receiver_name']) ?></p>
                    <p class="mb-1"><strong>Kontak:</strong> <?= htmlspecialchars($shipment['receiver_contact']) ?></p>
                    <p class="mb-1"><strong>Alamat:</strong><br><?= nl2br(htmlspecialchars($shipment['receiver_address'])) ?></p>
                    <p class="mb-0"><strong>Kota:</strong> 
                        <span class="badge bg-secondary text-uppercase"><?= strtoupper($shipment['receiver_city']) ?></span>
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-3">

        <div class="row">
            <div class="col-md-6 mb-4">
                <h5><i class="fas fa-truck me-2"></i>Informasi Resi</h5>
                <?php if(!empty($shipment['resi_number']) && !empty($shipment['expedition'])): ?>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-1"><strong>Nomor Resi:</strong> <?= $shipment['resi_number'] ?></p>
                        <p class="mb-1"><strong>Ekspedisi:</strong> <?= $shipment['expedition'] ?></p>
                        <?php if($shipment['resi_photo']): ?>
                            <p class="mb-0">
                                <strong>Foto Resi:</strong> 
                                <a href="<?= base_url('uploads/resi_photos/'.$shipment['resi_photo']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-image"></i> Lihat Foto
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Data resi belum diisi.
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($shipment['item_description'])): ?>
            <div class="col-md-6 mb-4">
                <h5><i class="fas fa-box-open me-2"></i>Keterangan Barang</h5>
                <div class="bg-light p-3 rounded">
                    <?= nl2br(htmlspecialchars($shipment['item_description'])) ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-end mt-3">
            <a href="<?= site_url('shipment') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>