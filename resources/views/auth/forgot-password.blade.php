@extends('layouts.auth')
@section('title', 'Восстановление пароля')

@section('content')
    <x-forms.auth-form form-action="forgot-password" form-title="Восстановление пароля">
        @if(session('status'))
            <p class="text-success font-bold text-center">{{session('status')}}</p>
            <x-forms.submit submit-name="accept" submit-label="Хорошо"/>
        @else
            <p class="text-error font-bold text-center">{{$errors->first('status')}}</p>
            <x-forms.input input-name="email" input-label="E-mail" input-placeholder="Введите E-mail"
                           input-type="email" :input-value="old('email')"/>
            <x-forms.submit submit-label="Отправить код"/>
        @endif
    </x-forms.auth-form>
@endsection
