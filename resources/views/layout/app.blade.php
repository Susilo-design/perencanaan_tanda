<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @stack('styles')


</head>
<body class="bg-[#1A1E21] text-[#e0e0e0]">


@yield('content')



    @stack('scripts')
</body>
</html>
