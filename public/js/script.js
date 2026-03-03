document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-spec');
    const wrapper = document.getElementById('specs-wrapper');

    if (addBtn) {
        addBtn.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 animate-fadeIn';

            row.innerHTML = `
                <div class="flex-1">
                    <input type="text" name="specs_keys[]" placeholder="Свойство" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                </div>
                <div class="flex-1">
                    <input type="text" name="specs_values[]" placeholder="Значение" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                </div>
                <button type="button" class="remove-btn text-red-500 hover:text-red-700 transition p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="遭19L7 7m0 0l7-7m-7 7h18"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;

            wrapper.appendChild(row);

            row.querySelector('.remove-btn').addEventListener('click', function() {
                row.remove();
            });
        });
    }
});
