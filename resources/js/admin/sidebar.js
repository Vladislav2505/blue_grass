document.getElementById('open_sidebar')?.addEventListener('click', openSidebar);
document.getElementById('close_sidebar')?.addEventListener('click', closeSidebar);
window.addEventListener('resize', hideMenuOnResize);

function openSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.remove('hidden');
    setTimeout(function () {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('flex', 'translate-x-0');
    }, 50);
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');

    sidebar.classList.remove('translate-x-0');
    sidebar.classList.add('-translate-x-full');
    setTimeout(function () {
        sidebar.classList.add('hidden');
    }, 500);
}

// Функция для скрытия меню при изменении размера окна
function hideMenuOnResize() {
    const sidebar = document.getElementById('open_sidebar');

    if (!sidebar.classList.contains('hidden')) {
        closeSidebar();
    }
}
