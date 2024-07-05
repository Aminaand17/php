document.addEventListener('DOMContentLoaded', function() {
    const dateFilter = document.getElementById('filter-date');
    const articleFilter = document.getElementById('filter-article');
    const clientFilter = document.getElementById('filter-client');
    const applyFiltersBtn = document.getElementById('apply-filters-btn');
    const tableRows = document.querySelectorAll('.vente-row');

    applyFiltersBtn.addEventListener('click', function() {
        const dateValue = dateFilter.value.trim().toLowerCase();
        const articleValue = articleFilter.value.trim().toLowerCase();
        const clientValue = clientFilter.value.trim().toLowerCase();

        tableRows.forEach(row => {
            const dateCell = row.querySelector('.date').textContent.trim().toLowerCase();
            const articleCell = row.querySelector('.article').textContent.trim().toLowerCase();
            const clientCell = row.querySelector('.client').textContent.trim().toLowerCase();

            const dateMatch = dateCell.includes(dateValue) || dateValue === '';
            const articleMatch = articleCell.includes(articleValue) || articleValue === '';
            const clientMatch = clientCell.includes(clientValue) || clientValue === '';

            if (dateMatch && articleMatch && clientMatch) {
                row.style.display = ''; // Afficher la ligne
            } else {
                row.style.display = 'none'; // Masquer la ligne
            }
        });
    });
});
