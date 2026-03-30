<?php
// Tidak ada spasi sebelum tag ini
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Label Pengiriman</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.3;
        }
        .label {
            border: 1px dashed #000; /* hitam */
            padding: <?= $paper == 'A6' ? '6px' : ($paper == 'A5' ? '8px' : '10px') ?>;
            width: 100%;
            box-sizing: border-box;
            page-break-after: avoid;
        }
        .label:not(:first-of-type) {
            page-break-before: always;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
        }
        .main-table td {
            vertical-align: top;
        }
        .left-col {
            width: 50%;
            border-right: 1px dashed #000; /* hitam */
            padding-right: <?= $paper == 'A6' ? '6px' : ($paper == 'A5' ? '8px' : '10px') ?>;
        }
        .right-col {
            width: 50%;
            padding-left: <?= $paper == 'A6' ? '6px' : ($paper == 'A5' ? '8px' : '10px') ?>;
        }
        .logo {
            text-align: center;
            margin-bottom: <?= $paper == 'A6' ? '6px' : ($paper == 'A5' ? '8px' : '10px') ?>;
        }
        .logo img {
            width: <?= $paper == 'A6' ? '50px' : ($paper == 'A5' ? '70px' : '90px') ?>;
            height: auto;
        }
        .package-number {
            border: 1px dashed #000; /* hitam */
            text-align: center;
            padding: 4px;
            margin: <?= $paper == 'A6' ? '6px 0' : ($paper == 'A5' ? '8px 0' : '10px 0') ?>;
            font-weight: bold;
            background-color: #f5f5f5;
            font-size: <?= $paper == 'A6' ? '8pt' : ($paper == 'A5' ? '9pt' : '10pt') ?>;
        }
        .symbols {
            text-align: center;
            margin: <?= $paper == 'A6' ? '8px 0' : ($paper == 'A5' ? '10px 0' : '12px 0') ?>;
        }
        .symbols img {
            width: <?= $paper == 'A6' ? '70px' : ($paper == 'A5' ? '85px' : '100px') ?>;
            margin: 0 3px;
            vertical-align: middle;
        }
        /* SENDER – lebih kecil */
        .sender-title {
            font-weight: bold;
            margin-bottom: 3px;
            border-bottom: 1px solid #ddd;
            display: inline-block;
            font-size: <?= $paper == 'A6' ? '5pt' : ($paper == 'A5' ? '6pt' : '7pt') ?>;
        }
        .sender-info p {
            margin: 2px 0;
            font-size: <?= $paper == 'A6' ? '6pt' : ($paper == 'A5' ? '7pt' : '8pt') ?>;
        }
        /* SHIP TO – lebih besar */
        .shipto-title {
            font-weight: bold;
            margin-bottom: 3px;
            border-bottom: 1px solid #ddd;
            display: inline-block;
            font-size: <?= $paper == 'A6' ? '9pt' : ($paper == 'A5' ? '11pt' : '13pt') ?>;
        }
        .shipto-info p {
            margin: 2px 0;
            font-size: <?= $paper == 'A6' ? '8pt' : ($paper == 'A5' ? '9pt' : '10pt') ?>;
        }
        .receiver-city {
            color: red;
            font-weight: bold;
            text-transform: uppercase;
        }
        /* Garis pemisah antara SENDER dan SHIP TO */
        .separator {
            border-bottom: 1px dashed #000;
            margin: <?= $paper == 'A6' ? '8px 0' : ($paper == 'A5' ? '10px 0' : '12px 0') ?>;
        }
        .item-table {
            margin-top: <?= $paper == 'A6' ? '8px' : ($paper == 'A5' ? '10px' : '12px') ?>;
            border-top: 2px dashed #000; /* hitam */
            padding-top: <?= $paper == 'A6' ? '6px' : ($paper == 'A5' ? '8px' : '10px') ?>;
        }
        .item-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .item-table th, .item-table td {
            border: 1px dashed #000; /* hitam */
            padding: 6px;
            font-size: <?= $paper == 'A6' ? '8pt' : ($paper == 'A5' ? '9pt' : '10pt') ?>;
        }
        .item-table th {
            background-color: #f9f9f9;
            text-align: left;
        }
        .footer {
            text-align: right;
            font-size: <?= $paper == 'A6' ? '5pt' : ($paper == 'A5' ? '6pt' : '7pt') ?>;
            margin-top: <?= $paper == 'A6' ? '8px' : ($paper == 'A5' ? '10px' : '12px') ?>;
            color: #666;
        }
    </style>
</head>
<body>
<div class="label">
    <table class="main-table">
        32
            <td class="left-col">
                <div class="logo">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
                </div>
                <?php if (isset($package_number) && isset($total_packages)): ?>
                <div class="package-number">
                    Paket : <?= $package_number ?> / <?= $total_packages ?>
                </div>
                <?php endif; ?>
                <div class="symbols">
                    <img src="<?= base_url('assets/images/care.png') ?>" alt="Care">
                    <img src="<?= base_url('assets/images/pecah.png') ?>" alt="Pecah">
                    <img src="<?= base_url('assets/images/keepdray.png') ?>" alt="Keep Dry">
                    <img src="<?= base_url('assets/images/injak.png') ?>" alt="Jangan Diinjak">
                </div>
                <!-- Thank You! dihapus -->
            </td>
            <td class="right-col">
                <div class="sender-info">
                    <div class="sender-title">SENDER : </div>
                    <p>
                        <strong><?= htmlspecialchars($shipment['sender_name']) ?></strong><br>
                        <?= nl2br(htmlspecialchars($shipment['sender_contact'])) ?><br>
                        <?= nl2br(htmlspecialchars($shipment['sender_address'])) ?>
                    </p>
                </div>
                <!-- Garis pemisah dashed -->
                <div class="separator"></div>
                <div class="shipto-info">
                    <div class="shipto-title">DELIVERY TO : </div>
                    <p>
                        <strong><?= htmlspecialchars($shipment['receiver_name']) ?></strong><br>
                        <span class="receiver-city">(<?= strtoupper($shipment['receiver_city']) ?>)</span><br>
                        <?= nl2br(htmlspecialchars($shipment['receiver_contact'])) ?><br>
                        <?= nl2br(htmlspecialchars($shipment['receiver_address'])) ?>
                    </p>
                </div>
            </td>
        </tr>
    </table>
 <div class="separator"></div>
    <div class="footer">
        Dicetak: <?= $print_date ?>
    </div>
</div>
</body>
</html>