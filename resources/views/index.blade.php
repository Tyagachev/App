<!doctype html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <!-- Style -->
        @vite(['resources/css/app.css'])
    </head>
</head>
<body>
<div id="app">
    <!-- App -->
</div>
<!-- Script -->
@vite(['resources/js/app.js'])
</body>
</html>
