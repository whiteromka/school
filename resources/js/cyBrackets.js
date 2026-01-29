document.addEventListener('DOMContentLoaded', function() {
    const bracketElements = document.querySelectorAll('.js-cy-brackets');

    bracketElements.forEach(element => {
        const cornerColor = element.getAttribute('data-color') || 'red';
        const type = element.getAttribute('data-type') || 'box'; // box || square
        const width = element.getAttribute('data-width') || 1;
        const size = element.getAttribute('data-size') || 6;

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
            if (width !== 1) {
                cornerElement.style.borderWidth = width + 'px';
            }
            if (size !== 1) {
                cornerElement.style.width = size + 'px';
                cornerElement.style.height = size + 'px';
            }
            element.appendChild(cornerElement);
        });
    });
});
