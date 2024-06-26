document.addEventListener('DOMContentLoaded', function () {
    // Вызываем функцию, передавая массив id полей ввода
    handleInputValidation(['last_name', 'first_name', 'email', 'password']);
});

export function handleInputValidation(inputIds) {
    inputIds.forEach(function (inputId) {
        const input = document.getElementById(inputId);
        const error = document.getElementById(inputId + '_error');

        if (!input || !error) {
            return;
        }

        input.addEventListener('input', function () {
            if (input.value.trim() !== '') {
                error.style.display = 'none';
            }
        });
    });
}


const personalDataCheckbox = document.getElementById('personal-data');
const personalDataError = document.getElementById('personal-data_error');

document.addEventListener('submit', function (event) {
    if (personalDataCheckbox) {
        if (!personalDataCheckbox.checked) {
            personalDataError.textContent = 'Вы должны дать согласие на обработку персональных данных'
            event.preventDefault();
        }
    }
});

if (personalDataCheckbox) {
    personalDataCheckbox.addEventListener('change', function () {
        if (personalDataCheckbox.checked) {
            personalDataError.textContent = '';
            personalDataError.style.display = 'none';
        } else {
            personalDataError.style.display = 'block';
        }
    });
}
