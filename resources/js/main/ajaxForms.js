import {resetCaptcha} from "../recaptcha.js";

export function openModal(name) {
    const modal = document.getElementById(name + 'Modal');

    if (modal) {
        resetCaptcha(name + 'Recaptcha')
        clearModalErrors(name)

        if (document.getElementById(name + '-personal-data')) {
            document.getElementById(name + '-personal-data').checked = false;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.querySelector('body').classList.add('hide-scroll')
        setTimeout(function () {
            modal.querySelector('.bg-white').classList.remove('opacity-0', 'scale-95');
        }, 50);
    }
}

export function closeModal(name) {
    const modal = document.getElementById(name + 'Modal');

    if (modal) {
        modal.querySelector('.bg-white').classList.add('opacity-0', 'scale-95');

        setTimeout(function () {
            document.querySelector('body').classList.remove('hide-scroll')
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
}

export function clearModalErrors(name) {
    const errorElements = document.querySelectorAll('[id*="error"]');
    errorElements.forEach(element => {
        element.innerHTML = '';
    });

    if (document.getElementById(name + '-personal-data_error')) {
        document.getElementById(name + '-personal-data_error').innerText = '';
    }
}

export function submitForm(event, name) {
    event.preventDefault();
    clearModalErrors(name)

    const personalData = document.getElementById(name + '-personal-data');

    if (personalData && !personalData.checked) {
        document.getElementById(name + '-personal-data_error').innerText = 'Вы должны дать согласие на обработку персональных данных';
        return;
    }

    const form = event.target;

    axios.post(form.action, Object.fromEntries(new FormData(form)))
        .then(response => {
            document.getElementById(name + 'Form').classList.add('hidden');
            const success = document.getElementById(name + 'Success');
            success.classList.remove('hidden');
            success.innerText = response.data.success
        })
        .catch(error => {
            resetCaptcha(name + 'Recaptcha')
            if (error.response.status === 422) {
                const errors = error.response.data.errors;
                Object.entries(errors).forEach(([key, value]) => {
                    let errorBlocks = document.querySelectorAll('#' + key + '_error')
                    errorBlocks.forEach(function (block) {
                        block.innerText = value[0]
                    })
                });
            } else {
                console.log(error.response.data.error)
            }
        })
}
