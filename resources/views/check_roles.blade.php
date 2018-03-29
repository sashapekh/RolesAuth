<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(Auth::guest())
        <h1>You must register</h1>
        <a href="{{ redirect('register') }}">Register</a>
    @else
        <h1>Shows roles</h1>
        @can('do_anything')
            <h2>this is admin</h2>
            @else
                <h2>simple user</h2>
        @endcan
    @endif
</body>
</html>