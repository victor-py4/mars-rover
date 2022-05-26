<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        <title>Mars Rover Mission</title>

    </head>
    <body class="">
        <div id="app" class="centered-layout">
            <app-form></app-form>
        </div>
    </body>

    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
