document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const header = document.querySelector('.header');
    const container = document.querySelector('.container');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        header.classList.toggle('open-sidebar');
        container.classList.toggle('open-sidebar');
    });
});
