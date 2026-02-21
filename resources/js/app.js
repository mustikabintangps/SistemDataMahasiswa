import './bootstrap';
// public/js/app.js

// Fungsi untuk konfirmasi sebelum hapus
function confirmDelete(event, nama) {
    if (!confirm(`Apakah Anda yakin ingin menghapus data mahasiswa "${nama}"?`)) {
        event.preventDefault();
    }
}

// Auto-hide alert setelah 5 detik
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Format tanggal lahir di form edit/create
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            // Validasi tanggal tidak boleh di masa depan
            const selectedDate = new Date(this.value);
            const today = new Date();
            
            if (selectedDate > today) {
                alert('Tanggal lahir tidak boleh di masa depan!');
                this.value = '';
            }
        });
    }

    // Search form enhancement
    const searchForm = document.querySelector('form[role="search"]');
    if (searchForm) {
        const searchInput = searchForm.querySelector('input[name="search"]');
        const searchButton = searchForm.querySelector('button[type="submit"]');
        
        // Add loading state on search
        searchForm.addEventListener('submit', function() {
            searchButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mencari...';
            searchButton.disabled = true;
        });

        // Clear search
        if (searchInput.value) {
            const clearButton = document.createElement('button');
            clearButton.type = 'button';
            clearButton.className = 'btn btn-outline-secondary';
            clearButton.innerHTML = '<i class="bi bi-x-lg"></i>';
            clearButton.onclick = function() {
                searchInput.value = '';
                searchForm.submit();
            };
            searchInput.parentNode.appendChild(clearButton);
        }
    }

    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animation = `fadeIn 0.5s ease-in-out ${index * 0.1}s`;
        card.style.animationFillMode = 'both';
    });

    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Number formatting for NIM (optional)
    const nimInput = document.getElementById('nim');
    if (nimInput) {
        nimInput.addEventListener('input', function(e) {
            // Hanya angka yang diperbolehkan
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    // Prevent double submit on forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
            }
        });
    });

    // Dynamic usia preview (optional)
    const tanggalLahirInput = document.getElementById('tanggal_lahir');
    const usiaPreview = document.getElementById('usia_preview');
    
    if (tanggalLahirInput && usiaPreview) {
        tanggalLahirInput.addEventListener('change', function() {
            if (this.value) {
                const today = new Date();
                const birthDate = new Date(this.value);
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                
                usiaPreview.textContent = `Usia akan menjadi: ${age} tahun`;
            } else {
                usiaPreview.textContent = '';
            }
        });
    }
});

// Fungsi untuk print data (optional)
function printTable() {
    window.print();
}

// Fungsi untuk export ke Excel (optional)
function exportToExcel() {
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tr');
    const csv = [];
    
    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        cols.forEach(col => {
            rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
        });
        csv.push(rowData.join(','));
    });
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'data_mahasiswa.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}