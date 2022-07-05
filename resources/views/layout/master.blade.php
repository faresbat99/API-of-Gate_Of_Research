<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','unknowing page')</title>
</head>
<body>
    @include('layout.navbar')
@yield('content')
@include('layout.slidebar')
</body>
</html>
