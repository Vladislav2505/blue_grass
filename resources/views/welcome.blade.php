@extends('layout.app')
@section('title', 'Главная')

@section('content')
    @include('partials.header')
    <main>
        <article>
            <h2>BlueGrass</h2>
            <p>Текст статьи...</p>
        </article>

        <article>
            <h2>Еще одна статья</h2>
            <p>Другой текст...</p>
        </article>
    </main>
    @include('partials.footer')
@endsection
