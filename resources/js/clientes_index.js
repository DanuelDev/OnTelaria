const searchInput = document.getElementById('search');

// Simple, client-side search: filters client cards by name and email with a small debounce
if (searchInput) {
    const debounce = (fn, delay = 200) => {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...args), delay);
        };
    };

    const filterClients = () => {
        const term = (searchInput.value || '').trim().toLowerCase();
        const clientes = document.querySelectorAll('.admin-card');

        clientes.forEach(cliente => {
            const nameEl = cliente.querySelector('.info-grid strong');
            const emailEl = cliente.querySelector('.badge-tipo');
            const name = nameEl ? nameEl.textContent.toLowerCase() : '';
            const email = emailEl ? emailEl.textContent.toLowerCase() : '';

            const match = term === '' || (name + ' ' + email).includes(term);
            cliente.style.display = match ? '' : 'none';
        });
    };

    searchInput.addEventListener('input', debounce(filterClients, 200));
}