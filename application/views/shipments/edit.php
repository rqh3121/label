<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pengiriman #<?= $shipment['id'] ?></h4>
    </div>
    <div class="card-body">
        <?= form_open('shipment/update/'.$shipment['id']) ?>
        <div class="row">
            <div class="col-md-6">
                <h5 class="border-start border-primary border-4 ps-3 mb-3">Data Pengirim</h5>
                <div class="mb-3">
                    <label>Nama Pengirim</label>
                    <input type="text" name="sender_name" class="form-control" value="<?= set_value('sender_name', $shipment['sender_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Kontak (Telp/HP)</label>
                    <input type="text" name="sender_contact" class="form-control" value="<?= set_value('sender_contact', $shipment['sender_contact']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Alamat Lengkap</label>
                    <textarea name="sender_address" class="form-control" rows="3" required><?= set_value('sender_address', $shipment['sender_address']) ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="border-start border-success border-4 ps-3 mb-3">Data Penerima</h5>
                <div class="mb-3">
                    <label>Nama Penerima (PIC)</label>
                    <input type="text" name="receiver_name" class="form-control" value="<?= set_value('receiver_name', $shipment['receiver_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Kontak Penerima</label>
                    <input type="text" name="receiver_contact" class="form-control" value="<?= set_value('receiver_contact', $shipment['receiver_contact']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Kota Penerima</label>
                    <input list="city-list" name="receiver_city" class="form-control" value="<?= set_value('receiver_city', $shipment['receiver_city']) ?>" required>
                    <datalist id="city-list">
                        <?php foreach($city_options as $city): ?>
                            <option value="<?= htmlspecialchars($city) ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>
                <div class="mb-3">
                    <label>Alamat Penerima</label>
                    <input list="address-list" name="receiver_address" class="form-control" value="<?= set_value('receiver_address', $shipment['receiver_address']) ?>" required>
                    <datalist id="address-list">
                        <?php foreach($address_options as $addr): ?>
                            <option value="<?= htmlspecialchars($addr) ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>
                <div class="mb-3">
                    <label>Jumlah Paket</label>
                    <input type="number" name="package_count" class="form-control" value="<?= set_value('package_count', $shipment['package_count']) ?>" min="1" required>
                </div>
                <div class="mb-3">
                    <label>Keterangan Barang (opsional)</label>
                    <textarea name="item_description" class="form-control" rows="2"><?= set_value('item_description', $shipment['item_description']) ?></textarea>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update</button>
            <a href="<?= site_url('shipment') ?>" class="btn btn-secondary"><i class="fas fa-times me-1"></i> Batal</a>
        </div>
        <?= form_close() ?>
    </div>
</div>