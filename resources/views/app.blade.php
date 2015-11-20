<!DOCTYPE html>
<html lang="en">
<head>
    <title>How to Learn</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to do</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    @yield('styles')
</head>

<body>
    @include('headers.header')
    
    @yield('content')

    @yield('scripts')
    @include('footers.footer')
</body>
</html>

