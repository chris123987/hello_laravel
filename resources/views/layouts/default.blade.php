<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Sample App') - Laravel 入门教程</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/apps.css">
</head>
<body>
@include('layouts._header')

<div class="container">
    @include('shared._messages')
    @yield('content')
</div>
<script src="/js/app.js"></script>
</body>
</html>