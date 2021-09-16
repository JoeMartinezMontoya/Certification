'use strict';
window.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    /*NAV TOGGLE MANAGEMENT*/
    const menuButton = document.querySelector('.menu-button');
    const menuOverlay = document.querySelector('.menu-overlay');
    menuButton.addEventListener('click', function () {
        menuButton.classList.toggle('active');
        menuOverlay.classList.toggle('open');
    });
});