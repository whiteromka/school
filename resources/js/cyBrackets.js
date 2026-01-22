document.addEventListener('DOMContentLoaded', function() {
    const bracketElements = document.querySelectorAll('.js-cy-brackets');

    bracketElements.forEach(element => {
        const cornerColor = element.getAttribute('data-color') || 'red';
        const type = element.getAttribute('data-type') || 'box';

        const corners = [
            { class: 'cy-brackets-tl'},
            { class: 'cy-brackets-tr'},
            { class: 'cy-brackets-bl'},
            { class: 'cy-brackets-br'}
        ];

        corners.forEach(corner => {
            const cornerElement = document.createElement('div');
            cornerElement.className = corner.class;
            cornerElement.style.borderColor = cornerColor;
            element.appendChild(cornerElement);
        });

    });
});
