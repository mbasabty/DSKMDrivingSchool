function filterTable() {
    const q = document.getElementById('searchInput')
                      .value
                      .toLowerCase();
    document.querySelectorAll('#staffTable tbody tr')
        .forEach(row => {
            row.style.display =
                row.textContent.toLowerCase().includes(q)
                ? ''
                : 'none';

        });
}