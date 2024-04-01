import { handleInputValidation } from '../form.js';

document.addEventListener('DOMContentLoaded', function () {
    // Вызываем функцию, передавая массив id полей ввода
    handleInputValidation(['email', 'password']);
});
