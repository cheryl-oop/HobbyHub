<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HobbyHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial-detailpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roadmap-detailpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roadmap-create-edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/roadmap-card.css') }}">
    <link rel="stylesheet" href="https://use.typekit.net/bly1jgh.css">
    <link rel="stylesheet" href="{{ asset('css/components/tutorial-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
@include('layout._partials.header')
@yield('content')
@include('layout._partials.footer')
</body>
</html>

