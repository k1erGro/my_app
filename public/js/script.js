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

function toggleEditForm() {
    const form = document.getElementById('edit-review-form');
    const content = document.getElementById('review-text-content');
    const textarea = document.getElementById('edit-review-textarea');

    if (form.classList.contains('hidden')) {
        let currentText = content.innerText.replace(/^"|"$/g, '');
        textarea.value = currentText;

        form.classList.remove('hidden');
        form.scrollIntoView({behavior: 'smooth', block: 'center'});
    } else {
        form.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-question-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const questionItem = this.closest('.question-item');
            if (!questionItem) return;

            const questionText = questionItem.querySelector('.question-text');
            const editForm = questionItem.querySelector('.edit-question-form');

            if (!editForm.classList.contains('hidden')) return;

            questionText.classList.add('hidden');
            editForm.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.cancel-edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const questionItem = this.closest('.question-item');
            if (!questionItem) return;

            const questionText = questionItem.querySelector('.question-text');
            const editForm = questionItem.querySelector('.edit-question-form');

            questionText.classList.remove('hidden');
            editForm.classList.add('hidden');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-answer-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const answerItem = this.closest('.answer-item');
            if (!answerItem) return;

            const answerText = answerItem.querySelector('.answer-text');
            const editForm = answerItem.querySelector('.edit-answer-form');

            if (!editForm.classList.contains('hidden')) return;

            answerText.classList.add('hidden');
            editForm.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.cancel-edit-answer-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const answerItem = this.closest('.answer-item');
            if (!answerItem) return;

            const answerText = answerItem.querySelector('.answer-text');
            const editForm = answerItem.querySelector('.edit-answer-form');

            answerText.classList.remove('hidden');
            editForm.classList.add('hidden');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-review-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const reviewItem = this.closest('.review-item');
            if (!reviewItem) return;

            const reviewText = reviewItem.querySelector('.review-text');
            const editForm = reviewItem.querySelector('.edit-review-form');

            if (!editForm.classList.contains('hidden')) return;

            reviewText.classList.add('hidden');
            editForm.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.cancel-edit-review-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const reviewItem = this.closest('.review-item');
            if (!reviewItem) return;

            const reviewText = reviewItem.querySelector('.review-text');
            const editForm = reviewItem.querySelector('.edit-review-form');

            reviewText.classList.remove('hidden');
            editForm.classList.add('hidden');
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const radioPickup = document.querySelector('input[name="type_delivery"][value="pickup"]');
    const radioDelivery = document.querySelector('input[name="type_delivery"][value="delivery"]');
    if (!radioPickup || !radioDelivery) return;

    const warehouseBlock = document.getElementById('warehouse-block');
    const warehouseSelect = document.getElementById('warehouse_select');

    const deliveryBlock = document.getElementById('delivery-block');
    const deliveryDateBlock = document.getElementById('delivery-date-block');
    const deliveryDateInput = document.getElementById('delivery_date_input');
    const savedAddressBlock = document.getElementById('saved-address-block');
    const newAddressBlock = document.getElementById('new-address-block');
    const savedAddressSelect = document.getElementById('saved_address_select');
    const deliveryAddressInput = document.getElementById('delivery_address_input');
    const showNewAddressBtn = document.getElementById('show-new-address-btn');
    const cancelNewAddressBtn = document.getElementById('cancel-new-address-btn');

    function resetDeliveryAddressUI() {
        if (savedAddressBlock && newAddressBlock) {
            savedAddressBlock.style.display = 'block';
            newAddressBlock.style.display = 'none';
        }
        if (savedAddressSelect) savedAddressSelect.value = '';
        if (deliveryAddressInput) deliveryAddressInput.value = '';
    }


    function showNewAddressForm() {
        if (savedAddressBlock && newAddressBlock) {
            savedAddressBlock.style.display = 'none';
            newAddressBlock.style.display = 'block';
        }
        if (deliveryAddressInput) deliveryAddressInput.value = '';
    }

    function updateDeliveryRequired() {
        if (!radioDelivery.checked) return;

        const isSavedVisible = savedAddressBlock && savedAddressBlock.style.display !== 'none';
        if (isSavedVisible) {
            if (savedAddressSelect) savedAddressSelect.setAttribute('required', 'required');
            if (deliveryAddressInput) deliveryAddressInput.removeAttribute('required');
        } else {
            if (deliveryAddressInput) deliveryAddressInput.setAttribute('required', 'required');
            if (savedAddressSelect) savedAddressSelect.removeAttribute('required');
        }
    }

    if (showNewAddressBtn) {
        showNewAddressBtn.addEventListener('click', function () {
            showNewAddressForm();
            updateDeliveryRequired();
        });
    }
    if (cancelNewAddressBtn) {
        cancelNewAddressBtn.addEventListener('click', function () {
            resetDeliveryAddressUI();
            updateDeliveryRequired();
        });
    }

    function toggleFields() {
        if (radioPickup.checked) {
            if (warehouseBlock) warehouseBlock.style.display = 'block';
            if (deliveryBlock) deliveryBlock.style.display = 'none';
            if (deliveryDateBlock) deliveryDateBlock.style.display = 'none';

            if (warehouseSelect) warehouseSelect.setAttribute('required', 'required');
            if (deliveryDateInput) deliveryDateInput.removeAttribute('required');
            if (savedAddressSelect) savedAddressSelect.removeAttribute('required');
            if (deliveryAddressInput) deliveryAddressInput.removeAttribute('required');

            resetDeliveryAddressUI();
        } else if (radioDelivery.checked) {
            if (warehouseBlock) warehouseBlock.style.display = 'none';
            if (deliveryBlock) deliveryBlock.style.display = 'block';
            if (deliveryDateBlock) deliveryDateBlock.style.display = 'block';

            if (warehouseSelect) warehouseSelect.removeAttribute('required');
            if (deliveryDateInput) deliveryDateInput.setAttribute('required', 'required');

            updateDeliveryRequired();
        }
    }

    radioPickup.addEventListener('change', toggleFields);
    radioDelivery.addEventListener('change', toggleFields);
    toggleFields();
});
