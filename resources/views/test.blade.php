@extends('layouts.app')
@section('title', 'test')
@section('content')
    <div class="flex justify-center items-center">
        <div class="container">
            <p>
                <img src="{{Vite::asset('resources/images/burger.svg')}}">
            </p>
        </div>
    </div>
@endsection
