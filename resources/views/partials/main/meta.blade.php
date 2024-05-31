@if(!empty($meta))
    <meta name="description" content="{{ $meta['description'] ?? '' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">
    <meta name="author" content="{{__('meta.author')}}">
    <meta property="og:description" content="{{ $meta['description'] ?? '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="{{__('meta.type')}}">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:site_name" content="{{config('app.name')}}">
@endif
