// Global functions and jQuery plugins

$(document).ready(function() {
    // Sidebar toggle for mobile
    $('.sidebar-toggle').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('.sidebar-overlay').toggleClass('active');
    });

    // Close sidebar when overlay is tapped (mobile)
    $('.sidebar-overlay').on('click', function() {
        $('.sidebar').removeClass('active');
        $('.sidebar-overlay').removeClass('active');
    });

    // Close sidebar when menu link is clicked (mobile)
    $('.menu-link').on('click', function() {
        if (window.innerWidth <= 768) {
            $('.sidebar').removeClass('active');
            $('.sidebar-overlay').removeClass('active');
        }
    });

    // Close sidebar when clicking outside (mobile)
    $(document).on('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('.sidebar-toggle').length) {
                $('.sidebar').removeClass('active');
                $('.sidebar-overlay').removeClass('active');
            }
        }
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    $('.alert:not(.alert-permanent)').delay(5000).slideUp('slow', function() {
        $(this).remove();
    });
});

// Show loading spinner
function showSpinner() {
    $('#spinner').addClass('show');
}

// Hide loading spinner
function hideSpinner() {
    $('#spinner').removeClass('show');
}

// Delete confirmation
function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
    return confirm(message);
}

// Success notification
function showSuccess(message, duration = 3000) {
    showNotification(message, 'success', duration);
}

// Error notification
function showError(message, duration = 3000) {
    showNotification(message, 'danger', duration);
}

// Info notification
function showInfo(message, duration = 3000) {
    showNotification(message, 'info', duration);
}

// Warning notification
function showWarning(message, duration = 3000) {
    showNotification(message, 'warning', duration);
}

// Generic notification function
function showNotification(message, type = 'info', duration = 3000) {
    const alertClass = `alert-${type}`;
    const alertHtml = `<div class="alert ${alertClass} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>`;

    const alertContainer = $('#notification-container');

    if (alertContainer.length === 0) {
        $('body').prepend(`<div id="notification-container" class="position-fixed top-0 start-50 translate-middle-x" style="z-index: 9999; width: 90%; max-width: 500px;"></div>`);
    }

    $('#notification-container').append(alertHtml);

    if (duration > 0) {
        $(`#notification-container .alert:last-child`).delay(duration).slideUp('slow', function() {
            $(this).remove();
        });
    }
}

// Format currency
function formatCurrency(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);
}

// Format date to Indonesian format
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric', locale: 'id-ID' };
    return date.toLocaleDateString('id-ID', options);
}

// Delete function - submit form directly to action handler
function deleteRecord(actionUrl, recordId) {
    if (!confirmDelete()) {
        return false;
    }

    console.log('deleteRecord() called');
    console.log('Action URL:', actionUrl);
    console.log('Record ID:', recordId);

    // Create form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = actionUrl;
    form.style.display = 'none';

    // Create action input
    var actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = 'delete';

    // Create id input
    var idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id';
    idInput.value = recordId;

    // Append inputs to form
    form.appendChild(actionInput);
    form.appendChild(idInput);

    // Append form to body
    var body = document.body || document.getElementsByTagName('body')[0];
    body.appendChild(form);

    console.log('Form created and appended to body');
    console.log('Form action:', form.action);
    console.log('Form method:', form.method);

    // Submit form
    try {
        form.submit();
        console.log('Form submitted successfully');
    } catch(err) {
        console.error('Form submit failed:', err);
        showError('Terjadi kesalahan saat menghapus data');
    }

    return false;
}

// Export table to CSV
function exportTableToCSV(filename) {
    const csv = [];
    const rows = document.querySelectorAll("table tr");

    rows.forEach(row => {
        const cols = row.querySelectorAll("td, th");
        const csvRow = [];

        cols.forEach((col, index) => {
            // Skip action column (usually last)
            if (index < cols.length - 1) {
                csvRow.push('"' + col.innerText.replace(/"/g, '""') + '"');
            }
        });

        csv.push(csvRow.join(","));
    });

    downloadCSV(csv.join("\n"), filename);
}

// Download CSV file
function downloadCSV(csv, filename) {
    const csvFile = new Blob([csv], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.download = filename;
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

// Print page
function printPage() {
    window.print();
}

// Print table with data
function printTable(tableId, title) {
    if (!tableId) {
        tableId = 'dataTable';
    }
    if (!title) {
        title = 'Laporan Data';
    }

    // Get table element
    var table = document.getElementById(tableId);
    if (!table) {
        console.error('Table tidak ditemukan dengan ID: ' + tableId);
        showError('Table tidak ditemukan');
        return false;
    }

    // Clone table untuk print
    var printTable = table.cloneNode(true);

    // Remove action column (usually last column)
    var rows = printTable.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var headerCells = rows[i].getElementsByTagName('th');

        // Remove last cell (action column)
        if (cells.length > 0) {
            cells[cells.length - 1].remove();
        }
        if (headerCells.length > 0) {
            headerCells[headerCells.length - 1].remove();
        }
    }

    // Create print window
    var printWindow = window.open('', '', 'height=600,width=900');

    // Get current date
    var now = new Date();
    var dateStr = now.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    var timeStr = now.toLocaleTimeString('id-ID');

    // HTML content untuk print
    var printContent = `
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>${title}</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    padding: 20px;
                }

                .print-header {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 3px solid #333;
                    padding-bottom: 15px;
                }

                .print-header h1 {
                    font-size: 24px;
                    margin-bottom: 10px;
                    font-weight: bold;
                }

                .print-header .info {
                    font-size: 12px;
                    color: #666;
                    display: flex;
                    justify-content: space-between;
                    margin-top: 10px;
                }

                .print-header .info div {
                    text-align: center;
                    flex: 1;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }

                table thead {
                    background-color: #f0f0f0;
                    border-bottom: 2px solid #333;
                }

                table thead th {
                    padding: 12px;
                    text-align: left;
                    font-weight: bold;
                    border: 1px solid #ddd;
                }

                table tbody td {
                    padding: 10px 12px;
                    border: 1px solid #ddd;
                }

                table tbody tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                .print-footer {
                    text-align: right;
                    margin-top: 30px;
                    font-size: 12px;
                    color: #999;
                    border-top: 1px solid #ddd;
                    padding-top: 20px;
                }

                @media print {
                    body {
                        padding: 0;
                    }

                    .print-header {
                        margin-bottom: 20px;
                    }

                    table {
                        page-break-inside: avoid;
                    }

                    table tbody tr {
                        page-break-inside: avoid;
                    }
                }
            </style>
        </head>
        <body>
            <div class="print-header">
                <h1>${title}</h1>
                <div class="info">
                    <div>
                        <strong>Tanggal Cetak:</strong><br>
                        ${dateStr}
                    </div>
                    <div>
                        <strong>Waktu Cetak:</strong><br>
                        ${timeStr}
                    </div>
                    <div>
                        <strong>Total Data:</strong><br>
                        ${rows.length - 1} baris
                    </div>
                </div>
            </div>

            ${printTable.outerHTML}

            <div class="print-footer">
                <p>Dicetak dari Sistem Informasi Manajemen SDM</p>
                <p>© ${new Date().getFullYear()} - Semua Hak Dilindungi</p>
            </div>
        </body>
        </html>
    `;

    // Write content ke print window
    printWindow.document.write(printContent);
    printWindow.document.close();

    // Wait untuk document selesai load, baru print
    printWindow.onload = function() {
        printWindow.print();
    };

    return false;
}

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Initialize select2 if available
function initializeSelect2(selector = '.select2') {
    if (typeof $ !== 'undefined' && $.fn.select2) {
        $(selector).select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
    }
}

// Validate email
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Validate phone number
function validatePhone(phone) {
    const regex = /^(\+62|0)[0-9]{9,12}$/;
    return regex.test(phone);
}
