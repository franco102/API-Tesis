<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
        </style>
    </head>
    <body class="antialiased">
        <input id="hdfRaiz" type="hidden" value='{{Request::url() }}' /> 
        <div id="page">
        </div>
        <!-- Color box -->
    </body>
    <script src="{{ asset('js/cryptoJS.js')}}"></script>
    <script type="module" src="{{ asset('js/principal.js')}}"></script>
</html>
