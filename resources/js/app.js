import './bootstrap';

const searchInput = document.querySelector('[data-calculator-search]');
const categoryFilter = document.querySelector('[data-category-filter]');
const cards = [...document.querySelectorAll('[data-calculator-card]')];
const emptyState = document.querySelector('[data-empty-state]');

if (cards.length && (searchInput || categoryFilter)) {
    const applyFilters = () => {
        const searchTerm = (searchInput?.value || '').trim().toLowerCase();
        const category = categoryFilter?.value || '';
        let visibleCount = 0;

        cards.forEach((card) => {
            const matchesSearch = !searchTerm || card.dataset.title.includes(searchTerm);
            const matchesCategory = !category || card.dataset.category === category;
            const visible = matchesSearch && matchesCategory;
            card.classList.toggle('hidden', !visible);

            if (visible) {
                visibleCount += 1;
            }
        });

        if (emptyState) {
            emptyState.classList.toggle('hidden', visibleCount !== 0);
        }
    };

    searchInput?.addEventListener('input', applyFilters);
    categoryFilter?.addEventListener('change', applyFilters);
}
