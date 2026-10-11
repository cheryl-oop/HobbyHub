document.addEventListener('DOMContentLoaded', function () {

    // Attach click listener to every picker card
    document.querySelectorAll('.picker-card').forEach(function (card) {
        card.addEventListener('click', function (e) {
            // Prevent hidden checkbox from interfering
            if (e.target.tagName === 'INPUT') return;

            const id         = card.dataset.id;
            const title      = card.dataset.title;
            const category   = card.dataset.category;
            const difficulty = card.dataset.difficulty;
            const thumbnail  = card.dataset.thumbnail;
            const checkbox   = document.getElementById('tutorial-' + id);

            if (checkbox.checked) {
                // Already selected — deselect
                checkbox.checked = false;
                card.classList.remove('picker-card-selected');
                removeSelected(id);
            } else {
                // Not yet selected — select
                checkbox.checked = true;
                card.classList.add('picker-card-selected');
                addSelected(id, title, category, difficulty, thumbnail);
            }
        });
    });

});

function addSelected(id, title, category, difficulty, thumbnail) {
    const container    = document.getElementById('selected-container');
    const emptyMessage = container.querySelector('.empty-message');

    if (emptyMessage) emptyMessage.remove();

    const card = document.createElement('div');
    card.classList.add('selected-mini-card');
    card.dataset.id = id;
    card.innerHTML = `
        <img src="${thumbnail}" alt="${title}">
        <div class="selected-mini-card-info">
            <span class="picker-card-title">${title}</span>
            <div class="tutorial-detail-badges">
                <span class="badge">${category}</span>
                <span class="badge">${difficulty}</span>
            </div>
        </div>
        <button type="button" class="selected-mini-card-remove" onclick="removeSelected(${id})">
            Remove
        </button>
    `;

    container.appendChild(card);
}

function removeSelected(id) {
    // Remove mini card from selected panel
    const selectedCard = document.querySelector(`.selected-mini-card[data-id="${id}"]`);
    if (selectedCard) selectedCard.remove();

    // Uncheck hidden checkbox
    const checkbox = document.getElementById('tutorial-' + id);
    if (checkbox) checkbox.checked = false;

    // Remove pink border from picker card
    const pickerCard = document.getElementById('picker-' + id);
    if (pickerCard) pickerCard.classList.remove('picker-card-selected');

    // Show empty message if nothing left
    const container = document.getElementById('selected-container');
    if (container.querySelectorAll('.selected-mini-card').length === 0) {
        const p = document.createElement('p');
        p.classList.add('empty-message');
        p.textContent = 'No tutorials selected yet.';
        container.appendChild(p);
    }
}
