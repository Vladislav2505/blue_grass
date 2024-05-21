document.getElementById('open_burger')?.addEventListener('click', openMenu);
document.getElementById('close_burger')?.addEventListener('click', closeMenu);

// window.addEventListener('resize', hideMenuOnResize);

function openMenu() {
    const burgerMenu = document.getElementById('burger_menu');
    document.querySelector('body').classList.add('hide-scroll');
    burgerMenu.classList.remove('hidden');
    setTimeout(function () {
        burgerMenu.classList.remove('translate-x-full');
        burgerMenu.classList.add('flex', 'translate-x-0');
    }, 50);
}

function closeMenu() {
    const burgerMenu = document.getElementById('burger_menu');
    burgerMenu.classList.remove('translate-x-0');
    burgerMenu.classList.add('translate-x-full');
    document.querySelector('body').classList.remove('hide-scroll');
    setTimeout(function () {
        burgerMenu.classList.add('hidden');
    }, 500);
}

// // Функция для скрытия меню при изменении размера окна
// function hideMenuOnResize() {
//     const burgerMenu = document.getElementById('burger_menu');
//
//     if (!burgerMenu.classList.contains('hidden')) {
//         closeMenu();
//     }
// }
