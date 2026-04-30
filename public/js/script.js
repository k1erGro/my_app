document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-spec');
    const wrapper = document.getElementById('specs-wrapper');

    if (addBtn && wrapper) {
        addBtn.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 animate-fadeIn spec-item';

            row.innerHTML = `
                <div class="flex-1">
                    <select name="properties[]" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                        <option value="" disabled selected>Выберите свойство</option>
                        ${document.querySelector('select[name="properties[]"]')?.innerHTML || ''}
                    </select>
                </div>
                <div class="flex-1">
                    <input type="text" name="property_values[]" placeholder="Значение" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                </div>
                <button type="button" class="remove-btn text-red-500 hover:text-red-700 transition p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;

            wrapper.appendChild(row);
        });

        wrapper.addEventListener('click', function (e) {
            if (e.target.closest('.remove-btn')) {
                const row = e.target.closest('.animate-fadeIn') || e.target.closest('.flex');
                if (row) {
                    row.remove();
                }
            }
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-spec-address');
    const wrapper = document.getElementById('specs-wrapper-address');

    if (addBtn && wrapper) {
        addBtn.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 animate-fadeIn spec-item';

            row.innerHTML = `
                <div class="flex-1">
                    <select name="address_ids[]" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                        <option value="" disabled selected>Выберите свойство</option>
                        ${document.querySelector('select[name="address_ids[]"]')?.innerHTML || ''}
                    </select>
                </div>
                <div class="flex-1">
                    <input type="text" name="product_quantities[]" placeholder="Значение" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                </div>
                <button type="button" class="remove-btn text-red-500 hover:text-red-700 transition p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;

            wrapper.appendChild(row);
        });

        wrapper.addEventListener('click', function (e) {
            if (e.target.closest('.remove-btn')) {
                const row = e.target.closest('.animate-fadeIn') || e.target.closest('.flex');
                if (row) {
                    row.remove();
                }
            }
        });
    }
});
