<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ Панель</title>
    <style>
    </style>
</head>
<body>
    <div id="app">
        <App></App>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
