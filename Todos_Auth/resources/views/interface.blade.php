<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todos app</title>

    <script src="js/app.js" defer></script>

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
    <div id="intrf"></div>
    <script src="js/interface.js"></script>
</body>

</html>