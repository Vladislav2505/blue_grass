<div {{$attributes->merge(['class' => ''])}}>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="g-recaptcha" data-sitekey="{{ config('view.recaptcha_key') }}"></div>
    <x-admin.forms.input-error error-name="g-recaptcha-response"/>
</div>
