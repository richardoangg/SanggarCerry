<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('template.partials._style')

    <title>Sanggar Cerry - @yield('title')</title>
</head>

<body>
    @include('template.partials._navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('template.partials._footer')

    @include('template.partials._script')
</body>

</html>
