<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />
    <title>@yield('page_title')JTT</title>
    <style>
        html, body{
            min-height:100%;
        }
        .body_bg{
            background-color: #3f3f46;
        }
    </style>
    @yield('styles')
    @yield('header_scripts')
</head>
<body class="flex flex-col body_bg min-h-screen">
    @include('includes/header')
    @yield('content')
    @yield('footer_scripts')
    @include('includes.footer')
</body>
</html>