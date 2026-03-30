<div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4>Daftar Pengiriman</h4>
        <a href="<?= site_url('shipment/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pengiriman</a>
    </div>
    <div class="card-body">
        <form method="get" action="<?= site_url('shipment') ?>" class="row g-3 mb-4">
            <div class="col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Cari nama pengirim, penerima, atau kota" value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                <a href="<?= site_url('shipment') ?>" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    32
                        <th>No</th><th>Pengirim</th><th>Penerima (Kota)</th><th>Jml Paket</th><th>Status Resi</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($shipments)): ?>
                        <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($shipments as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['sender_name']) ?><br><small><?= htmlspecialchars($row['sender_contact']) ?></small></td>
                            <td><?= htmlspecialchars($row['receiver_name']) ?><br><strong><?= strtoupper($row['receiver_city']) ?></strong></td>
                            <td class="text-center"><?= $row['package_count'] ?></td>
                            <td class="text-center">
                                <?php if(!empty($row['resi_number']) && !empty($row['expedition'])): ?>
                                    <span class="badge bg-success">Lengkap</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Belum</span>
                                <?php endif; ?>
                            </td>
                            <td class="table-actions">
                                <a href="<?= site_url('shipment/show/'.$row['id']) ?>" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                                <a href="<?= site_url('shipment/edit/'.$row['id']) ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="<?= site_url('shipment/delete/'.$row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')" title="Hapus"><i class="fas fa-trash"></i></a>
                                <a href="<?= site_url('shipment/print_label/'.$row['id']) ?>" class="btn btn-sm btn-secondary" title="Cetak Label A5"><i class="fas fa-print"></i> Cetak</a>
                                <button class="btn btn-sm <?= (!empty($row['resi_number']) && !empty($row['expedition'])) ? 'btn-resi-hijau' : 'btn-resi-merah' ?> btn-resi" data-id="<?= $row['id'] ?>">
                                    <i class="fas fa-truck"></i> <?= (!empty($row['resi_number']) && !empty($row['expedition'])) ? 'Update Resi' : 'Isi Resi' ?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>