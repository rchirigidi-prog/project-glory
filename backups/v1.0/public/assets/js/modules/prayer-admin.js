document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.editPrayer').forEach(btn => {

        btn.addEventListener('click', function () {

            document.getElementById('editId').value = btn.dataset.id;
            document.getElementById('editName').value = btn.dataset.name;
            document.getElementById('editEmail').value = btn.dataset.email;
            document.getElementById('editRequest').value = btn.dataset.request;
            document.getElementById('editStatus').value = btn.dataset.status;

            const modal = new bootstrap.Modal(
                document.getElementById('editPrayerModal')
            );

            modal.show();

        });

    });

});
document.getElementById('savePrayer').addEventListener('click', async function () {

    const formData = new FormData();

    formData.append('id', document.getElementById('editId').value);
    formData.append('name', document.getElementById('editName').value);
    formData.append('email', document.getElementById('editEmail').value);
    formData.append('request', document.getElementById('editRequest').value);
    formData.append('status', document.getElementById('editStatus').value);

    const response = await fetch('/modules/prayers/update.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();

    if (result.success) {

        alert('✅ Prayer updated successfully.');

        location.reload();

    } else {

        alert('❌ ' + result.message);

    }

});

/* ==========================
   Delete Prayer
========================== */

document.querySelectorAll('.deletePrayer').forEach(btn => {

    btn.addEventListener('click', async function () {

        const prayerName = btn.dataset.name;

        if (!confirm(`Are you sure you want to delete "${prayerName}"?`)) {
            return;
        }

        const formData = new FormData();

        formData.append('id', btn.dataset.id);

        const response = await fetch('/modules/prayers/delete.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {

            alert('✅ Prayer deleted successfully.');

            location.reload();

        } else {

            alert('❌ ' + result.message);

        }

    });

});
/* ==========================
   Search + Status Filter
========================== */

const searchInput = document.getElementById('prayerSearch');
const statusFilter = document.getElementById('statusFilter');

function filterPrayers() {

    const search = searchInput ? searchInput.value.trim().toLowerCase() : '';
    const status = statusFilter ? statusFilter.value.trim().toLowerCase() : '';

    document.querySelectorAll('tbody tr').forEach(row => {

        const rowText = row.innerText.toLowerCase();

        const badge = row.querySelector('.prayer-status');

        const rowStatus = badge
            ? badge.textContent.trim().toLowerCase()
            : '';

        const matchesSearch = rowText.includes(search);
        const matchesStatus = (status === '' || rowStatus === status);

        row.style.display = (matchesSearch && matchesStatus)
            ? ''
            : 'none';

    });

}

if (searchInput) {
    searchInput.addEventListener('keyup', filterPrayers);
}

if (statusFilter) {
    statusFilter.addEventListener('change', filterPrayers);
}