document.addEventListener('DOMContentLoaded', function() {
    const gridBackground = document.getElementById('gridBackground');
    const squareSize = 160;

    function createGrid() {
        gridBackground.innerHTML = '';

        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        const squaresHorizontal = Math.ceil(windowWidth / squareSize) + 1;
        const squaresVertical = Math.ceil(windowHeight / squareSize) + 1;
        const totalSquares = squaresHorizontal * squaresVertical;

        for (let i = 0; i < totalSquares; i++) {
            const square = document.createElement('div');
            square.className = 'grid-square';

            const point = document.createElement('div');
            point.className = 'grid-point';

            square.appendChild(point);

            if (windowWidth < 768) {
                square.style.width = '150px';
                square.style.height = '150px';
                point.style.width = '4px';
                point.style.height = '4px';
            }

            if (windowWidth < 480) {
                square.style.width = '100px';
                square.style.height = '100px';
                point.style.width = '3px';
                point.style.height = '3px';
            }

            gridBackground.appendChild(square);
        }
    }

    createGrid();
    window.addEventListener('resize', createGrid);
});
