<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> 404 Error Page
    </title>
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
</head>

<body>
    <div class="dark:bg-gray-900 max-h-screen page-404">
        <div class="container">
            <div class="row">
                <img src=" {{ asset('images/404-error-template-3.webp') }}">
            </div>
        </div>
    </div>
</body>

</html>
