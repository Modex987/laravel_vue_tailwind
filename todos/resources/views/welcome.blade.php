<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel VueJs Todos</title>

    <script src="js/app.js" defer></script>

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>

<body class="bg-gray-700 min-h-screen text-white flex justify-center pt-16">
    <div id="app">

    </div>
    <script src="js/main.js"></script>
</body>

</html>