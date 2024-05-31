import Inputmask from "inputmask";

document.addEventListener('DOMContentLoaded', function() {
    const phoneInputs = document.querySelectorAll('input[type="tel"]');

    phoneInputs.forEach(input => {
        Inputmask({
            mask: '+7 (999) 999-99-99',
            placeholder: '+7 (___) ___-__-__',
            showMaskOnHover: false,
            showMaskOnFocus: true,
            clearIncomplete: true
        }).mask(input);
        input.setAttribute('autocomplete', 'off');
    });
});
