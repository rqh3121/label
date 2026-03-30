</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-resi').click(function() {
            var id = $(this).data('id');
            $.get('<?= site_url('shipment/get_resi_form/') ?>' + id, function(data) {
                $('#resiModal .modal-body').html(data);
                $('#resiModal').modal('show');
            });
        });

        $(document).on('submit', '#formUpdateResi', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id = $(this).data('id');
            $.ajax({
                url: '<?= site_url('shipment/update_resi/') ?>' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 'success') {
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                }
            });
        });
    });
</script>
<div class="modal fade" id="resiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Resi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
</body>
</html>