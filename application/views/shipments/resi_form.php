<?= form_open_multipart('#', ['id' => 'formUpdateResi', 'data-id' => $id]) ?>
<div class="mb-3">
    <label>Nomor Resi</label>
    <input type="text" name="resi_number" class="form-control" required value="<?= htmlspecialchars($resi_number ?? '') ?>">
</div>
<div class="mb-3">
    <label>Ekspedisi</label>
    <select name="expedition" class="form-select" required>
        <option value="">-- Pilih --</option>
        <?php $ekspedisi_list = ['JNE', 'POS Indonesia', 'TIKI', 'SiCepat', 'J&T Express', 'AnterAja', 'Lion Parcel', 'Ninja Express', 'ID Express', 'Pahala Kencana', 'DHL', 'FedEx', 'UPS', 'Wahana', 'SAP Express', 'RPX', 'NCS', 'First Logistics', 'Kilat Kilat', 'Borzo', 'GoSend']; ?>
        <?php foreach ($ekspedisi_list as $exp): ?>
            <option value="<?= $exp ?>" <?= (isset($expedition) && $expedition == $exp) ? 'selected' : '' ?>><?= $exp ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mb-3">
    <label>Foto Resi (opsional)</label>
    <input type="file" name="resi_photo" class="form-control" accept="image/*,application/pdf">
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<?= form_close() ?>