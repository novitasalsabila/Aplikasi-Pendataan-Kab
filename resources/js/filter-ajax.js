window.initFilterAjax = function(formId, containerId) {
    const filterForm = document.getElementById(formId);
    const tableContainer = document.getElementById(containerId);

    if (!filterForm || !tableContainer) return;

    const updateTable = () => {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData).toString();
        const url = `${window.location.pathname}?${params}`;

        tableContainer.style.opacity = '0.5';
        window.history.pushState({}, '', url);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tableContainer.innerHTML = html;
            tableContainer.style.opacity = '1';
        })
        .catch(error => console.error('Error:', error));
    };

    filterForm.querySelectorAll('.filter-select').forEach(select => {
        select.addEventListener('change', updateTable);
    });

    // Cari input search di dalam form
    const searchInput = filterForm.querySelector('input[name="search"]');
    if (searchInput) {
        let searchTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(updateTable, 500);
        });
    }

    filterForm.addEventListener('submit', (e) => e.preventDefault());
}