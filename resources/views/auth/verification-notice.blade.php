@extends('layouts.auth')
@section('title', 'Подтверждение почты')

@section('content')
    <x-forms.auth-form form-action="verification.resend"
                       :form-label="session('message') ?: __('auth.verification_notice')">
        @if(!session('message'))
            <input type="submit" name="send" value="Отправить код повторно"
                   class="text-lightblue flex items-start w-fit cursor-pointer"/>
        @endif
        <x-forms.submit submit-label="Хорошо"/>
    </x-forms.auth-form>
@endsection
