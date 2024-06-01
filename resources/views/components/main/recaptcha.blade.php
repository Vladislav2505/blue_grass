<div {{$attributes->merge(['class' => ''])}}>
    <div id="{{$recaptchaId}}" data-sitekey="{{config('services.recaptcha.sitekey') }}"></div>
    <p id="g-recaptcha-response_error" class="text-error text-[14px]">{{$errors->first('g-recaptcha-response')}}</p>
</div>
