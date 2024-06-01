import {closeModal, openModal, submitForm} from "./ajaxForms.js";

const formName = 'request';
const requestButtons = document.querySelectorAll('.request-modal-open');

if (requestButtons.length !== 0) {
    requestButtons.forEach(function (button) {
        button.addEventListener('click', () => openModal(formName));
    })

    document.getElementById('requestModalClose')
        .addEventListener('click', () => closeModal(formName));
    document.getElementById('requestForm')
        .addEventListener('submit', (event) => submitForm(event, formName));
}
