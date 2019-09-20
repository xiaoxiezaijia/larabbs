<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--    <-- CSRF Token-->--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div id="app" class="{{ route_class() }}-page">

{{--    加载顶部导航区块的子模板。--}}
    @include('layouts._header')

    <div class="container">

{{--        占位符声明，允许继承此模板的页面注入内容。--}}
        @include('shared._messages')

        @yield('content')

    </div>

    @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>

