document.getElementById('open_sidebar')?.addEventListener('click', openSidebar);
document.getElementById('close_sidebar')?.addEventListener('click', closeSidebar);

// window.addEventListener('resize', hideMenuOnResize);

function openSidebar() {
    const sidebar = document.getElementById('sidebar');
    const background = document.getElementById('sidebar_background');
    const body = document.querySelector('body');

    sidebar.classList.remove('hidden');
    background.classList.remove('hidden');
    body.classList.add('overflow-hidden'); // Убираем скроллинг страницы
    setTimeout(function () {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('flex', 'translate-x-0');
    }, 50);
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const background = document.getElementById('sidebar_background');
    const body = document.querySelector('body');

    sidebar.classList.remove('translate-x-0');
    sidebar.classList.add('-translate-x-full');
    setTimeout(function () {
        sidebar.classList.add('hidden');
        background.classList.add('hidden');
        body.classList.remove('overflow-hidden'); // Возвращаем скроллинг страницы
    }, 500);
}

// // Функция для скрытия меню при изменении размера окна
// function hideMenuOnResize() {
//     const sidebar = document.getElementById('open_sidebar');
//
//     if (!sidebar.classList.contains('hidden')) {
//         closeSidebar();
//     }
// }
