@extends('layouts.auth')
@section('title', 'Подтверждение почты')

@section('content')
    <x-forms.auth-form form-action="verification.resend"
                       :form-label="session('message') ?: 'Вы должны подтвердить свой адрес электронной почты. На указанный вами адрес было отправлено письмо.'">
        @if(!session('message'))
            <input type="submit" name="send" value="Отправить код повторно"
                   class="text-lightblue flex items-start w-fit cursor-pointer"/>
        @endif
        <x-forms.submit submit-label="Хорошо"/>
    </x-forms.auth-form>
@endsection
