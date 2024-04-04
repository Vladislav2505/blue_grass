@extends('layouts.auth')
@section('title', 'Подтверждение почты')

@section('content')
    <x-forms.auth-form form-action="login" form-method="GET"
                       form-label="Вы должны подтвердить свой адрес электронной почты. На указанный вами адрес было отправлено письмо.">
        <x-forms.submit submit-label="Хорошо"/>
    </x-forms.auth-form>
@endsection
