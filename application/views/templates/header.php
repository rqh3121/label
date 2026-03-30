<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Label Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fc; }
        .table-actions .btn { margin: 2px; }
        .btn-resi-merah { background-color: #dc3545; color: white; }
        .btn-resi-hijau { background-color: #28a745; color: white; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('shipment') ?>">📦 Shipping Label Management</a>
    </div>
</nav>
<div class="container mt-4">