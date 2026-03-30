<div class="card shadow">
    <div class="card-header"><h4>Tambah Pengiriman Baru</h4></div>
    <div class="card-body">
        <?= form_open('shipment/store') ?>
        <div class="row">
            <div class="col-md-6">
                <h5>Data Pengirim</h5>
                <div class="mb-3">
                    <label>Nama Pengirim</label>
                    <input type="text" name="sender_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kontak (Telp/HP)</label>
                    <input type="text" name="sender_contact" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Alamat Lengkap</label>
                    <textarea name="sender_address" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Data Penerima</h5>
                <div class="mb-3">
                    <label>Nama Penerima (PIC)</label>
                    <input type="text" name="receiver_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kontak Penerima</label>
                    <input type="text" name="receiver_contact" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Alamat Penerima</label>
                    <textarea name="receiver_address" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Kota Penerima</label>
                    <input type="text" name="receiver_city" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jumlah Paket</label>
                    <input type="number" name="package_count" class="form-control" value="1" min="1" required>
                </div>
                <div class="mb-3">
                    <label>Keterangan Barang</label>
                    <textarea name="item_description" class="form-control" rows="2" placeholder="Isi deskripsi barang (opsional)"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('shipment') ?>" class="btn btn-secondary">Batal</a>
        <?= form_close() ?>
    </div>
</div>