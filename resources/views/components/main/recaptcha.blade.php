<div {{$attributes->merge(['class' => ''])}}>
    <div id="{{$recaptchaId}}" data-sitekey="{{config('services.recaptcha.sitekey') }}"></div>
    <x-admin.forms.input-error error-name="g-recaptcha-response"/>
</div>
