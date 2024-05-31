// Определение функции onloadCallback в глобальной области видимости
window.onloadCallback = function() {
    const reWidgets = [
        'registerRecaptcha',
        'requestRecaptcha',
        'questionRecaptcha',
        'forgotPasswordRecaptcha',
    ];

    reWidgets.forEach(function (widgetId) {
        const widgetElement = document.getElementById(widgetId);

        if (widgetElement) {
            const siteKey = widgetElement.getAttribute('data-sitekey');
            const optWidgetId = grecaptcha.render(widgetElement, {
                'sitekey': siteKey,
            });

            widgetElement.setAttribute('opt_widget_id', optWidgetId);
        }
    });
};

// Убедитесь, что DOM загружен перед добавлением скрипта reCAPTCHA API
document.addEventListener('DOMContentLoaded', function () {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
});
