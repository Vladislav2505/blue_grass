// Функция для открытия модального окна с анимацией
function openModal() {
    const modal = document.getElementById('modalOverlay');

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(function () {
            modal.querySelector('.bg-white').classList.remove('opacity-0', 'scale-95');
        }, 50); // Задержка для корректного применения анимации
    }
}

// Функция для закрытия модального окна с анимацией
function closeModal() {
    const modal = document.getElementById('modalOverlay');

    if (modal) {
        modal.querySelector('.bg-white').classList.add('opacity-0', 'scale-95');

        setTimeout(function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300); // Длительность анимации закрытия
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openModal();

            document.getElementById('cancelDeleteButton').onclick = function () {
                closeModal();
            }

            document.getElementById('confirmDeleteButton').onclick = function () {
                button.closest('form').submit();

                closeModal();
            }
        })
    })
});
