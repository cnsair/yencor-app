// resources/js/admin/vehicle-verifications.js

document.addEventListener('DOMContentLoaded', function() {
    // Modal for document previews
    const previewModal = new bootstrap.Modal(document.getElementById('documentPreviewModal'));
    const modalTitle = document.getElementById('documentPreviewModalLabel');
    const modalBody = document.getElementById('documentPreviewModalBody');

    // Handle document preview clicks
    document.querySelectorAll('[data-document-preview]').forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            
            const title = this.getAttribute('data-title') || 'Document Preview';
            const url = this.href;
            const type = this.getAttribute('data-type') || 'image';
            
            modalTitle.textContent = title;
            
            if (type === 'image') {
                modalBody.innerHTML = `<img src="${url}" class="img-fluid" alt="Document Preview">`;
            } else if (type === 'pdf') {
                modalBody.innerHTML = `
                    <div class="ratio ratio-16x9">
                        <iframe src="${url}" frameborder="0"></iframe>
                    </div>
                `;
            }
            
            previewModal.show();
        });
    });

    // Confirmation for reject action
    const rejectForm = document.getElementById('rejectVehicleForm');
    if (rejectForm) {
        rejectForm.addEventListener('submit', function(e) {
            const reason = document.getElementById('rejectReason').value.trim();
            if (!reason) {
                e.preventDefault();
                alert('Please provide a reason for rejection');
            }
        });
    }
});