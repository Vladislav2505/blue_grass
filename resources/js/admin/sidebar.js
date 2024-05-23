document.getElementById('open_sidebar')?.addEventListener('click', openSidebar);
document.getElementById('close_sidebar')?.addEventListener('click', closeSidebar);

// window.addEventListener('resize', hideMenuOnResize);

function openSidebar() {
    const sidebar = document.getElementById('sidebar');
    const background = document.getElementById('sidebar_background');

    document.querySelector('body').classList.add('hide-scroll');
    sidebar.classList.remove('hidden');
    background.classList.remove('hidden');
    setTimeout(function () {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('flex', 'translate-x-0', 'z-50');
        background.classList.add('z-50')
    }, 50);
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const background = document.getElementById('sidebar_background');

    sidebar.classList.remove('translate-x-0', 'z-50');
    background.classList.remove('z-50');
    sidebar.classList.add('-translate-x-full');
    setTimeout(function () {
        sidebar.classList.add('hidden');
        background.classList.add('hidden');
        document.querySelector('body').classList.remove('hide-scroll')
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
