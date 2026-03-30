<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Daftar Pengiriman</h4>
        <a href="<?= site_url('shipment/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Pengiriman
        </a>
    </div>
    <div class="card-body">
        <!-- Flash message -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Form Pencarian -->
        <form method="get" action="<?= site_url('shipment') ?>" class="row g-3 mb-4">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama pengirim, penerima, atau kota" 
                           value="<?= htmlspecialchars($search) ?>">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
                <a href="<?= site_url('shipment') ?>" class="btn btn-secondary">
                    <i class="fas fa-sync-alt me-1"></i> Reset
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th style="width: 5%">No</th>
                        <th style="width: 25%">Pengirim</th>
                        <th style="width: 25%">Penerima (Kota)</th>
                        <th style="width: 10%">Jml Paket</th>
                        <th style="width: 15%">Status Resi</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($shipments)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i> Tidak ada data
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($shipments as $row): ?>
                        <tr>
                            <td class="text-center fw-bold"><?= $no++ ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['sender_name']) ?></strong><br>
                                <small class="text-muted"><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($row['sender_contact']) ?></small>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($row['receiver_name']) ?></strong><br>
                                <span class="badge bg-secondary text-uppercase"><?= strtoupper($row['receiver_city']) ?></span>
                            </td>
                            <td class="text-center"><?= $row['package_count'] ?> paket</td>
                            <td class="text-center">
                                <?php if(!empty($row['resi_number']) && !empty($row['expedition'])): ?>
                                    <span class="badge bg-success px-3 py-2"><i class="fas fa-check-circle me-1"></i> Lengkap</span>
                                <?php else: ?>
                                    <span class="badge bg-danger px-3 py-2"><i class="fas fa-times-circle me-1"></i> Belum</span>
                                <?php endif; ?>
                            </td>
                            <td class="table-actions text-nowrap">
                                <a href="<?= site_url('shipment/show/'.$row['id']) ?>" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= site_url('shipment/edit/'.$row['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= site_url('shipment/delete/'.$row['id']) ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin hapus pengiriman ini?')" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="<?= site_url('shipment/print_label/'.$row['id']) ?>" class="btn btn-sm btn-secondary" title="Cetak Label (A5)">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                                <button class="btn btn-sm <?= (!empty($row['resi_number']) && !empty($row['expedition'])) ? 'btn-success' : 'btn-danger' ?> btn-resi" 
                                        data-id="<?= $row['id'] ?>">
                                    <i class="fas fa-truck"></i> 
                                    <?= (!empty($row['resi_number']) && !empty($row['expedition'])) ? 'Update Resi' : 'Isi Resi' ?>
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